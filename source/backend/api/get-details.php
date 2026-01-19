<?php
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

        $query = "SELECT * FROM documents WHERE subject_id = :id ORDER BY id ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute([':id' => $id]); 
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['message'] = 'Lấy tài liệu thành công';
        $response['subject'] = $subject; 
        $response['data'] = $result;
    } catch (Exception $e) {
        $response['message'] = "Lỗi hệ thống: ". $e->getMessage();
    }
}

echo json_encode($response);
?>