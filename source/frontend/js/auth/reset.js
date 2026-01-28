function Handle_Reset() {
    const Reset_Form = document.querySelector('#Reset');

    if (Reset_Form) {
        Reset_Form.addEventListener('submit', function(e) {
            e.preventDefault();
            const Data = new FormData(this);

            fetch('./backend/api/reset.php', {
                method: 'POST',
                body: Data
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = '#home';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Không thể kết nối với server!');
            });
        })
    }
}
