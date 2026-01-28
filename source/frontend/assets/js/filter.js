function filter() {
    const searchInput = document.getElementById('search-input');
    const searchBtn = document.getElementById('search-btn');         
    const filterBtn = document.getElementById('apply-filter-btn');   
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const courseList = document.getElementById('course-list');
    const countLabel = document.getElementById('course-count');

    const executeFilter = () => {
        const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';

        const activeCategories = Array.from(filterCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value.toLowerCase());

        const courses = Array.from(courseList.children).filter(col => col.classList.contains('course-item'));
        
        let visibleCount = 0;
        let hasResult = false;

        courses.forEach(col => {
            const name = col.querySelector('.course-name')?.textContent.toLowerCase() || '';
            const code = col.querySelector('.course-code')?.textContent.toLowerCase() || '';
            const cat = col.querySelector('.course-cat')?.textContent.toLowerCase() || '';

            const matchesSearch = searchTerm === '' || name.includes(searchTerm) || code.includes(searchTerm);
            const matchesCategory = activeCategories.length === 0 || activeCategories.some(ac => cat.includes(ac));

            if (matchesSearch && matchesCategory) {
                col.classList.remove('d-none');
                visibleCount++;
                hasResult = true;
            } else {
                col.classList.add('d-none');
            }
        });

        if (countLabel) countLabel.innerHTML = `<i class="bi bi-database me-1"></i> Hiển thị ${visibleCount} môn học`;

        let noMsg = document.getElementById('no-result-msg');
        if (!hasResult) {
            if (!noMsg) {
                noMsg = document.createElement('div');
                noMsg.id = 'no-result-msg';
                noMsg.className = 'col-12 text-center py-5';
                noMsg.innerHTML = `<div class="text-muted"><i class="bi bi-search display-1 opacity-25"></i><p class="mt-3 fw-bold fs-5">Không tìm thấy kết quả.</p></div>`;
                courseList.appendChild(noMsg);
            } else {
                noMsg.classList.remove('d-none');
            }
        } else if (noMsg) {
            noMsg.classList.add('d-none');
        }
    };

    if (searchBtn) {
        searchBtn.onclick = function(e) {
            e.preventDefault(); 
            executeFilter();
        };
    }

    if (searchInput) {
        searchInput.onkeypress = function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                executeFilter();
            }
        };
    }
    
    if (filterBtn) {
        filterBtn.onclick = function(e) {
            e.preventDefault();
            executeFilter();
        };
    }
}