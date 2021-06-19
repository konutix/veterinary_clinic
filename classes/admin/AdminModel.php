<?php

include 'classes/includes.php';

class AdminModel
{
    public function getSearch($login, $name, $surname, $access){
        $search["login"] = $login;
        $search["name"] = $name;
        $search["surname"] = $surname;
        $search["access"] = $access;
        return $search;
    }
    
    public function getUsers($search) {
        $db = new DbConnect();
        $db->connect();
        $query="SELECT ID, login, name, surname, access FROM users WHERE depracated = false";
        if($search["login"] != null){
            $query = $query." AND login = \"".$search["login"]."\"";
        }
        if($search["name"] != null){
            $query = $query." AND name = \"".$search["name"]."\"";
        }
        if($search["surname"] != null){
            $query = $query." AND surname = \"".$search["surname"]."\"";
        }
        if($search["access"] != null){
            $query = $query." AND access = ".$search["access"];
        }else{
            $query = $query." AND (access = 2 OR access = 3)";
        }
        $query = $query.";";
        $result = $db->query($query);
        $iter = 0;
        $data = null;
        while($row = $result->fetch()){
            $data[$iter]["ID"] = $row["ID"];
            $data[$iter]["login"] = $row["login"];
            $data[$iter]["name"] = $row["name"];
            $data[$iter]["surname"] = $row["surname"];
            $data[$iter]["access"] = $row["access"];
            $iter++;
        }
        return $data;
    }
}