  
async function sendRequest()
{

    return new Promise(function (resolve, reject) {

      let request = new XMLHttpRequest();

      request.onreadystatechange = function ()
      {
          if(request.readyState === 4)
          {
              console.log("Success");
              console.log(request.status);

              resolve(request.responseText);
          }
          else
          {
              console.log("Loading...");
          }
      };


      request.open("GET", "../PHP/UnityInitialization.php", true);

      request.send(null);
    });
}
      
      