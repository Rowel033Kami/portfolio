const navbarMenu = document.querySelector(".navbar .links");
const hamburgerBtn = document.querySelector(".hamburger-btn");
const hideMenuBtn = navbarMenu.querySelector(".close-btn");
const showPopupBtn = document.querySelector(".login-btn");
const formPopup = document.querySelector(".form-popup");
const hidePopupBtn = formPopup.querySelector(".close-btn");
const signupLoginLink = formPopup.querySelectorAll(".bottom-link a");
const codehide = document.querySelector("#codehide");
const sendcode = document.querySelector("#codever");
const showverify = document.querySelector("#verifyaccount");
const signform = document.querySelector("#signform");
const verpage = document.querySelector("#verpage");


// Show mobile menu
hamburgerBtn.addEventListener("click", () => {
    navbarMenu.classList.toggle("show-menu");
});
hideMenuBtn.addEventListener("click", () =>  hamburgerBtn.click());

signupLoginLink.forEach(link => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        formPopup.classList[link.id === 'signup-link' ? 'add' : 'remove']("show-signup");
    });
});

//show hide otp code container
sendcode.addEventListener('submit', function() {
        codehide.style.display = "block";
});