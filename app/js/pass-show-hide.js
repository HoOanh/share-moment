const showIcon = document.querySelector(".wrraper .form .field i");
const passField = document.querySelector("input[type='password']");


showIcon.addEventListener("click", function() {
    console.log("ok");

    if (passField.getAttribute("type") == 'password') {
        passField.setAttribute("type", 'text');
        showIcon.classList.add("active");
    } else {
        passField.setAttribute("type", 'password');
        showIcon.classList.remove("active");
    }
});