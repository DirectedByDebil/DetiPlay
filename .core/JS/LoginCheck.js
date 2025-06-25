
addEventListener("load", onLoad);


let login;

let userName;

let signOut;


function onLoad () {

    logIn = document.getElementById("logIn");
    
    const authorized = document.getElementById("authorized");
    
    userName = authorized.querySelector("#userName");
    
    
    signOut = authorized.querySelector("#signOut");

    signOut.addEventListener("click", clicked);
    
   
    isAuthorized().then(onAuthorized, onSignedOut);
}


async function isAuthorized () {
    
    return new Promise(function (resolve, reject) {
        
        let request = new XMLHttpRequest();


        request.onreadystatechange = function ()
        {
            if(request.readyState === 4)
            {

                let responseText = request.responseText;

                if(responseText !== "")
                {
                    
                    resolve(responseText);
                }
                else
                {
                    
                    reject(responseText);
                }
            }
            else
            {
                console.log("Loading...");
            }
        };


        request.open("GET", "PHP/HomeController.php", true);

        request.send(null);
    });
}


function onAuthorized(result)
{
    
    userName.innerHTML = "Вы вошли как: " + result;

    logIn.style.display = 'none';
}


function onSignedOut(error)
{
    
    logIn.style.display = 'inline';
    
    userName.style.display = 'none';

    signOut.style.display = 'none';
}


function clicked () {
        
    startSignOut().then(onSignedOut);
}


async function startSignOut () {
    
    return new Promise(function (resolve, reject) {
        
        let request = new XMLHttpRequest();

        request.onreadystatechange = function ()
        {
            if(request.readyState === 4)
            {

                resolve();
            }
            else
            {
                console.log("Signing out...");
            }
        };


        request.open("POST", "PHP/HomeController.php", true);

        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        request.send('SignOut=True');
    });
}
    

