async function load_header() {
    try {
        const response_1 = await fetch('frontend/components/header.html');
        document.getElementById('header-placeholder').innerHTML = await response_1.text();
        
        const response_2 = await fetch('backend/api/profile.php');
        const data = await response_2.json();

        const guestBox = document.getElementById('guest-actions');
        const userBox = document.getElementById('user-actions');
        const userAvatar = document.getElementById('header-avatar');

        if (data.status === 'success') {
            if (userBox) userBox.classList.remove('d-none');

            if (guestBox) guestBox.classList.add('d-none');
            
            if (userAvatar && data.avatar) {
                userAvatar.src = 'frontend/assets/image/' + data.avatar;
            }
        } else {
            if (guestBox) {
                guestBox.classList.remove('d-none');
                guestBox.classList.add('d-flex'); 
            }

            if (userBox) userBox.classList.add('d-none');
        }
    } catch (error) {
        console.error(error);
    }
}

async function load_footer() {
    try {
        const response = await fetch('frontend/components/footer.html');
        document.getElementById('footer-placeholder').innerHTML = await response.text();
    } catch (error) {
        console.error(error);
    }
}