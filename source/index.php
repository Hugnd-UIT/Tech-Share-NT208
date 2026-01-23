<?php
    session_start();
    ob_start();
    require_once 'backend/configure/database.php';
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $auth_pages = ['login', 'register', 'reset', 'confirm', 'payment', 'contact'];
    $is_auth_page = in_array($page, $auth_pages);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechShare - Study Hub</title>
    <link rel="shortcut icon" type="image/x-icon" href="frontend/assets/image/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="frontend/assets/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/assets/css/bootstrap.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        <?php if (!$is_auth_page): ?>
            main { padding-top: 60px; min-height: 80vh; }
        <?php endif; ?>
    </style>

</head>
<body>
    <?php if (!$is_auth_page) include 'frontend/components/header.php'; ?>

    <?php
        switch ($page) {
            case 'login':
                include 'frontend/pages/login.html'; 
                break;

            case 'register':
                include 'frontend/pages/register.html'; 
                break;
                
            case 'reset':
                include 'frontend/pages/reset.html'; 
                break;

            case 'contact':
                include 'frontend/pages/contact.html';
                break;

            case 'payment':
                include 'frontend/pages/payment.html';
                break;

            case 'verify':
                include 'frontend/pages/verify.html';
                break;
            
            case 'home':
                echo '<main>'; 
                include 'frontend/pages/home.html';
                echo '</main>';
                break;
            
            case 'discover':
                echo '<main>';
                include 'frontend/pages/discover.html';
                echo '<main>';
                break;

            case 'courses':
                echo '<main>';
                include 'frontend/pages/courses.html';
                echo '</main>';
                break;

            case 'profile':
                echo '<main>';
                include 'frontend/pages/profile.html';
                echo '</main>';
                break;

            case 'details':
                echo '<main>';
                include 'frontend/pages/details.html';
                echo '</main>';
                break;

            default:
                echo "<div class='container py-5 text-center mt-5'><h1 class='text-danger'>404 - Not Found</h1></div>";
                break;
        }
    ?>

    <?php if (!$is_auth_page) include 'frontend/components/footer.php'; ?>

    <script src="frontend/assets/javascript/vendors.min.js"></script>
    <script src="frontend/assets/javascript/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>