<?php


require_once 'UnityDBLoader.php';


if(session_status() !== PHP_SESSION_ACTIVE)
{
   
    session_start();
}



if(isset($_SESSION["User"]))
{
    
    $loader = new UnityDBLoader();
   
    
    $initData = array("User"=> $_SESSION["User"], 
        "Lessons" => $loader->GetLessons(), 
        "LearningPrograms" => $loader->GetLearningModules(),
        "StartingModule" => $loader->GetStartingModule());
    
    
    echo json_encode($initData);
    
}
else
{
    
    echo "None";
}


