document.addEventListener('DOMContentLoaded', function() {
    Handle_Register();
    Handle_Contact();
    Handle_Confirm();
    Handle_Payment();
    Handle_Logout();
    Handle_Login();
    Handle_Reset();
});

function Handle_Payment() {
    const Discover_Form = document.querySelector('#Discover');

    if (Discover_Form) {
        Discover_Form.addEventListener('click', function(e) {
            e.preventDefault();

            fetch('./backend/api/auth-payment.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = 'index.php?page=payment&code=' + encodeURIComponent(data.code);
                } else {
                    alert(data.message);
                    window.location.href = 'index.php?page=login';
                }
            })
            .catch(error => {
                alert('Không thể kết nối với server!');
            })
        })
    }
}

function Handle_Confirm() {
    const Confirm_Form = document.querySelector('#Confirm');

    if (Confirm_Form) {
        Confirm_Form.addEventListener('submit', function(e) {
            e.preventDefault();
            const Data = new FormData(this);
            const token = new URLSearchParams(window.location.search).get('token');
            Data.append('token', token); 

            fetch('./backend/api/auth-confirm.php', {
                method: 'POST',
                body: Data
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = 'index.php?page=login';
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

function Handle_Reset() {
    const Reset_Form = document.querySelector('#Reset');

    if (Reset_Form) {
        Reset_Form.addEventListener('submit', function(e) {
            e.preventDefault();
            const Data = new FormData(this);

            fetch('./backend/api/auth-reset.php', {
                method: 'POST',
                body: Data
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = 'index.php?page=home';
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
                    alert(data.message);
                    Contact_Form.reset();
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
                    window.location.href = 'index.php?page=home';
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
                    alert(data.message);
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