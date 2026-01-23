<?php
session_start();
header('Content-Type: application/json');
require_once "../configure/database.php";
require_once "../mail/PHPMailer/src/PHPMailer.php";
require_once "../mail/PHPMailer/src/SMTP.php";
require_once "../mail/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ['status' => 'error', 'message' => 'Lỗi không xác định'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"] ?? "";

    try {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $user = htmlspecialchars($result['username']);
        $token = bin2hex(random_bytes(32));
        $hash_token = hash('sha256', $token);

        $query = "UPDATE users SET reset_token = :token, reset_expire = DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE email = :email";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([':token' => $hash_token, ':email' => $email]);

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_EMAIL'); 
        $mail->Password = getenv('SMTP_PASSWORD');
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->setFrom(getenv('SMTP_EMAIL'), "Tech Share");
        $mail->addAddress($email);
        $mail->Subject = 'Đổi mật khẩu của bạn';

        $mail->Body = "
        <h4>Hi $user</h4>
        <p>As you have requested for reset password instructions, here they are, please follow the URL:</p>

        <a href='http://localhost/index.php?page=verify&token=$token'>
            Reset password
        </a>
        ";
        
        if ($mail->send()) {
            $response['status'] = 'success';
            $response['message'] = 'Đã gửi link thành công';
        } else {
            error_log("Mail Error: " . $mail->ErrorInfo);
            $response['message'] = 'Không thể gửi email lúc này.';
        }
    } catch(Exception $e) {
        error_log("Reset Error: " . $e->getMessage()); 
        $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
    }
}

echo json_encode($response);
?>