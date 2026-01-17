<?php
    // DỮ LIỆU CHUẨN TỪ KẾ HOẠCH HỌC TẬP UIT (NGÀNH ATTT)
    $courses = [
        // --- 1. ĐẠI CƯƠNG (FREE ACCESS) ---
        ['code' => 'IT001', 'name' => 'Nhập môn lập trình', 'cat' => 'Đại cương', 'credit' => 4, 'is_vip' => 0],
        ['code' => 'MA003', 'name' => 'Đại số tuyến tính', 'cat' => 'Đại cương', 'credit' => 3, 'is_vip' => 0],
        ['code' => 'MA004', 'name' => 'Cấu trúc rời rạc', 'cat' => 'Đại cương', 'credit' => 4, 'is_vip' => 0],
        ['code' => 'MA005', 'name' => 'Xác suất thống kê', 'cat' => 'Đại cương', 'credit' => 3, 'is_vip' => 0],
        ['code' => 'MA006', 'name' => 'Giải tích', 'cat' => 'Đại cương', 'credit' => 4, 'is_vip' => 0],
        ['code' => 'PH002', 'name' => 'Nhập môn mạch số', 'cat' => 'Đại cương', 'credit' => 4, 'is_vip' => 0],

        // --- 2. CƠ SỞ NHÓM NGÀNH (VIP) ---
        ['code' => 'IT002', 'name' => 'Lập trình hướng đối tượng', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],
        ['code' => 'IT003', 'name' => 'Cấu trúc dữ liệu & Giải thuật', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],
        ['code' => 'IT004', 'name' => 'Cơ sở dữ liệu', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],
        ['code' => 'IT005', 'name' => 'Nhập môn Mạng máy tính', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],
        ['code' => 'IT006', 'name' => 'Kiến trúc máy tính', 'cat' => 'Cơ sở ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'IT007', 'name' => 'Hệ điều hành', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],
        ['code' => 'NT015', 'name' => 'Giới thiệu ngành ATTT', 'cat' => 'Cơ sở ngành', 'credit' => 1, 'is_vip' => 1],
        ['code' => 'NT106', 'name' => 'Lập trình mạng căn bản', 'cat' => 'Cơ sở ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT140', 'name' => 'An toàn mạng', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],
        ['code' => 'NT230', 'name' => 'Cơ chế hoạt động mã độc', 'cat' => 'Cơ sở ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT132', 'name' => 'Quản trị mạng và hệ thống', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],
        ['code' => 'NT219', 'name' => 'Mật mã học', 'cat' => 'Cơ sở ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT209', 'name' => 'Lập trình hệ thống', 'cat' => 'Cơ sở ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT208', 'name' => 'Lập trình ứng dụng Web', 'cat' => 'Cơ sở ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT521', 'name' => 'Lập trình an toàn và khai thác lỗ hổng phần mềm', 'cat' => 'Cơ sở ngành', 'credit' => 4, 'is_vip' => 1],

        // --- 3. CHUYÊN NGÀNH (VIP) ---
        ['code' => 'NT204', 'name' => 'Hệ thống phát hiện xâm nhập', 'cat' => 'Chuyên ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT137', 'name' => 'Kỹ thuật phân tích mã độc', 'cat' => 'Chuyên ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT334', 'name' => 'Pháp chứng kỹ thuật số', 'cat' => 'Chuyên ngành', 'credit' => 3, 'is_vip' => 1],
        ['code' => 'NT548', 'name' => 'Công nghệ DevOps và ứng dụng', 'cat' => 'Chuyên ngành', 'credit' => 4, 'is_vip' => 1],

        // --- 4. ĐỒ ÁN & TỐT NGHIỆP (VIP) ---
        ['code' => 'NT114', 'name' => 'Đồ án chuyên ngành', 'cat' => 'Đồ án', 'credit' => 2, 'is_vip' => 1],
        ['code' => 'NT215', 'name' => 'Thực tập doanh nghiệp', 'cat' => 'Đồ án', 'credit' => 2, 'is_vip' => 1],
        ['code' => 'NT508', 'name' => 'Đồ án tốt nghiệp', 'cat' => 'Đồ án', 'credit' => 6, 'is_vip' => 1],
    ];

    $user_vip_status = isset($_SESSION['is_vip']) ? $_SESSION['is_vip'] : false; 
?>

<div class="bg-light-subtle" style="min-height: 100vh;">
    <div class="container py-5">
        <div class="row g-4">
            
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-uppercase text-muted mb-3 ls-1">Bộ lọc</h6>
                        
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"> </i></span>
                                <input type="text" class="form-control border-start-0 ps-0" placeholder="Mã môn...">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold small mb-2 d-block">Phân loại</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat1" checked>
                                <label class="form-check-label text-muted" for="cat1">Đại cương <span class="badge bg-success-subtle text-success ms-1">Free</span></label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat2">
                                <label class="form-check-label text-muted" for="cat2">Cơ sở ngành <i class="bi bi-lock-fill text-warning small"></i></label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat3">
                                <label class="form-check-label text-muted" for="cat3">Chuyên ngành <i class="bi bi-lock-fill text-warning small"></i></label>
                            </div>
                             <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat4">
                                <label class="form-check-label text-muted" for="cat4">Đồ án / Khóa luận <i class="bi bi-lock-fill text-warning small"></i></label>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 rounded-pill fw-bold">Áp dụng</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-muted small">Hiển thị <strong><?php echo count($courses); ?></strong> môn học</span>
                    <select class="form-select w-auto form-select-sm border-0 shadow-sm">
                        <option>A-Z</option>
                        <option>Mới nhất</option>
                    </select>
                </div>

                <div class="row g-4">
                    <?php foreach ($courses as $c): ?>
                        <?php 
                            // Logic màu sắc icon và nút
                            $bg_icon = 'bg-success text-white';
                            $text_class = 'text-success';
                            
                            // Nếu là VIP (Cơ sở, Chuyên ngành, Đồ án)
                            if ($c['is_vip'] == 1) { 
                                $bg_icon = 'bg-warning text-dark'; 
                                $text_class = 'text-warning';
                            }
                            // Riêng Đồ án cho màu đỏ cho nổi
                            if (strpos($c['cat'], 'Đồ án') !== false) { 
                                $bg_icon = 'bg-danger text-white'; 
                                $text_class = 'text-danger'; 
                            }

                            // Logic Khóa: Nếu là môn VIP và User chưa mua VIP
                            $locked = ($c['is_vip'] == 1 && !$user_vip_status); 
                            
                            // Link: Chưa có DB nên tạm thời trỏ về trang chi tiết giả định hoặc thanh toán
                            $link = "index.php?page=course_detail&code=" . $c['code']; 
                        ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 hover-up position-relative">
                                
                                <?php if($c['is_vip'] == 1): ?>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-warning text-dark shadow-sm"><i class="bi bi-star-fill"></i> VIP</span>
                                    </div>
                                <?php else: ?>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">Free</span>
                                    </div>
                                <?php endif; ?>

                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="mb-3">
                                        <div class="rounded-circle <?php echo $bg_icon; ?> bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <span class="fw-bold"><?php echo substr($c['code'], 0, 2); ?></span>
                                        </div>
                                    </div>
                                    
                                    <h6 class="text-muted small mb-1 text-uppercase ls-1"><?php echo $c['code']; ?></h6>
                                    <h5 class="fw-bold text-dark mb-2" style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;">
                                        <?php echo $c['name']; ?>
                                    </h5>
                                    <p class="text-muted small mb-4 flex-grow-1">
                                        <?php echo $c['cat']; ?> • <?php echo $c['credit']; ?> TC
                                    </p>
                                    
                                    <?php if($locked): ?>
                                        <a href="index.php?page=payment" class="btn btn-warning w-100 fw-bold rounded-pill text-dark shadow-sm">
                                            <i class="bi bi-lock-fill me-1"></i> Mở khóa ngay
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo $link; ?>" class="btn btn-outline-primary w-100 fw-bold rounded-pill">
                                            <i class="bi bi-folder2-open me-1"></i> Xem tài liệu
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>