var modalBtn = document.getElementById('show');
var modal = document.getElementById('modal');
var s = document.getElementById("s");
var b = document.getElementById("b");


function openModal() {
    modal.classList.toggle("modal-hidden");
    console.log("remove hidden class");
}
function closeModal() {
    modal.classList.toggle("modal-hidden");
    console.log("add hidden class");
}

modalBtn.addEventListener("click", openModal);
s.addEventListener("click", closeModal);
b.addEventListener("click", closeModal);

