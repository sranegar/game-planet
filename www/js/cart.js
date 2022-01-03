

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

    window.location.reload(true);
}

//ajax request to remove items from cart asynchronously
function deleteAll(g_id) {
    var xmlHttp;

    //create an XHR object
    xmlHttp = new XMLHttpRequest();

    // define an ajax request //this includes query string variable
    xmlHttp.open("GET", base_url + "/" + cart + "/delete/" + g_id, true);

    //handle server's responses and parse JSON object returned from server
    xmlHttp.onload = function (name) {
        var result = JSON.parse(xmlHttp.responseText); //parse JSON object from server
        console.log(result);
    }

    // make the request to the server
    //we can't send additional data because we used the GET method. POST method would allow us to send additional data.
    xmlHttp.send(null);

    window.location.reload(true);
}


