<?php

require_once 'FilterInput.php';
require_once 'UnityDBLoader.php';
require_once 'DBConnection.php';

ob_start();


if(FilterInput::TryGetUserName($userName) &&
FilterInput::TryGetEmail($email) &&
FilterInput::TryGetPassword($password) &&
FilterInput::TryGetSalt($salt))
{
    
    $db = new DBConnection();
    
    $query = $db->Prepare("insert into users (UserName, Email, Password, Salt) values(:userName, :email, :password, :salt);");
    
    $query->bindValue(":userName", $userName);
    $query->bindValue(":email", $email);
    $query->bindValue(":salt", $salt);
    
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    $query->bindValue(":password", $hashedPass);
    
    
    
    if($query->execute())
    {
        
        session_start();
        
        $loader = new UnityDBLoader();
        
        
        $user = $loader->SetUser($result);

        $_SESSION["User"] = $user;
        
        
        header("Location: ../DiplomaWebGL/index.html");
    }
    
}
else
{

    echo "No";
}

ob_flush();



