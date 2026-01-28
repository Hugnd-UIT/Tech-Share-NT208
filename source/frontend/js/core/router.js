const routes = {
    'home': 'frontend/pages/home.html',
    'login': 'frontend/pages/login.html',
    'register': 'frontend/pages/register.html',
    'courses': 'frontend/pages/courses.html',
    'profile': 'frontend/pages/profile.html',
    'contact': 'frontend/pages/contact.html',
    'payment': 'frontend/pages/payment.html',
    'discover': 'frontend/pages/discover.html',
    'reset': 'frontend/pages/reset.html',
    'verify': 'frontend/pages/verify.html',
    'details': 'frontend/pages/details.html',
    '404': '<div class="text-center mt-5"><h1>404 - Không tìm thấy trang</h1></div>'
};

const non_layout_pages = ['login', 'register', 'reset', 'verify', 'payment'];

async function routing() {
    let hash = window.location.hash.slice(1) || 'home';

    if (hash.includes('?')) {
        hash = hash.split('?')[0];
    }

    const url = routes[hash] || routes['404'];
    const app = document.getElementById('app-content'); 
    const hide = non_layout_pages.includes(hash);
    show_layout(hide); 

    if (!url) {
        app.innerHTML = routes['404'];
        return;
    }

    try {
        const response = await fetch(url);
        const html = await response.text();
        app.innerHTML = html;

        init_page(hash);

        window.scroll(0, 0);
    } catch (error) {
        console.error(error);
        app.innerHTML = '<h3 class="text-center mt-5 text-danger">Lỗi tải trang!</h3>';
    }
}

function show_layout(hide) {
    const header = document.getElementById('header-placeholder');
    const footer = document.getElementById('footer-placeholder');
    const main = document.getElementById('app-content');

    if (hide) {
        if (header) 
            header.style.display = 'none';
        if (footer)
            footer.style.display = 'none';
        if (main) 
            main.style.paddingTop = '0px';
    } else {
        if (header) {
            header.style.display = 'block';
            load_header();
        }

        if (footer) {
            footer.style.display = 'block';
            load_footer();
        }

        if (main) 
            main.style.paddingTop = '60px';
    }
}

function init_page(page) {
    if (page === 'login') {
        if (typeof Handle_Login === 'function') 
            Handle_Login();
    } else if (page === 'register') {
        if (typeof Handle_Register === 'function')
            Handle_Register();
    } else if (page === 'reset') {
        if (typeof Handle_Reset === 'function')
            Handle_Reset();
    } else if (page === 'verify') {
        if (typeof Handle_Verify === 'function')
            Handle_Verify();
    } else if (page === 'contact') {
        if (typeof Handle_Contact === 'function')
            Handle_Contact();
    } else if (page === 'discover') {
        if (typeof Handle_Discover === 'function')
            Handle_Discover(); 
    } else if (page === 'payment') {
        if (typeof Handle_Payment === 'function')
            Handle_Payment();
    } else if (page === 'logout') {
        if (typeof Handle_Logout === 'function')
            Handle_Logout();
    } else if (page === 'details') {
        if (typeof Load_Details === 'function')
            Load_Details();
    } else if (page === 'courses') {
        if (typeof Load_Courses === 'function')
            Load_Courses();
    } else if (page === 'profile') {
        if (typeof Handle_Logout === 'function')
            Handle_Logout();
        if (typeof Load_Profile === 'function')
            Load_Profile();
    } 
}

window.addEventListener('hashchange', routing);
window.addEventListener('DOMContentLoaded', routing);