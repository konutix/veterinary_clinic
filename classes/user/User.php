<?php
include_once './classes/includes.php';

class User
{
    private $id;
    private $view;
    private $controller;

    public function __construct($id) {
        $this->controller = new UserController();
        $this->view = new UserView();
        $this->id = $id;
    }

    public function showCredentials() {
        $this->view->showCredentials($this->id, FALSE);
    }

    public function showCredentialsMessage($message) {
        $this->view->showCredentials($this->id, FALSE, $message);
    }

    public function showChangePassword() {
        $this->view->showCredentials($this->id, TRUE);
    }

    public function showChangePasswordMessage($message) {
        $this->view->showCredentials($this->id, TRUE, $message);
    }

    public function getPasswordHash() {
        return $this->controller->getHash($this->id);
    }

    public function changePassword($password) {
        $this->controller->updatePassword($this->id, $password);
    }

    public function getId() {
        return $this->id;
    }
}

class Client extends User {

    public function __construct($id) {
        parent::__construct($id);
    }
}