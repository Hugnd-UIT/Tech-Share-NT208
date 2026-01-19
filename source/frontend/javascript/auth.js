document.addEventListener('DOMContentLoaded', function() {
    const Register = document.querySelector('#Register');
    const Login = document.querySelector('#Login');

    if (Login) {
        Login.addEventListener('submit', function(e) {
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
                console.error('Lỗi:', error);
                alert('Không thể kết nối tới server!');
            });
        });
    }

    if (Register) {
        Register.addEventListener('submit', function(e) {
            e.preventDefault(); 
            const formData = new FormData(this);

            fetch('backend/api/auth-register.php', {
                method: 'POST',
                body: formData
            })

            .then(response => response.json()) 
            
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = 'index.php?page=login';
                } else {
                    alert(data.message);
                }
            })

            .catch(error => {
                console.error('Lỗi:', error);
                alert('Không thể kết nối tới server!');
            });
        });
    }
});