<?php
require_once '../configure/database.php';

$id = $_GET['id'] ?? 0;
$action = $_GET['action'] ?? 'download';

if (!$id) {
    die("Lỗi: Không tìm thấy ID tài liệu.");
}

try {
    $stmt = $conn->prepare("SELECT d.*, s.is_vip FROM documents d JOIN subjects s ON d.subject_id = s.id WHERE d.id = :id");
    $stmt->execute([':id' => $id]);
    $doc = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$doc) {
        http_response_code(404);
        die("Tài liệu không tồn tại trên hệ thống.");
    }

    if ($doc['is_vip'] == 1) {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            die("Nội dung VIP! Vui lòng đăng nhập để tải.");
        }

        $Vip = isset($_SESSION['is_vip']) && $_SESSION['is_vip'] === true;
        
        if (!$Vip) {
            http_response_code(403);
            die("Bạn cần nâng cấp tài khoản VIP để xem tài liệu này!");
        }
    }
    
    $file_path = __DIR__ . '/../uploads/' . $doc['file_path'];

    if (!file_exists($file_path)) {
        http_response_code(404);
        die("Lỗi: Tài liệu không khả dụng.");
    }

    $conn->prepare("UPDATE documents SET download_count = download_count + 1 WHERE id = :id")->execute([':id' => $id]);

    $type = mime_content_type($file_path);
    if (!$type) $type = 'application/octet-stream';

    $disposition = ($action === 'view') ? 'inline' : 'attachment';

    header('Content-Description: File Transfer');
    header('Content-Type: ' . $type);
    header('Content-Disposition: ' . $disposition . '; filename="' . basename($file_path) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));

    if (ob_get_level()) ob_end_clean();

    flush(); readfile($file_path);
    exit;

} catch (Exception $e) {
    error_log("Download Error: " . $e->getMessage());
    http_response_code(500);
    die("Lỗi hệ thống.");
}
?>