var modalBtn = document.getElementById('show');
var modal = document.getElementById('modal');
var s = document.getElementById("s");
var b = document.getElementById("b");

var games_id;

//retrieve games_id from form



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
    games_id = document.getElementById('try');
    var id = games_id.value;



function added_to_cart() {

    var xmlHttp;
    //create an XHR object
    xmlHttp = new XMLHttpRequest();

    // define an ajax request //this includes query string variable
    xmlHttp.open("GET", base_url + "/" + media + "/buy/" + id, true);

    // handles server's responses when the HTTP request has successfully completed with an anonymous function
    //handle server's responses
    xmlHttp.onload = function() {
        var resultJSON = JSON.parse(xmlHttp.responseText);
        var result = resultJSON.result;

        games_id.innerHTML = id + " ELLO ";
        }

    // make the request to the server
    //we can't send additional data because we used the GET method. POST method would allow us to send additional data.
    xmlHttp.send(null);
}

function openModal(game) {
    modal.classList.toggle("modal-hidden");
    console.log("remove hidden class");
    added_to_cart();
}

function closeModal() {
    modal.classList.toggle("modal-hidden");
    console.log("add hidden class");
}

modalBtn.addEventListener("click", openModal);
s.addEventListener("click", closeModal);
b.addEventListener("click", closeModal);
