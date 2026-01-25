<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once "../configure/database.php";
require_once "../mail/PHPMailer/src/PHPMailer.php";
require_once "../mail/PHPMailer/src/SMTP.php";
require_once "../mail/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ['status' => 'error', 'message' => 'Lỗi không xác định'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? "");
    $email = htmlspecialchars($_POST['email'] ?? "");
    $topic = htmlspecialchars($_POST['topic'] ?? "");
    $content = htmlspecialchars($_POST['content'] ?? "");
    $captcha = $_POST["captcha"] ?? "";

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

    try {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_EMAIL'); 
        $mail->Password = getenv('SMTP_PASSWORD');
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->setFrom(getenv('SMTP_EMAIL'), "Tech Share Contact");
        $mail->addAddress(getenv('SMTP_EMAIL'));
        $mail->addReplyTo($email, $name);
        $mail->Subject = "Liên hệ mới từ website";

        if ($topic === '1') {
            $topic = 'Đóng góp tài liệu';
        } else if ($topic === '2') {
            $topic = 'Báo lỗi website';
        } else if ($topic === '3') {
            $topic = 'Hỗ trợ tài khoản VIP';
        } else {
            $topic = 'Khác';
        }

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
            error_log("Mail Error: " . $mail->ErrorInfo);
            $response['message'] = 'Không thể gửi email lúc này.';
        }
    } catch(Exception $e) {
        error_log("Contact Error: " . $e->getMessage()); 
        $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
    }
}

echo json_encode($response);
?>