<?php
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass = $_POST["password"] ?? "";
    $comfirm_password = $_POST["comfirm_password"] ?? "";
    $token = $_POST['token'] ?? '';
    
    if (empty($pass) || empty($comfirm_password)) {
        $response['message'] = "Vui lòng nhập đầy đủ thông tin!";
    } elseif ($pass !== $comfirm_password) {
        $response['message'] = "Mật khẩu xác nhận không khớp!";
    } else {
        try {
            $query = "UPDATE users SET password = :pass, reset_token = NULL, reset_expire = NULL WHERE reset_token = :token AND reset_expire > NOW()";
            $stmt = $conn->prepare($query);
            $stmt->execute([':pass' => password_hash($pass, PASSWORD_DEFAULT), ':token' => hash('sha256', $token)]);

            if ($stmt->rowCount() === 0) {
                $response['message'] = 'Link đã hết hạn hoặc không hợp lệ';
                echo json_encode($response);
                exit;
            }

            $response['status'] = 'success';
            $response['message'] = 'Đổi mật khẩu thành công!';
        } catch(Exception $e) {
            error_log("Verify Error: " . $e->getMessage()); 
            $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
        }
    }
}

echo json_encode($response);
?>