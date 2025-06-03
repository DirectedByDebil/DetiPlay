<?php

require_once '../../vendor/autoload.php';


class Initialization {

    private static bool $isEnvLoaded = False;


    public static function TryLoadEnv()
    {
        
        if(!self::$isEnvLoaded)
        {
                    
            $dotenv = Dotenv\Dotenv::createUnsafeImmutable("../../");

            $dotenv->load();
            
            self::$isEnvLoaded = True;
        }
    }
}