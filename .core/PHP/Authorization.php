<?php

require_once 'FilterInput.php';
require_once 'UnityDBLoader.php';

ob_start();


if (FilterInput::TryGetEmail($email) &&
FilterInput::TryGetAuthPassword($password))
{

    $loader = new UnityDBLoader();
   
    
    if($loader->GetUserAuth($email, $result) and
            password_verify($password, $result['Password']))
    {        
        
        session_start();
        
        $user = $loader->SetUser($result);

        $_SESSION["User"] = $user;
        
        header("Location: ../DiplomaWebGL/index.html");
    }
    else
    {
        //echo "Not correct password";
        header("Location: ../LogIn.html");
    }
    
    
}
else
{
 
    echo "No";
}

ob_flush();