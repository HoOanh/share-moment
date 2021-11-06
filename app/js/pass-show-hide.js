const showIcon = document.querySelector(".field i");
const passField = document.querySelector("input[type='password']");


showIcon.addEventListener("click", function() {

    if (passField.getAttribute("type") == 'password') {
        passField.setAttribute("type", 'text');
        showIcon.classList.add("active");
    } else {
        passField.setAttribute("type", 'password');
        showIcon.classList.remove("active");
    }
});