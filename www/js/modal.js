var modalBtn = document.getElementById('show');
var modal = document.getElementById('modal');
var s = document.getElementById("s");
var b = document.getElementById("b");

var games_id;

//create XMLHttpRequest object
function createXmlHttp() {
    // create a XMLHttpRequest object
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        alert("There was an error creating the XMLHttpRequest object.");
        return false;
    }
}


//create an XMLHttpRequest object
xmlHttp = createXmlHttp();

//DOM objects
games_id = document.getElementById('id');

//retrieve value of input
var id = games_id.value;


function added_to_cart() {

    var xmlHttp;

    //create an XHR object
    xmlHttp = new XMLHttpRequest();

    // define an ajax request //this includes query string variable
    xmlHttp.open("GET", base_url + "/" + media + "/buy/" + id, true);

    // handles server's responses when the HTTP request has successfully completed with an anonymous function
    //handle server's responses
    xmlHttp.onload = function () {
        var resultJSON = JSON.parse(xmlHttp.responseText);
        var result = resultJSON.result;

    }

    // make the request to the server
    //we can't send additional data because we used the GET method. POST method would allow us to send additional data.
    xmlHttp.send(null);
}

//function for opening modal and adding game to cart asynchronously
function openModal() {
    modal.classList.toggle("modal-hidden");
    added_to_cart();
}

//function for closing modal
function closeModal() {
    modal.classList.toggle("modal-hidden");
    //reload page after closing modal to show updating cart quantity
    window.location.reload(true);
}

//event listeners
//open modal and add game to cart
modalBtn.addEventListener("click", openModal);

//close modal and refresh page to update cart qty
s.addEventListener("click", closeModal);
b.addEventListener("click", closeModal);
