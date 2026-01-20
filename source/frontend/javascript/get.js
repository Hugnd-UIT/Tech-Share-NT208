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

function Load_Profile() {
    const fullname = document.getElementById('user-fullname');
    const email = document.getElementById('user-email');
    const avatar = document.getElementById('user-avatar');
    const Badge = document.getElementById('vip-badge-container');

    fetch('backend/api/get-profile.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('input-username').value = data.username;
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

            if (Badge) {
                if (data.is_vip) {
                    Badge.innerHTML = `
                        <div class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill border border-warning" style="display: inline-flex; align-items: center;">
                            <i class="bi bi-star-fill" style="margin-right: 6px; line-height: 1;"></i> VIP Member
                        </div>
                    `;
                } else {
                    Badge.innerHTML = `
                        <div class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill border">
                            <i class="bi bi-person me-1"></i> Member
                        </div>
                    `;
                }
            }
        } else {
            console.error('Lỗi:', data.message);
            if (fullname) fullname.textContent = 'Lỗi tải dữ liệu';
            if (email) email.textContent = data.message;
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
        if(titleEl) titleEl.innerHTML = `<i class="bi bi-book-half me-2"></i> ${doc.title}`;
        
        const viewer = document.getElementById('viewer-content');
        if(viewer) viewer.innerHTML = `<iframe src="${doc.file_path}" style="width:100%; height:80vh; border:none;"></iframe>`;

        const btnDown = document.getElementById('btn-download');
        if(btnDown) {
            btnDown.classList.remove('d-none');
            btnDown.href = doc.file_path;
            btnDown.setAttribute('download', '');
        }
    };

    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

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
                    Group_Name = Parts.slice(0, Parts.length - 1).join(' <span class="text-muted mx-1">/</span> ');
                    Display_Title = Parts[Parts.length - 1].trim();
                }

                if (!Groups[Group_Name]) {
                    Groups[Group_Name] = [];
                }
                Groups[Group_Name].push({ ...doc, shortTitle: Display_Title, originalIndex: index });
            });

            for (const [Group_Name, items] of Object.entries(Groups)) {
                Sidebar.innerHTML += `
                    <div class="bg-light fw-bold text-dark px-3 py-2 border-bottom border-top small text-uppercase mt-2 text-truncate" title="${Group_Name.replace(/<[^>]*>/g, '')}">
                        <i class="bi bi-folder2-open me-1 text-warning"></i> ${Group_Name}
                    </div>
                `;

                items.forEach(item => {
                    let Icon = item.file_type === 'pdf' ? 'bi-file-pdf-fill text-danger' : 'bi-file-earmark-code-fill text-primary';
                    
                    Sidebar.innerHTML += `
                        <button class="list-group-item list-group-item-action py-2 ps-4 border-0 border-bottom" 
                                onclick="View_Document(${item.originalIndex})" 
                                id="doc-btn-${item.originalIndex}">
                            <div class="d-flex align-items-center">
                                <i class="bi ${Icon} me-2 fs-5"></i>
                                <span class="small fw-semibold text-truncate">${item.shortTitle}</span>
                            </div>
                        </button>
                    `;
                });
            }

            if(data.data.length > 0) window.View_Document(0);

        } else {
            Sidebar.innerHTML = `<div class="p-3 text-danger">${data.message}</div>`;
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
            
            Count.textContent = `Hiển thị ${data.data.length} môn học`;

            data.data.forEach(course => {
                const Vip = course.is_vip == 1; 
                
                let Action_Button = '';

                if (Vip) {
                    if (data.is_vip === false)
                    Action_Button = `
                        <a href="index.php?page=payment" class="btn btn-warning w-100 fw-bold rounded-pill text-dark shadow-sm">
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
                    <div class="col-md-6 col-xl-4">
                        <div class="card h-100 border-0 shadow-sm hover-up rounded-4">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-light text-primary border border-primary-subtle rounded-pill px-3">
                                        ${course.subject_code}
                                    </span>
                                    ${Vip ? '<span class="badge bg-warning text-dark rounded-pill"><i class="bi bi-star-fill"></i> VIP</span>' : ''}
                                </div>
                                
                                <h5 class="fw-bold text-dark mb-2 text-truncate" title="${course.subject_name}">
                                    ${course.subject_name}
                                </h5>
                                
                                <p class="text-muted small mb-4 flex-grow-1">
                                    ${course.category} • ${course.credits} TC
                                </p>
                                
                                <div class="mt-auto">
                                    ${Action_Button}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                List.innerHTML += html;
            });
        } else {
            List.innerHTML = '<div class="col-12 text-center text-muted">Chưa có môn học nào.</div>';
        }
    })
    .catch(error => {
        document.getElementById('course-list').innerHTML = '<div class="col-12 text-center text-danger">Lỗi tải dữ liệu!</div>';
    });
}