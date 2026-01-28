function Handle_Register() {
    const Register_Form = document.querySelector('#Register');

    if (Register_Form) {
        Register_Form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            const Data = new FormData(this);
            
            fetch('./backend/api/register.php', {
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
                alert('Không thể kết nối tới server!');
            });
        });
    }
}