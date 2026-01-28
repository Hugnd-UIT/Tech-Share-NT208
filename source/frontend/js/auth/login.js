function Handle_Login() {
    const Login_Form = document.querySelector('#Login');

    if (Login_Form) {
        Login_Form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            const Data = new FormData(this);

            fetch('./backend/api/login.php', {
                method: 'POST',
                body: Data
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = '#home';
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