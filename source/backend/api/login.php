<?php
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $captcha = $_POST["captcha"] ?? "";
    $remember = (isset($_POST["remember"]) && ($_POST["remember"] === "true" || $_POST["remember"] === "1")) ? true : false;

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

    if (empty($info) || empty($password)) {
        $response['message'] = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        try {
            $query = "SELECT * FROM users WHERE username = :info OR email = :info";
            $stmt = $conn->prepare($query);
            $stmt->execute([':info' => $info]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result["password"])) {   
                session_regenerate_id(true);             
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_name'] = $result['username'];

                if (!empty($result["vip_expiration_date"]) && strtotime($result["vip_expiration_date"]) > time()) {
                    $_SESSION['is_vip'] = true;
                } else {
                    $_SESSION['is_vip'] = false;
                } 
                
                if ($remember) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), session_id(), ['expires' => time() + 2592000, 'path' => $params['path'], 'domain' => $params['domain'], 'secure' => $params['secure'], 'httponly' => $params['httponly'], 'samesite' => $params['samesite']]);                
                }

                $response['status'] = 'success';
                $response['message'] = 'Đăng nhập thành công!';
            } else {
                $response['message'] = "Tài khoản hoặc mật khẩu không đúng!";
            }
        } catch (Exception $e) {
            error_log("Login Error: " . $e->getMessage()); 
            $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
        }
    }
}

echo json_encode($response);
?>