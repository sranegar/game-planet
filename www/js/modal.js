var modalBtn = document.getElementById('show');
var modal = document.getElementById('modal');
var s = document.getElementById("s");


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

