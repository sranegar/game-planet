/*
 * Author: Stephanie Ranegar
 * Date: 12/2/2021
 * This script contains AJAX methods and logic for autosuggestion
 */
var xmlHttp;
var numTitles = 0;  //total number of suggested game titles
var activeTitle = -1;  //game title currently being selected
var searchBoxObj, suggestionBoxObj;

//create XMLHttpRequest object
function createXmlHttpRequestObject() {
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

//initial actions on page load
window.onload = function () {
    //create an XMLHttpRequest object
    xmlHttp = createXmlHttpRequestObject();

    //DOM objects
    searchBoxObj = document.getElementById('search');
    suggestionBoxObj = document.getElementById('suggestionDiv');
};

window.onclick = function () {
    suggestionBoxObj.style.display = 'none';
};

//set and send XMLHttp request
function suggest(query) {
    //if the search term is empty, clear the suggestion box.
    if (query === "") {
        suggestionBoxObj.innerHTML = "";
        return;
    }

    //proceed only if the search term isn't empty
    // open an asynchronous request to the server.
    xmlHttp.open("GET", base_url + "/" + media + "/suggest/" + query, true);

    //handle server's responses
    xmlHttp.onreadystatechange = function () {
        // proceed only if the transaction has completed and the transaction completed successfully
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            // extract the JSON from the server
            var titles = JSON.parse(xmlHttp.responseText);
            // details suggested titles in div block
            displayTitles(titles);
        }
    };

    //send the request
    xmlHttp.send(null);
}


//populate the suggestion box with spans containing all the game titles
function displayTitles(titles) {
    numTitles = titles.length;

    activeTitle = -1;
    if (numTitles === 0) {
        //hide all suggestions
        suggestionBoxObj.style.display = 'none';
        return false;
    }

    var divContent = "";
    //retrieve the game titles from JSON and create a new span for each game title
    for (i = 0; i < titles.length; i++) {
        divContent += "<span id=s_" + i + " onclick='clickTitle(this)'>" + titles[i] + "</span>";
    }
    //details spans in div block
    suggestionBoxObj.innerHTML = divContent;
    suggestionBoxObj.style.display = 'block';
}

//Handle keyup event for every keystroke
function handleKeyUp(e) {
    // get the key event for different browsers
    e = (!e) ? window.event : e;

    /* if the keystroke is not up arrow or down arrow key,
     * call the suggest function and pass the content of the search box
     */
    if (e.keyCode !== 38 && e.keyCode !== 40) {
        suggest(e.target.value);
        return;
    }

    //handle up arrow key pressed
    if (e.keyCode === 38 && activeTitle > 0) {
        activeTitleObj.style.backgroundColor = "#FFF";
        activeTitle--;
        activeTitleObj = document.getElementById("s_" + activeTitle);
        activeTitleObj.style.backgroundColor = "#2B50C8F9";
        activeTitleObj.style.color = "#000";
        searchBoxObj.value = activeTitleObj.innerHTML;
        return;
    }

    //handle the down arrow key pressed
    if (e.keyCode === 40 && activeTitle < numTitles - 1) {
        if (typeof (activeTitleObj) != "undefined") {
            activeTitleObj.style.backgroundColor = "#FFFFFF";
        }
        activeTitle++;
        activeTitleObj = document.getElementById("s_" + activeTitle);
        activeTitleObj.style.backgroundColor = "#2B50C8F9";
        searchBoxObj.value = activeTitleObj.innerHTML;
    }
}


//when a title is clicked, fill the search box with the title and then hide the suggestion list
function clickTitle(title) {
    //details the title in the search box
    searchBoxObj.value = title.innerHTML;

    //hide all suggestions
    suggestionBoxObj.style.display = 'none';
}

$('.post-wrapper').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 6000,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
});