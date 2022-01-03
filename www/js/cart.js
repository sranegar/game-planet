
//get element by ID
var removeg = document.getElementsByClassName("remove-button");
var empty = document.getElementsByClassName("x");

var game;



//DOM objects
game = document.getElementById("g_id");
id = document.getElementsByClassName("gm-id");

var g;



//ajax request to remove items from cart asynchronously
function remove(g_id) {
    var xmlHttp;

    //create an XHR object
    xmlHttp = new XMLHttpRequest();

    // define an ajax request //this includes query string variable
    xmlHttp.open("GET", base_url + "/" + cart + "/remove/" + g_id, true);

    //handle server's responses and parse JSON object returned from server
    xmlHttp.onload = function (name) {
        var result = JSON.parse(xmlHttp.responseText); //parse JSON object from server
        console.log(result);
    }

    //we can't send additional data because we used the GET method. POST method would allow us to send additional data.
    xmlHttp.send(null);
}

//ajax request to remove items from cart asynchronously
function deleteGame() {

    var xmlHttp;

    //create an XHR object
    xmlHttp = new XMLHttpRequest();

    // define an ajax request //this includes query string variable
    xmlHttp.open("GET", base_url + "/" + cart + "/delete/" + g, true);

    // make the request to the server
    //we can't send additional data because we used the GET method. POST method would allow us to send additional data.
    xmlHttp.send(null);
}


//remove item when button is clicked
function removeItem(g) {
    for (x = 0; x < removeg.length; x++) {
        g_id = removeg[x].value;
    }
    remove(g_id);
    // window.location.reload(true);
}

function removeGame() {
    deleteGame();
    // window.location.reload(true);
}





for (var z = 0; z < empty.length; z++) {
    empty[z].addEventListener("click", removeGame, false);
}




