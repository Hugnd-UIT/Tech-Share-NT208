function Load_Profile() {
    const fullname = document.getElementById('user-fullname');
    const email = document.getElementById('user-email');
    const avatar = document.getElementById('user-avatar');
    const badge = document.getElementById('vip-badge-container');
    const membership = document.getElementById('membership-content');

    fetch('backend/api/profile.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('input-username').value = data.username;
            document.getElementById('sec-email-display').innerText = data.email;
            document.getElementById('input-fullname').value = data.full_name;
            document.getElementById('input-email').value = data.email;
            document.getElementById('input-role').value = data.role;

            if (fullname) {
                fullname.textContent = data.full_name || data.username;
            }

            if (email) {
                email.textContent = data.email;
            }

            if (avatar) {
                const name = encodeURIComponent(data.full_name || data.username);
                avatar.src = `https://ui-avatars.com/api/?name=${name}&background=random`;
            }

            if (badge) {
                if (data.is_vip) {
                    badge.innerHTML = `
                        <div class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill border border-warning" style="display: inline-flex; align-items: center;">
                            <i class="bi bi-star-fill" style="margin-right: 6px; line-height: 1;"></i> VIP Member
                        </div>
                    `;
                } else {
                    badge.innerHTML = `
                        <div class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill border">
                            <i class="bi bi-person me-1"></i> Member
                        </div>
                    `;
                }
            }

            if (membership) {
                if (data.is_vip) {
                    const today = new Date();
                    const exp = new Date(data.vip_expiration_date);
                    const diff = Math.ceil(Math.abs(exp - today) / (1000 * 60 * 60 * 24));
                    
                    membership.innerHTML = `
                        <div class="text-center mb-4">
                            <div class="badge bg-warning text-dark fw-bold rounded-pill px-3 mb-2 d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2"></i> <span>Đang hoạt động</span>
                            </div>
                            
                            <h3 class="fw-bold text-primary mb-2">Gói VIP Member</h3>
                            
                            <div class="d-flex justify-content-center">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-4 py-2 d-inline-flex align-items-center">
                                    <i class="bi bi-tag-fill me-2 fs-6"></i> 
                                    <span class="text-primary style="transform: translateY(1px);">Giá trị: 50.000đ</span>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 text-center h-100">
                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Hết hạn</small>
                                    <span class="fw-bold text-dark">${new Date(data.vip_expiration_date).toLocaleDateString('vi-VN')}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-warning-subtle rounded-3 text-center h-100 border border-warning border-opacity-25">
                                    <small class="text-warning-emphasis d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Còn lại</small>
                                    <span class="fw-bold text-warning-emphasis">${diff} Ngày</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-4 p-4 border shadow-sm">
                            <h6 class="fw-bold text-dark mb-3 text-uppercase border-bottom pb-2">
                                <i class="bi bi-gift-fill text-danger me-2"></i>Quyền lợi đặc quyền:
                            </h6>
                            
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success fs-5 me-3 flex-shrink-0"></i>
                                    <span class="text-secondary fw-semibold lh-sm">Truy cập không giới hạn <span class="text-dark">tất cả môn học</span></span>
                                </li>
                                
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success fs-5 me-3 flex-shrink-0"></i>
                                    <span class="text-secondary fw-semibold lh-sm">Tải xuống <span class="text-dark"> tài liệu </span> tốc độ cao</span>
                                </li>
                                
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success fs-5 me-3 flex-shrink-0"></i>
                                    <span class="text-secondary fw-semibold lh-sm">Ưu tiên hỗ trợ và giải đáp thắc mắc</span>
                                </li>
                                
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success fs-5 me-3 flex-shrink-0"></i>
                                    <span class="text-secondary fw-semibold lh-sm">Hướng dẫn học các môn học</span>
                                </li>

                                <li class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success fs-5 me-3 flex-shrink-0"></i>
                                    <span class="text-secondary fw-semibold lh-sm">Trải nghiệm mượt mà, <span class="text-danger">không quảng cáo</span></span>
                                </li>
                            </ul>
                        </div>
                    `;
                } else {
                    membership.innerHTML = `
                        <div class="text-center py-3">
                            <i class="bi bi-box-seam display-4 text-muted mb-3"></i>
                            <h5 class="fw-bold">Bạn đang dùng gói miễn phí</h5>
                            <p class="text-muted small mb-4">Nâng cấp lên VIP để mở khóa toàn bộ tài liệu và tính năng.</p>
                            <a href="#discover" class="btn btn-outline-primary rounded-pill fw-bold w-100">
                                <i class="bi bi-gem me-2"></i>Nâng cấp VIP
                            </a>
                        </div>
                    `;
                }
            }
        } else {
            console.error('Lỗi:', data.message);
        }
    })
    .catch(err => {
        console.error(err);
        if (fullname) fullname.textContent = 'Lỗi kết nối';
    });
}