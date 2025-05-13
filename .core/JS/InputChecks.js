
window.onload = OnWindowLoad;


function OnWindowLoad()
{
    /*
    fetch("../PHP/logic.php").
            then(function (response)
    {
        response.text().then(function (text){
        
            console.log(text);
        });
    });
        */
    
    
    const form = document.getElementById("registrationForm");

    const password = form.querySelector("#Password");
    const confirmPassword = form.querySelector("#ConfirmPassword");

    
    form.addEventListener('submit', (evt) => {

        evt.preventDefault();

        const pass = password.value;
        const pass2 = confirmPassword.value;


        if (!isValidPassword(pass)) {
            alert('Пароль должен содержать как минимум одну заглавную букву, одну строчную букву и одну цифру и быть длиной от 8 до 20 символов');
            return;
          }
  
        // Проверяем, что пароли совпадают
        if (pass !== pass2) {
          alert('Пароли не совпадают');
          return;
        }
        
        form.submit();
    });
}



function isValidPassword(password) {
  // Проверка пароля регулярным выражением
  const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,20}$/;
  return pattern.test(password);
}
    