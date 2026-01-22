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
        
        $user = $result['username'];
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
        $mail->Username = "hungnd.attt2024@gmail.com";
        $mail->Password = "vbft weak wjbh dyvf";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->setFrom("hungnd.attt2024@gmail.com", "Tech Share");
        $mail->addAddress($email);
        $mail->Subject = 'Đổi mật khẩu của bạn';

        $mail->Body = "
        <h4>Hi $user</h4>
        <p>As you have requested for reset password instructions, here they are, please follow the URL:</p>

        <a href='http://localhost/index.php?page=confirm&token=$token'>
            Reset password
        </a>
        ";
        
        if ($mail->send()) {
            $response['status'] = 'success';
            $response['message'] = 'Đã gửi link thành công';
        } else {
            $response['message'] = 'Không thể gửi email';
        }
    } catch(Exception $e) {
        $response['message'] = "Lỗi hệ thống: " . $e->getMessage();
    }
}

echo json_encode($response);
?>