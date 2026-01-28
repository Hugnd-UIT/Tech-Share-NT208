function Handle_Logout() {
    const Logout_Button = document.querySelector('#Logout');

    if (Logout_Button) {
        Logout_Button.addEventListener('click', function(e) {
            e.preventDefault();
            alert('Bạn có chắc chắn muốn đăng xuất?');

            fetch('./backend/api/logout.php', {
                method: 'POST'
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
            })
        })
    }
}