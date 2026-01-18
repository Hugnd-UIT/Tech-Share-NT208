<?php
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($info) || empty($password)) {
        $response['message'] = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        try {
            $query = "SELECT * FROM users WHERE username = :info OR email = :info";
            $stmt = $conn->prepare($query);
            $stmt->execute([':info' => $info]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["password"])) {
                $_SESSION['role'] = $user['role'];     
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];

                $response['status'] = 'success';
                $response['message'] = 'Đăng nhập thành công!';
            }else {
                $response['message'] = "Tài khoản hoặc mật khẩu không đúng!";
            }
        } catch (Exception $e) {
            $response['message'] = "Lỗi hệ thống: " . $e->getMessage();
        }
    }
}

echo json_encode($response);
?>