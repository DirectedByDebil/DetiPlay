<?php


class FilterInput
{
    
    public static function TryGetUserName(&$userName): bool
    {
        $userName = filter_input(INPUT_POST, "UserName", FILTER_SANITIZE_SPECIAL_CHARS);
        
        return !empty($userName);
    }
    
    
    public static function TryGetSalt(&$salt): bool
    {
        $salt = filter_input(INPUT_POST, "Salt", FILTER_SANITIZE_SPECIAL_CHARS);
        
        return !empty($salt);
    }
    
    
    
    public static function TryGetEmail(&$email): bool
    {
        $email = filter_input(INPUT_POST, "Email", FILTER_SANITIZE_EMAIL);
        
        return !empty($email);
    }
    
    
    public static function TryGetPassword(&$password): bool
    {
        
        $password = filter_input(INPUT_POST, "Password", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $confirmPassword = filter_input(INPUT_POST, "ConfirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,20}$/";
        
        
        if(preg_match($pattern, $password) !== 1)
        {
            return false;
        }
        
        
        if ($password != $confirmPassword)
        {
            return false;
        }
        
        
        return !empty($password);
    }
    
    
    public static function TryGetAuthPassword(&$password): bool
    {
        
        $password = filter_input(INPUT_POST, "Password", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,20}$/";
        
        
        if(preg_match($pattern, $password) !== 1)
        {
            return false;
        }
        
        return !empty($password);
    }
}
