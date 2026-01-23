<link rel="stylesheet" href="frontend/assets/css/custom-header.css">

<nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-cyber">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="frontend/assets/image/logo.png" alt="TechShare" width="40" height="40" class="rounded shadow-sm">
            <span class="fs-4 brand-gradient" style="letter-spacing: -0.5px;">TechShare</span>
        </a>
        <button class="navbar-toggler border-0 bg-light rounded-circle p-2 shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <form class="d-flex mx-auto my-3 my-lg-0 w-100 search-cyber" style="max-width: 500px;" role="search">
                <div class="input-group">
                    <span class="input-group-text border-0 ps-3 rounded-start-pill text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input class="form-control border-0 py-2 rounded-end-pill" 
                           type="search" 
                           placeholder="Tìm kiếm khóa học..." 
                           style="box-shadow: none; outline: none;">
                </div>
            </form>
            <div class="d-flex align-items-center gap-2 justify-content-end">
                <a href="index.php" class="nav-link px-2">Trang chủ</a>
                <a href="index.php?page=courses" class="nav-link px-2">Khóa học</a>
                <div class="vr d-none d-lg-block mx-2 opacity-25"></div>
                <a href="index.php?page=discover" class="btn btn-vip-gold rounded-pill px-4 me-2">
                    <i class="bi bi-crown-fill"></i> VIP
                </a>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="index.php?page=login" class="btn btn-cyber-primary rounded-pill px-4 fw-bold shadow-sm">
                        ĐĂNG NHẬP
                    </a>
                    <a href="index.php?page=register" class="btn btn-cyber-primary rounded-pill px-4 fw-bold shadow-sm ms-2">
                        ĐĂNG KÝ
                    </a>
                <?php else: ?>
                    <div class="ms-2">
                        <a href="index.php?page=profile" class="d-block link-dark text-decoration-none" title="Trang cá nhân & Cài đặt">
                            <img src="frontend/assets/image/default-avt.png" width="32" height="32" class="rounded-circle border border-2 border-light shadow-sm">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>