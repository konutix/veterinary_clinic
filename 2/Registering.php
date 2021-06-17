<?php
include 'Managment.php';
class Registering{
    public static function login($login, $passwd){
        $db = new Database();
        $name="";
        $surname="";
        $email="";
        $phone="";
        $address="";
        $access=0;
        $user= null;
        $db->connect();
        $query = "SELECT hash FROM users WHERE login = '".$login."';";
        $result = $db->query($query);
        if($result->num_rows > 0){
            $hash = $result->fetch_assoc()["hash"];
            if($hash == $passwd){
                $query = "SELECT ID, access FROM users WHERE login = '".$login."';";
                $result = $db->query($query)->fetch_assoc();
                $id = $result["ID"];
                $access = $result["access"];
                session_start();
                $_SESSION['userID'] = $id;
                $_SESSION['access'] = $access;
                $db->close();
                return 0;
            }
            else
            {
                $db->close();
                return 2;
            }
        }
        else{
            $db->close();
            return 1;
        }
    }
    public static function register($login, $passwd, $name, $surname, $email, $phone, $address){
        $db = new Database();
        $db->connect();
        $query = "SELECT login FROM users WHERE login = '".$login."';";
        $result = $db->query($query);
        if($result->num_rows == 0){
            $query = "INSERT INTO users (login, hash, name, surname, email, phone, address, access)
            VALUES('".$login."','".$passwd."','".$name."','".$surname."','".$email."','".$phone."','".$address."',3);";
            $db->query($query);
            $db->close();
            return 0;
        }else{
            $db->close();
            return 1;
        }
    }
    public static function logout(){
        $_SESSION['userID'] = null;
        $_SESSION['access'] = null;
    }
}
