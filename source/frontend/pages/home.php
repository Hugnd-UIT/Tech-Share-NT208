<style>
    /* Hiệu ứng hover nhẹ cho các thẻ card */
    .hover-up { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-up:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    
    /* Chỉnh lại font size cho list môn học để không bị tràn */
    .card-body ul li {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.9rem;
    }
</style>

<section class="py-5 bg-light-subtle" style="border-radius: 0 0 50px 50px; padding-top: 120px !important;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 fw-bold">
                    <i class="bi bi-rocket-takeoff me-2"></i> Nền tảng học tập cho sinh viên UIT
                </span>
                
                <h1 class="display-3 fw-bold text-dark mb-4" style="line-height: 1.2;">
                    Chia sẻ tri thức, <br>
                    <span class="text-primary">Cùng nhau phát triển.</span>
                </h1>
                
                <p class="lead text-muted mb-5 px-lg-5">
                    Kho tài liệu khổng lồ gồm đề thi, slide bài giảng và source code đồ án chất lượng cao. 
                    Được đóng góp và kiểm duyệt bởi chính cộng đồng sinh viên <strong>Đại học Công nghệ Thông tin</strong>.
                </p>
                
                <div class="d-flex justify-content-center gap-3 mb-5">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <a href="index.php?page=login" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-lg">
                            Tham gia ngay <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    <?php else: ?>
                        <a href="index.php?page=course" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-lg">
                            Khám phá tài liệu <i class="bi bi-arrow-down ms-2"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-center gap-4 text-muted small">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i>
                        <span>Miễn phí</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-shield-check text-primary me-2 fs-5"></i>
                        <span>Đã kiểm duyệt</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people-fill text-warning me-2 fs-5"></i>
                        <span>5000+ Thành viên</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white shadow-sm border h-100 hover-up">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-file-earmark-text fs-3"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-1">10,000+</h2>
                    <p class="text-muted mb-0">Tài liệu & Đề thi</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white shadow-sm border h-100 hover-up">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-mortarboard fs-3"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-1">100%</h2>
                    <p class="text-muted mb-0">Dành cho sinh viên ATTT</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white shadow-sm border h-100 hover-up">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning-subtle text-warning rounded-circle mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-star fs-3"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-1">Top 1</h2>
                    <p class="text-muted mb-0">Cộng đồng chia sẻ</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light-subtle" id="mon-hoc">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase ls-1">Kho tài liệu</h6>
            <h2 class="fw-bold text-dark">Lộ trình học tập chuẩn UIT</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up">
                    <div class="bg-primary p-4 text-center text-white">
                        <i class="bi bi-book-half display-4"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <h5 class="fw-bold text-dark mb-3">Đại Cương</h5>
                        <ul class="list-unstyled text-muted small mb-4">
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>IT001 - Nhập môn lập trình</li>
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>MA006 - Giải tích</li>
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>MA003 - Đại số tuyến tính</li>
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>MA004 - Cấu trúc rời rạc</li>
                        </ul>
                        <a href="#" class="btn btn-sm btn-light-primary text-primary fw-bold w-100 stretched-link bg-primary-subtle">Truy cập</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up">
                    <div class="bg-success p-4 text-center text-white">
                        <i class="bi bi-laptop display-4"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <h5 class="fw-bold text-dark mb-3">Cơ Sở Ngành</h5>
                        <ul class="list-unstyled text-muted small mb-4">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>IT004 - Cơ sở dữ liệu</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>IT005 - Mạng máy tính</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>IT003 - CTDL & Giải thuật</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>IT007 - Hệ điều hành</li>
                        </ul>
                        <a href="#" class="btn btn-sm btn-light-success text-success fw-bold w-100 stretched-link bg-success-subtle">Truy cập</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up">
                    <div class="bg-warning p-4 text-center text-dark">
                        <i class="bi bi-shield-lock-fill display-4"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <h5 class="fw-bold text-dark mb-3">Chuyên Ngành</h5>
                        <ul class="list-unstyled text-muted small mb-4">
                            <li class="mb-2"><i class="bi bi-check2 text-warning me-2"></i>NT204 - Hệ thống tìm kiếm, phát hiện và ngăn ngừa xâm nhập</li>
                            <li class="mb-2"><i class="bi bi-check2 text-warning me-2"></i>NT548 - Công nghệ DevOps và ứng dụng</li>
                            <li class="mb-2"><i class="bi bi-check2 text-warning me-2"></i>NT137 - Kỹ thuật phân tích mã độc</li>
                            <li class="mb-2"><i class="bi bi-check2 text-warning me-2"></i>NT334 - Pháp chứng kỹ thuật số</li>
                        </ul>
                        <a href="#" class="btn btn-sm btn-light-warning text-warning fw-bold w-100 stretched-link bg-warning-subtle">Truy cập</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up">
                    <div class="bg-danger p-4 text-center text-white">
                        <i class="bi bi-mortarboard-fill display-4"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <h5 class="fw-bold text-dark mb-3">Đồ Án & Thực Tập</h5>
                        <ul class="list-unstyled text-muted small mb-4">
                            <li class="mb-2"><i class="bi bi-check2 text-danger me-2"></i>NT114 - Đồ án chuyên ngành</li>
                            <li class="mb-2"><i class="bi bi-check2 text-danger me-2"></i>NT508 - Đồ án tốt nghiệp</li>
                            <li class="mb-2"><i class="bi bi-check2 text-danger me-2"></i>NT215 - Thực tập DN</li>
                            <li class="mb-2"><i class="bi bi-check2 text-danger me-2"></i>Báo cáo mẫu & Slide</li>
                        </ul>
                        <a href="#" class="btn btn-sm btn-light-danger text-danger fw-bold w-100 stretched-link bg-danger-subtle">Truy cập</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="index.php?page=course" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Xem toàn bộ môn học</a>
        </div>
    </div>
</section>

<section class="py-5 mb-5">
    <div class="container">
        <div class="bg-primary rounded-5 p-5 text-center text-white shadow-lg position-relative overflow-hidden">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);"></div>
            
            <div class="position-relative z-1 py-4">
                <h2 class="fw-bold display-5 mb-3">Sẵn sàng để đạt điểm A+?</h2>
                <p class="lead text-white mb-0 mx-auto" style="max-width: 700px; opacity: 0.95; font-size: 1.25rem;">
                    Tham gia cộng đồng sinh viên UIT ngay hôm nay để kết nối, chia sẻ và tiếp cận nguồn tài liệu vô tận.
                </p>
            </div>
        </div>
    </div>
</section>