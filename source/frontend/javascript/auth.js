document.addEventListener('DOMContentLoaded', function() {
    Handle_Register();
    Handle_Login();
});

function Handle_Login() {
    const Login_Form = document.querySelector('#Login');

    if (Login_Form) {
        Login_Form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            const formData = new FormData(this);

            fetch('backend/api/auth-login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = 'index.php?page=courses';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Lỗi Login:', error);
                alert('Không thể kết nối tới server!');
            });
        });
    }
}

function Handle_Register() {
    const Register_Form = document.querySelector('#Register');

    if (Register_Form) {
        Register_Form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            const formData = new FormData(this);

            fetch('backend/api/auth-register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Đăng ký thành công! Vui lòng đăng nhập.');
                    window.location.href = 'index.php?page=login';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Lỗi Register:', error);
                alert('Không thể kết nối tới server!');
            });
        });
    }
}