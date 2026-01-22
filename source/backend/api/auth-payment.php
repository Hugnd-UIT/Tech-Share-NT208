<?php
session_start();
header('Content-Type: application/json');
require_once '../configure/database.php';

$response = ['status' => 'error', 'message' => 'Lỗi không xác định', 'code' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_name'])) {
        $response['message'] = 'Bạn chưa đăng nhập, vui lòng đăng nhập';
        echo json_encode($response);
        exit;
    } else {
        try {
            $query = "SELECT * FROM transactions WHERE user_id = :user_id AND status = 'pending' LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->execute(['user_id' => $_SESSION['user_id']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                $code = "VIP-" . strtoupper(substr(bin2hex(random_bytes(6)), 0, 8));

                $query = "INSERT INTO transactions (user_id, amount, transaction_code) VALUES (:user_id, 50000, :code)";
                $stmt = $conn->prepare($query);
                $stmt->execute(['user_id' => $_SESSION['user_id'], ':code' => $code]);

                $response['status'] = 'success';
                $response['code'] = $code;
            } else {
                $response['status'] = 'success';
                $response['code'] = $result["transaction_code"];
            }
        } catch(Exception $e) {
            $response['message'] = "Lỗi hệ thống: ". $e->getMessage();
        }
    }
}    

echo json_encode($response);
?>