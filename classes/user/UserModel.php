<?php

include 'classes/includes.php';

class UserModel extends DbConnect
{

    public function getUserData($id) {
        $query="select * from users where id=".$id;
        $select = $this->connect()->query($query)->fetch();

        $data['login'] = $select['login'];
        $data['hash'] = $select['hash'];
        $data['name'] = $select['name'];
        $data['surname'] = $select['surname'];
        $data['email'] = $select['email'];
        $data['phone'] = $select['phone'];
        $data['address'] = $select['address'];
        $data['access'] = $select['access'];

        return $data;
    }

    public function setPassword($id, $hash) {
        $query = "update users set hash='".$hash."'WHERE id=".$id;
        $this->connect()->query($query);

        if ($hash == $this->getPassword($id)) {
            return 0;
        } else {
            return 1;
        }

    }

    public function setData($id, $name, $surname, $email, $phone, $address) {
        $query = "update users set name='".$name."', surname='".$surname."', email='".$email.
            "', phone='" .$phone. "', address='" .$address. "' WHERE id=".$id;
        return $this->connect()->query($query);
    }

    public function getPassword($id) {
        $query = "select `hash` from `users` where `id`=".$id;

        $result = $this->connect()->query($query)->fetch();
        if ($result['hash']) {
            return $result['hash'];
        }
    }
}