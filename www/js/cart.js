//get element by ID
var removeBtn = document.getElementById('removeButton');

var game;

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
game = document.getElementById('g_id');

//retrieve value of input
var g = game.value;

//ajax request to remove items from cart asynchronously
function remove() {

    var xmlHttp;

    //create an XHR object
    xmlHttp = new XMLHttpRequest();

    // define an ajax request //this includes query string variable
    xmlHttp.open("GET", base_url + "/" + cart + "/remove/" + g, true);

    // handles server's responses when the HTTP request has successfully completed with an anonymous function
    //handle server's responses
    xmlHttp.onload = function () {
        var results = JSON.parse(xmlHttp.responseText);
        var result = results.result;
        removeItem(result);
    }

    // make the request to the server
    //we can't send additional data because we used the GET method. POST method would allow us to send additional data.
    xmlHttp.send(null);
}

//remove item when button is clicked
function removeItem() {
    remove();
    console.log("clicked");
    window.location.reload(true);
}

//add event listener
removeBtn.addEventListener("click", removeItem);