<?php
include 'classes/includes.php';
class AdminController extends AdminModel{
    public function accessToNumber($acccess){
        $return = null;
        switch($acccess){
            case "client":
                $return = 3;
                break;
            case "vet":
                $return = 2;
                break;
        }
        return $return;
    }
    
    public function validateSearch($search){
        $error = 0;
        if($search["login"] != null && (strlen($search["login"])<2 || strlen($search["login"])>35)){
            $error = 1;
        }
        else if($search["name"] != null && (strlen($search["name"])<2 || strlen($search["name"])>35)){
            $error = 2;
        }else if($search["surname"] != null && (strlen($search["surname"])<2 || strlen($search["surname"])>50)){
            $error = 3;
        }
        return $error;
    }
}
