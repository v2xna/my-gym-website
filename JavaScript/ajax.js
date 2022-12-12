//Revision history:
//
//DEVELOPER               DATE           COMMENTS
//Vithursan Nagalingam    2022-12-07     Started creating ajax function
//Vithursan Nagalingam    2022-12-12     Added javascript error handling for debugging


function searchOrders()
{
    // get the textbox, and the value it contains
    //var searchedOrderTextbox = document.getElementById("searchedOrderDate");
    //var searchedOrderString = searchedOrderTextbox.value;
    
    // extract the search value from the textbox
    //                                                 id of textbox      .value -> for textbox
    var searchedOrderString = document.getElementById("searchedOrderDate").value;
    
    //alert('I see you are searching for...' + searchedOrderString);
    
    // Create the object necessary for ajax
    var xhr = new XMLHttpRequest();
    
    // Specify the method and page / Establised a commucation with my search page
    xhr.open('POST', 'searchOrders.php');
    
    // to tell its not a form containing binary data
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Callback function (call the following function then do this...)
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState === 4 && xhr.status === 200)
        {
            // Receive information
            //alert(xhr.responseText);
            //                                       .innerHTML -> inside the div
            document.getElementById("searchResults").innerHTML = xhr.responseText;
        }
    }
    
    // Submits the form (sends the result / ajax call)
    //Pass information
    xhr.send("searchedOrder=" + searchedOrderString);
             // URL POST
}



// ====== This section is to help with debugging =======
function handleError(error)
{
    // Have to look in f12 debug console
    //console.log('An error occured: ' + error);
    
    // Pops up the error on the screen
    alert('An error occured: ' + error);
}

function testJavaScript()
{
    // equivalent of echo/var_dump = console.log
    //console.log('will try to create a crash object');
    
    
    try
    {
        var crash = new crash(); // this generates an error/exception
        alert("Javascript works from external file");
    }
    
    catch(error)
    {
        handleError(error);
    }
}
