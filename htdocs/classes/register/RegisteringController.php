<?php
include 'classes/includes.php';
class RegisteringController extends Registering{
    public function registerValidate($login, $passwd, $name, $surname, $email, $phone, $address){
        $error = 0;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$login) || strlen($login)<2 || strlen($login)>35){
            $error = 1;
        }else if(strlen($passwd)<4){
            $error = 2;
        }else if(!preg_match("/^[a-zA-Z]*$/",$name) || strlen($name)<2 || strlen($name)>35){
            $error = 3;
        }else if(!preg_match("/^[a-zA-Z]*[-]?[a-zA-Z]*$/",$surname) || strlen($surname)<2 || strlen($surname)>50){
            $error = 4;
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = 5;
        }else if(!preg_match("/^[+][0-9]{11}$/",$phone) || strlen($phone)!=12){
            $error = 6;
        }else if(!preg_match("/^[a-zA-Z0-9-. ]*$/",$address)){
            $error = 7;
        }
        return $error;
    }
        
}
