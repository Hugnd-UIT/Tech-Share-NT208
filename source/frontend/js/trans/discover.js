function Handle_Discover() {
    const Discover_Form = document.querySelector('#Discover');

    if (Discover_Form) {
        Discover_Form.addEventListener('click', function(e) {
            e.preventDefault();

            fetch('./backend/api/payment.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = '#payment?code=' + encodeURIComponent(data.code);
                } else {
                    alert(data.message);
                    window.location.href = '#login';
                }
            })
            .catch(error => {
                alert('Không thể kết nối với server!');
            })
        })
    }
}