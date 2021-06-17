<?php
include 'Database.php';
abstract class User{
    private $login = "";
    private $name="";
    private $surname="";
    private $email="";
    private $phone="";
    private $address="";
    private $access=0;
    function __construct($login, $name, $surname, $email, $phone, $address, $access){
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->access = $access;
    }
    
    public function getName(){
        return $this->name;
    }
    public function getSurname(){
        return $this->surname;
    }
    public function getLogin(){
        return $this->login;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getAccess(){
        return $this->access;
    }
}
class Client extends User{
    private $pet=null;
}
class Admin extends User{
    
}
class Vet extends User{
    
}