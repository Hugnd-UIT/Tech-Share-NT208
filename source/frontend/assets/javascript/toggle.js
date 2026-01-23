function toggle(element, Id) {
    const input = document.getElementById(Id);
    const eyeOpen = element.querySelector('.eye-open');
    const eyeClosed = element.querySelector('.eye-closed');

    if (input.type === "password") {
        input.type = "text";
        eyeOpen.classList.remove('d-none');  
        eyeClosed.classList.add('d-none');  
    } else {
        input.type = "password";
        eyeOpen.classList.add('d-none');  
        eyeClosed.classList.remove('d-none'); 
    }
}