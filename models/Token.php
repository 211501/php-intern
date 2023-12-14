<?php
class Token
{
//    public static function generate(){
//        return $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
//    }
    public static function __callStatic($name, $arguments)
    {
        if($name == 'generateToken'){
            switch (count($arguments)){
                case 0:
                    return $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            }
        }
    }

}