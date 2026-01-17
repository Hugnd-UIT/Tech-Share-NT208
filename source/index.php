<?php
    session_start();
    require_once 'backend/configure/database.php';
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    include 'frontend/components/header.php';
    
    switch ($page) {
        case 'home':
            include 'frontend/pages/home.php';
            break;
            
        case 'login':
            include 'frontend/pages/login.php'; // Trang Đăng nhập
            break;

        case 'register':
            include 'frontend/pages/register.php'; // Trang Đăng ký
            break;
            
        case 'contact':
            include 'frontend/pages/contact.php'; // Trang Liên hệ
            break;

        case 'payment':
            include 'frontend/pages/payment.php'; // Trang Thanh toán 
            break;
            
        default:
            echo "<div class='container py-5 text-center'><h1 class='text-danger'>404 - Lạc trôi rồi bro!</h1></div>";
            break;
    }

    include 'frontend/components/footer.php';
?>