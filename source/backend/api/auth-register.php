<?php
session_set_cookie_params(['lifetime' => 86400, 'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true, 'samesite' => 'Lax']);
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message'=> 'Lỗi không xác định'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $username = $_POST["username"] ?? "";
    $full_name = $_POST["fullname"] ?? "";
    $password = $_POST["password"] ?? "";
    $captcha = $_POST["captcha"] ?? "";
    $comfirm_password = $_POST["confirm_password"] ?? "";

    if (empty($captcha)) {
        $response['message'] = "Vui lòng nhập mã captcha!";
        echo json_encode($response);
        exit;
    } 
    
    if (!isset($_SESSION['captcha_code']) || strtoupper($captcha) !== $_SESSION['captcha_code']) {
        $response['message'] = "Mã captcha không đúng!";
        unset($_SESSION['captcha_code']);
        echo json_encode($response);
        exit; 
    }
    
    if (empty($email) || empty($username) || empty($password)) {
        $response['message'] = "Vui lòng nhập đầy đủ thông tin!";
    } else if ($password !== $comfirm_password) {
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
                error_log("Register Error: " . $e->getMessage()); 
                $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
            }
        }
    }
}

echo json_encode($response);
?>