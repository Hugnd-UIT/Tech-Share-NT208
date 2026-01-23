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
        error_log("Logout Error: " . $e->getMessage()); 
        $response['message'] = "Lỗi hệ thống: Đã có sự cố xảy ra, vui lòng thử lại sau.";
    }
}

echo json_encode($response);
?>