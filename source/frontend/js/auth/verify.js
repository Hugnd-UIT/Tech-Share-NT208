function Handle_Verify() {
    const Comfirm_Form = document.querySelector('#Comfirm');

    if (Comfirm_Form) {
        Comfirm_Form.addEventListener('submit', function(e) {
            e.preventDefault();
            const Data = new FormData(this);
            const token = new URLSearchParams(window.location.hash.split('?')[1]).get('token');
            Data.append('token', token); 

            fetch('./backend/api/verify.php', {
                method: 'POST',
                body: Data
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = '#login';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Không thể kết nối với server!');
            })
        })
    }
}