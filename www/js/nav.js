const games = document.getElementById("vg");
const categories = document.getElementById("cat")
const second = document.getElementById("second");

games.addEventListener("click", mobileMenu);


function mobileMenu() {
    second.classList.toggle("g-active");
    categories.classList.toggle("categories");
    console.log("reverse");
    console.log("clicked!")
}

