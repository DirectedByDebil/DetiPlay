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
        
        return;
    }
        
    $result = $query->fetchAll()[0];
       
    
    if(password_verify($password, $result['Password']))
    {
        
        //#TODO start App
    }
    else
    {
        header("Location: ../SignIn.html");
    }
    
    
}
else
{
 
    echo "No";
}

ob_flush();