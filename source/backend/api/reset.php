<?php
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

        if (!$result) {
            $response['message'] = 'Email này chưa đăng ký tài khoản!';
            echo json_encode($response);
            exit; 
        }
        
        $user = htmlspecialchars($result['username']);
        $token = bin2hex(random_bytes(32));
        $hash_token = hash('sha256', $token);
        $link = "http://localhost/index.php?page=verify&token=" . $token;
        // $link = " https://sheathy-reparative-judie.ngrok-free.dev/index.php?page=verify&token=" . $token;

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
        <div style='font-family: Arial, sans-serif; line-height: 1.6;'>
            <h3>Xin chào $user,</h3>
            <p>Bạn (hoặc ai đó) đã yêu cầu đặt lại mật khẩu cho tài khoản Tech Share.</p>
            <p>Vui lòng nhấn vào nút bên dưới để tạo mật khẩu mới (Link hết hạn sau 15 phút):</p>
            <p>
                <a href='$link' style='background-color: #0d6efd; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Đặt lại mật khẩu</a>
            </p>
            <p>Hoặc truy cập link sau: <a href='$link'>$link</a></p>
            <p>Nếu bạn không yêu cầu, vui lòng bỏ qua email này.</p>
        </div>
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