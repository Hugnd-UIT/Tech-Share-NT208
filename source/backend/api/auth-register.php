<?php
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message'=> 'Lỗi không xác định'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $username = $_POST["username"] ?? "";
    $full_name = $_POST["fullname"] ?? "";
    $password = $_POST["password"] ?? "";
    $comfirm_password = $_POST["confirm_password"] ?? "";

    if (empty($email) || empty($username) || empty($password)) {
        $response['message'] = "Vui lòng nhập đầy đủ thông tin!";
    } elseif ($password !== $comfirm_password) {
        $response['message'] = "Mật khẩu xác nhận không khớp!";
    } else {
        try {
            $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $check->execute([$username, $email]);
            if ($check->rowCount() > 0) {
                $response['message'] = "Username hoặc Email đã tồn tại!";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (username, full_name, email, password) VALUES (:username, :full_name, :email, :password)";
                $stmt = $conn->prepare($query);
                $stmt->execute([
                    ':username' => $username,
                    ':full_name' => $full_name,
                    ':email' => $email,
                    ':password' => $hashed_password
                ]);

                $response['status'] = 'success';
                $response['message'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $response['message'] = "Username hoặc Email đã tồn tại!";
            } else {
                $response['message'] = "Lỗi hệ thống: " . $e->getMessage();
            }
        }
    }
}

echo json_encode($response);
?>