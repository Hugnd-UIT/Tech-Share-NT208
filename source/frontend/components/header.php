<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" style="box-shadow: 0 2px 15px rgba(0,0,0,0.05);">
    <div class="container-fluid px-4">
        
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="frontend/assets/image/logo.png" alt="TechShare" width="40" height="40" class="rounded">
            <span class="fw-bold fs-4 text-primary" style="letter-spacing: -0.5px;">TechShare</span>
        </a>

        <button class="navbar-toggler border-0 bg-light rounded-circle p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            
            <form class="d-flex mx-auto my-3 my-lg-0 w-100" style="max-width: 500px;" role="search">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 ps-3 rounded-start-pill text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input class="form-control bg-light border-0 py-2 rounded-end-pill text-dark" 
                           type="search" 
                           placeholder="Search for courses..." 
                           style="box-shadow: none; outline: none;">
                </div>
            </form>

            <div class="d-flex align-items-center gap-2 justify-content-end">
                
                <a href="index.php" class="nav-link fw-medium text-dark px-2">Home</a>
                <a href="index.php?page=courses" class="nav-link fw-medium text-dark px-2">Courses</a>

                <div class="vr d-none d-lg-block mx-2"></div>

                <a href="index.php?page=payment" class="btn btn-warning rounded-pill fw-bold text-dark px-4 shadow-sm">
                    VIP
                </a>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="index.php?page=login" class="btn btn-primary rounded-pill px-4 fw-bold border-0 shadow-sm">
                        Login
                    </a>
                    
                    <a href="index.php?page=register" class="btn btn-primary rounded-pill px-4 fw-bold border-0 shadow-sm">
                        Register
                    </a>
                <?php else: ?>
                    <div class="ms-2">
                        <a href="index.php?page=profile" class="d-block link-dark text-decoration-none" title="Trang cá nhân & Cài đặt">
                            <img src="https://github.com/mdo.png" width="32" height="32" class="rounded-circle border border-2 border-light shadow-sm">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>