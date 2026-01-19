document.addEventListener('DOMContentLoaded', function() {
    Load_Courses();
});

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
                        <a href="index.php?page=detail" class="btn btn-outline-primary w-100 fw-bold rounded-pill">
                            <i class="bi bi-folder2-open me-1"></i> Xem tài liệu
                        </a>`;
                } else {
                    Action_Button = `
                        <a href="index.php?page=detail" class="btn btn-outline-primary w-100 fw-bold rounded-pill">
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