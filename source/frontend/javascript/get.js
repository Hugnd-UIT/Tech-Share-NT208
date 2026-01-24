document.addEventListener('DOMContentLoaded', function() {
    const Detail = document.getElementById('sidebar-list');
    const Course = document.getElementById('course-list');
    const Profile = document.getElementById('account-general');

    if (Detail) {
        Load_Details();
    } 
    
    if (Course) {
        Load_Courses();
    }

    if (Profile) {
        Load_Profile();
    }
});

function XSS_Defend(text) {
    if (!text) return text;
    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function Load_Profile() {
    const fullname = document.getElementById('user-fullname');
    const email = document.getElementById('user-email');
    const avatar = document.getElementById('user-avatar');
    const badge = document.getElementById('vip-badge-container');
    const membership = document.getElementById('membership-content');

    fetch('backend/api/get-profile.php')
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
                                    <span style="transform: translateY(1px);">Giá trị: 50.000đ</span>
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
                            <a href="index.php?page=discover" class="btn btn-outline-primary rounded-pill fw-bold w-100">
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

function Load_Details() {
    const Sidebar = document.getElementById('sidebar-list');
    
    window.View_Document = function(index) {
        const doc = window.currentDocuments[index];
        if(!doc) return;

        document.querySelectorAll('.list-group-item').forEach(el => 
            el.classList.remove('active', 'bg-primary-subtle', 'text-primary')
        );

        const btn = document.getElementById(`doc-btn-${index}`);
        if(btn) btn.classList.add('active', 'bg-primary-subtle', 'text-primary');

        const titleEl = document.getElementById('viewer-title');
        if(titleEl) titleEl.innerHTML = `<i class="bi bi-book-half me-2"></i> ${XSS_Defend(doc.title)}`;
        
        const api = `../backend/api/get-download.php?id=${doc.id}`;

        const viewer = document.getElementById('viewer-content');
        if(viewer) viewer.innerHTML = `<iframe src="${api}&action=view" style="width:100%; height:80vh; border:none;"></iframe>`;

        const btnDown = document.getElementById('btn-download');
        if(btnDown) {
            btnDown.classList.remove('d-none');
            btnDown.href = `${api}&action=download`;
        }
    };

    const id = new URLSearchParams(window.location.search).get('id');

    if (!id) {
        Sidebar.innerHTML = '<div class="text-danger p-3">Không tìm thấy ID!</div>';
        return;
    }

    fetch(`backend/api/get-details.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.subject) {
                const nameEl = document.getElementById('header-subject-name');
                const codeEl = document.getElementById('header-subject-code');
                if(nameEl) nameEl.textContent = data.subject.subject_name;
                if(codeEl) codeEl.textContent = data.subject.subject_code;
            }

            Sidebar.innerHTML = ''; 
            window.currentDocuments = data.data; 

            if (!data.data || data.data.length === 0) {
                Sidebar.innerHTML = '<div class="p-3 text-muted">Chưa có tài liệu.</div>';
                return;
            }

            const Groups = {};

            data.data.forEach((doc, index) => {
                let Parts = doc.title.split('/'); 
                
                let Group_Name = "Tài liệu chung";
                let Display_Title = doc.title; 

                if (Parts.length > 1) {
                    Group_Name = Parts.slice(0, Parts.length - 1)
                        .map(part => XSS_Defend(part))
                        .join(' <span class="text-muted mx-1">/</span> ');
                    Display_Title = Parts[Parts.length - 1].trim();
                }

                if (!Groups[Group_Name]) {
                    Groups[Group_Name] = [];
                }
                Groups[Group_Name].push({ ...doc, shortTitle: Display_Title, originalIndex: index });
            });

            for (const [Group_Name, items] of Object.entries(Groups)) {
                Sidebar.innerHTML += `
                    <div class="list-group-folder text-truncate" title="${Group_Name.replace(/<[^>]*>/g, '')}">
                        <i class="bi bi-folder2-open me-2 text-warning"></i> ${Group_Name}
                    </div>
                `;

                items.forEach(item => {
                    let Icon = item.file_type === 'pdf' ? 'bi-file-pdf-fill text-danger' : 'bi-file-earmark-code-fill text-primary';
                    
                    Sidebar.innerHTML += `
                        <button class="list-group-item list-group-item-action" 
                                onclick="View_Document(${item.originalIndex})" 
                                id="doc-btn-${item.originalIndex}">
                            <div class="d-flex align-items-center">
                                <i class="bi ${Icon} me-3 fs-6"></i>
                                <span class="text-truncate">${XSS_Defend(item.shortTitle)}</span>
                            </div>
                        </button>`;
                });
            }

            if(data.data.length > 0) window.View_Document(0);

        } else {
            Sidebar.innerHTML = `<div class="p-3 text-danger">${XSS_Defend(data.message)}</div>`;
        }
    })
    .catch(err => console.error(err));
}

function Load_Courses() {
    fetch('backend/api/get-courses.php') 
    .then(response => response.json())
    .then(data => {
        const List = document.getElementById('course-list');
        const Count = document.getElementById('course-count');

        if (data.status === 'success' && data.data.length > 0) {
            List.innerHTML = '';
            
            Count.innerHTML = `<i class="bi bi-database me-1"></i> Hiển thị ${data.data.length} môn học`;

            data.data.forEach(course => {
                const Vip = course.is_vip == 1; 
                
                let Action_Button = '';

                if (Vip) {
                    if (data.is_vip === false)
                    Action_Button = `
                        <a href="index.php?page=discover" class="btn btn-warning w-100 fw-bold rounded-pill text-dark shadow-sm">
                            <i class="bi bi-lock-fill me-1"></i> Mở khóa ngay
                        </a>`;
                    else 
                    Action_Button = `
                        <a href="index.php?page=details&id=${course.id}" class="btn btn-outline-primary w-100 fw-bold rounded-pill">
                            <i class="bi bi-folder2-open me-1"></i> Xem tài liệu
                        </a>`;
                } else {
                    Action_Button = `
                        <a href="index.php?page=details&id=${course.id}" class="btn btn-outline-primary w-100 fw-bold rounded-pill">
                            <i class="bi bi-folder2-open me-1"></i> Xem tài liệu
                        </a>`;
                }

                const html = `
                <div class="col-md-6 col-xl-4 course-item"> 
                    <div class="card h-100 border-0 shadow-sm hover-up rounded-4">
                        <div class="card-body p-4 d-flex flex-column" style="min-height: 250px;">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-light text-primary border border-primary-subtle rounded-pill px-3 course-code"> 
                                    ${XSS_Defend(course.subject_code)}
                                </span>
                                ${Vip ? '<span class="badge bg-warning text-dark rounded-pill"><i class="bi bi-star-fill"></i> VIP</span>' : ''}
                            </div>
                            
                            <h5 class="fw-bold text-dark mb-2 text-truncate course-name" title="${XSS_Defend(course.subject_name)}"> 
                                ${XSS_Defend(course.subject_name)}
                            </h5>
                            
                            <p class="text-muted small mb-4 flex-grow-1"> 
                                <span class="course-cat">${XSS_Defend(course.category)}</span> • ${XSS_Defend(course.credits)} TC
                            </p>
                            
                            <div class="mt-auto">
                                ${Action_Button}
                            </div>
                        </div>
                    </div>
                </div>`;
                
                List.innerHTML += html;
            });

            if (typeof filter_logic === 'function') {
                filter_logic();
            }
        } else {
            List.innerHTML = '<div class="col-12 text-center text-muted">Chưa có môn học nào.</div>';
        }
    })
    .catch(error => {
        const list = document.getElementById('course-list');
        if(list) list.innerHTML = '<div class="col-12 text-center text-danger">Lỗi tải dữ liệu!</div>';
    });
}