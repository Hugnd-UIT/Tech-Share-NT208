function Load_Details() {
    const sidebar = document.getElementById('sidebar-list');
    
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
        
        const api = `../backend/api/download.php?id=${doc.id}`;

        const viewer = document.getElementById('viewer-content');
        if(viewer) viewer.innerHTML = `<iframe src="${api}&action=view" style="width:100%; height:80vh; border:none;"></iframe>`;

        const btnDown = document.getElementById('btn-download');
        if(btnDown) {
            btnDown.classList.remove('d-none');
            btnDown.href = `${api}&action=download`;
        }
    };

    const id = new URLSearchParams(window.location.hash.split('?')[1]).get('id');

    if (!id) {
        sidebar.innerHTML = '<div class="text-danger p-3">Không tìm thấy ID!</div>';
        return;
    }

    fetch(`backend/api/details.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.subject) {
                const nameEl = document.getElementById('header-subject-name');
                const codeEl = document.getElementById('header-subject-code');
                if(nameEl) nameEl.textContent = data.subject.subject_name;
                if(codeEl) codeEl.textContent = data.subject.subject_code;
            }

            sidebar.innerHTML = ''; 
            window.currentDocuments = data.data; 

            if (!data.data || data.data.length === 0) {
                sidebar.innerHTML = '<div class="p-3 text-muted">Chưa có tài liệu.</div>';
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
                sidebar.innerHTML += `
                    <div class="list-group-folder text-truncate" title="${Group_Name.replace(/<[^>]*>/g, '')}">
                        <i class="bi bi-folder2-open me-2 text-warning"></i> ${Group_Name}
                    </div>
                `;

                items.forEach(item => {
                    let Icon = item.file_type === 'pdf' ? 'bi-file-pdf-fill text-danger' : 'bi-file-earmark-code-fill text-primary';
                    
                    sidebar.innerHTML += `
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
            sidebar.innerHTML = `<div class="p-3 text-danger">${XSS_Defend(data.message)}</div>`;
        }
    })
    .catch(err => console.error(err));
}