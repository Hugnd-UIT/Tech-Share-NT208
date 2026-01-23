<?php
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định', 'username' => '', 'email' => '', 'full_name' => '', 'role' => '', 'is_vip' => false, 'vip_expiration_date' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (!isset($_SESSION['user_name'])) {
            $response['message'] = 'Chưa đăng nhập';
            echo json_encode($response);
            exit;
        }

        $username = $_SESSION['user_name'];

        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->execute([':username' => $username]);
        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($info) {  
            $response['status'] = 'success';
            $response['username'] = $info['username'];
            $response['email'] = $info['email'];
            $response['full_name'] = $info['full_name'];
            $response['role'] = $info['role'];
            if (isset($_SESSION['is_vip']) && $_SESSION['is_vip'] === true) {
                $response['is_vip'] = true;
                $response['vip_expiration_date'] = $info["vip_expiration_date"];
            }
        } else {
            $response['message'] = 'Không tìm thấy thông tin user';
        }
    } catch(Exception $e) {
        error_log("Profile Error: " . $e->getMessage()); 
        $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
    }
}

echo json_encode($response);
?>