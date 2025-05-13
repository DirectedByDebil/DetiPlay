<?php

require_once 'FilterInput.php';
require_once 'DBConnection.php';

ob_start();


if(FilterInput::TryGetUserName($userName) &&
FilterInput::TryGetEmail($email) &&
FilterInput::TryGetPassword($password) &&
FilterInput::TryGetSalt($salt))
{
    
    $db = new DBConnection("Diploma");
    
    $query = $db->Prepare("insert into users (UserName, Email, Password, Salt) values(:userName, :email, :password, :salt);");
    
    $query->bindValue(":userName", $userName);
    $query->bindValue(":email", $email);
    $query->bindValue(":email", $salt);
    
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    $query->bindValue(":password", $hashedPass);
    
    
    
    if($query->execute())
    {
        //#TODO start app
    }
    
}
else
{
 
    echo "No";
}

ob_flush();



