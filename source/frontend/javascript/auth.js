document.addEventListener('DOMContentLoaded', function() {
    Handle_Register();
    Handle_Contact();
    Handle_Logout();
    Handle_Login();
});

function Handle_Contact() {
    const Contact_Form = document.querySelector('#Contact');

    if (Contact_Form) {
        Contact_Form.addEventListener('submit', function(e) {
            e.preventDefault();
            const Data = new FormData(this);

            fetch('./backend/api/auth-contact.php', {
                method: 'POST',
                body: Data
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Đã gửi tin nhắn của bạn!');
                    Contact_Form.reset();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Không thể kết nối với server!')
            });
        })
    }
}

function Handle_Login() {
    const Login_Form = document.querySelector('#Login');

    if (Login_Form) {
        Login_Form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            const Data = new FormData(this);

            fetch('./backend/api/auth-login.php', {
                method: 'POST',
                body: Data
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
                alert('Không thể kết nối tới server!');
            });
        });
    }
}

function Handle_Logout() {
    const Logout_Button = document.querySelector('#Logout');

    if (Logout_Button) {
        Logout_Button.addEventListener('click', function(e) {
            e.preventDefault();
            alert('Bạn có chắc chắn muốn đăng xuất?');

            fetch('./backend/api/auth-logout.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = 'index.php?page=home';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Không thể kết nối tới server!');
            })
        })
    }
}

function Handle_Register() {
    const Register_Form = document.querySelector('#Register');

    if (Register_Form) {
        Register_Form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            const Data = new FormData(this);
            
            fetch('./backend/api/auth-register.php', {
                method: 'POST',
                body: Data
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
                alert('Không thể kết nối tới server!');
            });
        });
    }
}