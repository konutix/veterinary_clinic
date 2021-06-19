<?php
include 'classes/includes.php';
class Registering{
    public static function login($login, $passwd){
        $db = new DbConnect();
        $id = 0;
        $access = 0;
        $db->connect();
        $query = "SELECT hash FROM users WHERE login = '".$login."' AND depracated = false;";
        $result = $db->query($query);
        if($result->rowCount() > 0){
            $hash = $result->fetch()["hash"];
            if($hash == $passwd){
                $query = "SELECT ID, access FROM users WHERE login = '".$login."' AND depracated = false;";
                $result = $db->query($query)->fetch();
                $id = $result["ID"];
                $access = $result["access"];
                $_SESSION['userID'] = $id;
                $_SESSION['access'] = $access;
                return 0;
            }
            else
            {
                return 2;
            }
        }
        else{
            return 1;
        }
    }
    public static function register($login, $passwd, $name, $surname, $email, $phone, $address, $access){
        $db = new DbConnect();
        $db->connect();
        $query = "SELECT login FROM users WHERE login = '".$login."' AND depracated = false;";
        $result = $db->query($query);
        if($result->rowCount() == 0){
            $query = "INSERT INTO users (login, hash, name, surname, email, phone, address, access, depracated)
            VALUES('".$login."','".$passwd."','".$name."','".$surname."','".$email."','".$phone."','".$address."',".$access.", false);";
            $db->query($query);
            return 0;
        }else{
            return 1;
        }
    }
    public static function logout(){
        $_SESSION['userID'] = null;
        $_SESSION['access'] = null;
    }
}
