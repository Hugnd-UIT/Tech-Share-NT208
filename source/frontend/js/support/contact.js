function Handle_Contact() {
    const Contact_Form = document.querySelector('#Contact');

    if (Contact_Form) {
        Contact_Form.addEventListener('submit', function(e) {
            e.preventDefault();
            const Data = new FormData(this);

            fetch('./backend/api/contact.php', {
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