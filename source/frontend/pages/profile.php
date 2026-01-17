<?php
    $user = [
        'fullname' => 'Nguyen Van A',
        'username' => 'hungnguyen_uit',
        'email' => '12345678@gm.uit.edu.vn',
        'phone' => '0987654321',
        'is_vip' => true, 
        'vip_expiry' => '2026-06-15',
        'avatar' => 'https://ui-avatars.com/api/?name=Nguyen+Van+A&background=0D6EFD&color=fff'
    ];
?>

<div class="bg-light-subtle py-5" style="min-height: 100vh;">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-4 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-body text-center p-4">
                        <div class="position-relative d-inline-block mb-3">
                            <img src="<?php echo $user['avatar']; ?>" class="rounded-circle shadow-sm" width="100" height="100" alt="Avatar">
                            <span class="position-absolute bottom-0 end-0 p-2 bg-success border border-white rounded-circle"></span>
                        </div>
                        <h5 class="fw-bold text-dark mb-1"><?php echo $user['fullname']; ?></h5>
                        <p class="text-muted small mb-3"><?php echo $user['email']; ?></p>
                        
                        <?php if($user['is_vip']): ?>
                            <div class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-star-fill me-1"></i> VIP Member
                            </div>
                        <?php else: ?>
                            <div class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill border">
                                <i class="bi bi-person me-1"></i> Free Member
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="list-group list-group-flush rounded-4 p-2">
                        <a href="#account-general" data-bs-toggle="list" class="list-group-item list-group-item-action border-0 rounded-3 active p-3 mb-1">
                            <i class="bi bi-person-gear me-2 text-primary"></i> Thông tin cá nhân
                        </a>
                        <a href="#account-security" data-bs-toggle="list" class="list-group-item list-group-item-action border-0 rounded-3 p-3 mb-1">
                            <i class="bi bi-shield-lock me-2 text-primary"></i> Bảo mật & Mật khẩu
                        </a>
                        <a href="#account-billing" data-bs-toggle="list" class="list-group-item list-group-item-action border-0 rounded-3 p-3 mb-1">
                            <i class="bi bi-credit-card-2-front me-2 text-primary"></i> Gói thành viên
                        </a>
                        <a href="#account-history" data-bs-toggle="list" class="list-group-item list-group-item-action border-0 rounded-3 p-3 text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-9">
                <div class="tab-content">
                    
                    <div class="tab-pane fade show active" id="account-general">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-header bg-white border-bottom-0 p-4 pb-0">
                                <h5 class="fw-bold text-dark mb-0">Hồ sơ của tôi</h5>
                            </div>
                            <div class="card-body p-4">
                                <form>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">Tên đăng nhập</label>
                                            <input type="text" class="form-control bg-light border-0 py-2" value="<?php echo $user['username']; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">Họ và tên</label>
                                            <input type="text" class="form-control bg-light border-0 py-2" value="<?php echo $user['fullname']; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">Email</label>
                                            <input type="email" class="form-control bg-light border-0 py-2" value="<?php echo $user['email']; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">Số điện thoại</label>
                                            <input type="text" class="form-control bg-light border-0 py-2" value="<?php echo $user['phone']; ?>">
                                        </div>
                                        <div class="col-12 mt-4 text-end">
                                            <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Lưu thay đổi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="account-security">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-header bg-white border-bottom-0 p-4 pb-0">
                                <h5 class="fw-bold text-dark mb-0">Đổi mật khẩu</h5>
                            </div>
                            <div class="card-body p-4">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-secondary">Mật khẩu hiện tại</label>
                                        <input type="password" class="form-control bg-light border-0 py-2">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-secondary">Mật khẩu mới</label>
                                        <input type="password" class="form-control bg-light border-0 py-2">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-secondary">Xác nhận mật khẩu mới</label>
                                        <input type="password" class="form-control bg-light border-0 py-2">
                                    </div>
                                    <div class="alert alert-light border border-info d-flex align-items-center" role="alert">
                                        <i class="bi bi-info-circle-fill text-info me-2"></i>
                                        <small class="text-muted">Mật khẩu nên có ít nhất 8 ký tự, bao gồm chữ hoa và số.</small>
                                    </div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Cập nhật mật khẩu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="account-billing">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-header bg-white border-bottom-0 p-4 pb-0">
                                <h5 class="fw-bold text-dark mb-0">Trạng thái gói</h5>
                            </div>
                            <div class="card-body p-4">
                                <?php if($user['is_vip']): ?>
                                    <div class="bg-warning bg-opacity-10 border border-warning rounded-4 p-4 text-center mb-4">
                                        <div class="mb-3">
                                            <i class="bi bi-crown display-4 text-warning"></i>
                                        </div>
                                        <h4 class="fw-bold text-dark">Bạn đang là thành viên VIP</h4>
                                        <p class="text-muted">Cảm ơn bạn đã đồng hành cùng TechShare. Bạn có quyền truy cập toàn bộ tài liệu.</p>
                                        <hr class="border-warning opacity-25 my-4">
                                        <div class="d-flex justify-content-center gap-4">
                                            <div>
                                                <small class="text-muted d-block">Ngày đăng ký</small>
                                                <span class="fw-bold">15/01/2026</span>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Ngày hết hạn</small>
                                                <span class="fw-bold text-danger">15/06/2026</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="bi bi-box-seam display-4 text-secondary"></i>
                                        </div>
                                        <h4 class="fw-bold">Gói miễn phí</h4>
                                        <p class="text-muted mb-4">Nâng cấp lên VIP để tải tài liệu không giới hạn và xem đáp án chi tiết.</p>
                                        <a href="index.php?page=payment" class="btn btn-warning rounded-pill px-5 py-2 fw-bold shadow-sm">
                                            Nâng cấp ngay <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                     <div class="tab-pane fade" id="account-history">
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3 text-muted">Đang đăng xuất...</p>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var triggerTabList = [].slice.call(document.querySelectorAll('#account-history-tab'))
                                });
                            </script>
                        </div>
                     </div>

                </div>
            </div>
        </div>
    </div>
</div>