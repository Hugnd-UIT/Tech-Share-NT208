<?php
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if (empty($info) || empty($password)) {
        $response['message'] = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        try {
            $query = "SELECT * FROM users WHERE username = :info OR email = :info";
            $stmt = $conn->prepare($query);
            $stmt->execute([':info' => $info]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result["password"])) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_name'] = $result['username'];

                if (!empty($result["vip_expiration_date"]) && strtotime($result["vip_expiration_date"]) > time()) {
                    $_SESSION['is_vip'] = true;
                } else {
                    $_SESSION['is_vip'] = false;
                } 

                $response['status'] = 'success';
                $response['message'] = 'Đăng nhập thành công!';
            } else {
                $response['message'] = "Tài khoản hoặc mật khẩu không đúng!";
            }
        } catch (Exception $e) {
            $response['message'] = "Lỗi hệ thống: " . $e->getMessage();
        }
    }
}

echo json_encode($response);
?>