<?php

require_once 'FilterInput.php';
require_once 'DBConnection.php';

ob_start();


if (FilterInput::TryGetEmail($email) &&
FilterInput::TryGetAuthPassword($password))
{

   
    $db = new DBConnection("Diploma");
    
    $query = $db->Prepare("select UserName, Salt, Password, Email from users where Email = :email;");
    
    $query->bindValue(":email", $email);
    
    
    if(!$query->execute())
    {
        echo "Error";
        return;
    }
        
    
    $result = $query->fetchAll()[0];
       
    
    if(password_verify($password, $result['Password']))
    {        
        
        session_start();
        
        
        $user = array("UserName" => $result["UserName"], "Email" => $result["Email"]);
        
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