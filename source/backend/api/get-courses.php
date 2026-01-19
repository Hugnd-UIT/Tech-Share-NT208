<?php
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định', 'is_vip' => false, 'data' => []];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $query = "SELECT * FROM subjects";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 0) { 
            $response['message'] = 'Hiện tại chưa có môn học nào!';
        } else { 
            $response['data'] = $result;
            $response['status'] = 'success';
            $response['message'] = 'Lấy dữ liệu thành công';
            
            if (!isset($_SESSION['is_vip'])) {
                $_SESSION['is_vip'] = false;
            }
            
            if ($_SESSION['is_vip']) { 
                $response['is_vip'] = true;
            }
        }
    } catch (PDOException $e) {
        $response['message'] = "Lỗi hệ thống: ". $e->getMessage();
    }
}

echo json_encode($response);
?>