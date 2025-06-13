<?php

require_once 'FilterInput.php';


if(session_status() !== PHP_SESSION_ACTIVE)
{
   
    session_start();
}


if(FilterInput::TryGetModule($moduleName))
{
    
    $_SESSION["StartingModule"] = $moduleName;
}   


if(isset($_SESSION["User"]))
{
  
    header("Location: ../DiplomaWebGL/index.html");
}
else 
{

    header("Location: ../LogIn.html");    
}