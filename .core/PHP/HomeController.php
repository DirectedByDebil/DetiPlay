<?php

if(session_status() !== PHP_SESSION_ACTIVE)
{
   
    session_start();
}


$controller = new HomeController();

$controller->CheckRequest();


class HomeController 
{
    
    public function CheckRequest()
    {
        
        if(filter_input(INPUT_POST, "SignOut"))
        {
            
            unset($_SESSION["User"]);
        }
        
        
        echo $this->IsAuthorized();
    }
    
    
    private function IsAuthorized() : string|null
    {
        
        if(isset($_SESSION["User"]))
        {

            return $_SESSION["User"]["UserName"];
        }
        else
        {

            return null;
        }
    }
}
