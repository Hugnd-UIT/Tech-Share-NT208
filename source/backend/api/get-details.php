<?php
session_set_cookie_params(['lifetime' => 86400, 'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true, 'samesite' => 'Lax']);
session_start();
header("Content-Type: application/json");
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định', 'data' => []];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $id = $_GET['id'] ?? null; 

        if (!$id) {
            throw new Exception("Thiếu ID môn học");
        }
        
        $stmtSub = $conn->prepare("SELECT * FROM subjects WHERE id = :id");
        $stmtSub->execute([':id' => $id]);
        $subject = $stmtSub->fetch(PDO::FETCH_ASSOC);

        if (!$subject) {
            throw new Exception("Môn học không tồn tại");
        }

        if ($subject['is_vip'] == 1) {
            if (!isset($_SESSION['user_id'])) {
                $response['message'] = "Nội dung VIP! Bạn cần đăng nhập để xem.";
                echo json_encode($response);
                exit;
            }

            $Vip = isset($_SESSION['is_vip']) && $_SESSION['is_vip'] === true;

            if (!$Vip) {
                $response['message'] = "Đây là tài liệu VIP. Vui lòng nâng cấp tài khoản!";
                echo json_encode($response);
                exit;
            }
        }

        $query = "SELECT * FROM documents WHERE subject_id = :id ORDER BY id ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute([':id' => $id]); 
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['message'] = 'Lấy tài liệu thành công';
        $response['subject'] = $subject; 
        $response['data'] = $result;
    } catch (Exception $e) {
        error_log("Details Error: " . $e->getMessage()); 
        $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
    }
}

echo json_encode($response);
?>