//Revision history:
//
//DEVELOPER               DATE           COMMENTS
//Vithursan Nagalingam    2022-12-07     Started creating ajax function

function searchPlayers()
{
    // get the textbox, and then the value it contains
    //var searchedPlayerTextbox = document.getElementById("searchedPlayerName");
    //var searchedPlayerString = searchedPlayerTextbox.value;
    
    var searchedPlayerString = document.getElementById("searchedPlayerName").value;
    
    var xhr = new XMLHttpRequest();
    
    xhr.open('POST', 'orders2.php'); // create that page and echo "...."
    
    // tell its not containing binary data
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function ()
    {
        // console.log('I got a new ready state ' + xhr.readyState);
        if (xhr.readyState === 4 && xhr.status === 200)
        {
            //alert(xhr.responseText); // AJAX(XML) : responseXML     AJAH HTML: responseTest
            document.getElementById("searchResults").innerHTML = xhr.responseText;
        }
    };
    
    xhr.send("searchedPlayer=" + searchedPlayerString);
}

function handleError(error)
{
    console.log('An error occured: ' + error);
}

function testJavaScript()
{
    try
    {
        var crash = new crash();
        alert("JavaScript works from an external fine");
    }
    catch(error)
    {
        handleError(error);
    }
}


