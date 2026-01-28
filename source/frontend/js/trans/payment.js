function Handle_Payment() {
    const content = document.getElementById('content-display');
    const qr = document.getElementById('qr-image');

    if (content && qr) {
        let code = null;
        if (window.location.hash.includes('?')) {
            code = new URLSearchParams(window.location.hash.split('?')[1]).get("code");
        } else {
            code = new URLSearchParams(window.location.search).get("code");
        }

        const bank = "MB";
        const accountNo = "0388267745";
        const accountName = "NGUYEN DUY HUNG";
        const amount = "50000";

        if (!code) {
            content.innerText = 'LỖI: THIẾU MÃ GD';
            content.style.color = 'red';
            content.style.borderColor = 'red';
            qr.style.display = 'none';
        } else {
            content.innerText = code;
            qr.src = `https://img.vietqr.io/image/${bank}-${accountNo}-compact2.png?amount=${amount}&addInfo=${encodeURIComponent(code)}&accountName=${encodeURIComponent(accountName)}`;
        }
    }
}