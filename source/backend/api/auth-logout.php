<?php
session_start();
header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Lỗi không xác định'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        session_unset();
        session_destroy();

        $response['status'] = 'success';
        $response['message'] = 'Đăng xuất thành công';
    } catch(Exception $e) {
        $response['message'] = "Lỗi hệ thống: ". $e->getMessage();
    }
}

echo json_encode($response);
?>