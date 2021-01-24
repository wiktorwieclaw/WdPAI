const hamburgerContainer = document.querySelector(".hamburger-container");
const hamburger = document.querySelector(".hamburger");
const sideBar =  document.querySelector(".side-bar");

let isVisible = false;

hamburgerContainer.addEventListener("click", function (){
    if(isVisible) {
        sideBar.classList.remove("side-bar-show");
        hamburger.classList.remove('open');
        isVisible = false;
    }
    else {
        sideBar.classList.add("side-bar-show");
        hamburger.classList.add('open');
        isVisible = true;
    }
})
