<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $topic = $_POST["topic"] ?? "";
    $content = $_POST["content"] ?? "";

    try {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "hungnd.attt2024@gmail.com";
        $mail->Password = "vbft weak wjbh dyvf";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->setFrom("hungnd.attt2024@gmail.com", "Tech Share");
        $mail->addAddress("hungnd.attt2024@gmail.com");
        $mail->addReplyTo($email);
        $mail->Subject = 'Liên hệ từ website';

        $mail->Body = "
        Tên: $name
        Email: $email
        Chủ đề: $topic
        Nội dung:$content
        ";
        
        if ($mail->send()) {
            $response['status'] = 'success';
            $response['message'] = 'Gửi tin nhắn thành công';
        } else {
            $response['message'] = 'Không thể gửi email';
        }
    } catch(Exception $e) {
        $response['message'] = "Lỗi hệ thống: " . $e->getMessage();
    }
}

echo json_encode($response);
?>