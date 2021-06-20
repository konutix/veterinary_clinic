<?php
include_once './classes/includes.php';

class User
{
    protected $id;
    private $view;
    private $controller;

    public function __construct($id) {
        $this->controller = new UserController();
        $this->view = new UserView();
        $this->id = $id;
    }

    public function showCredentials($message=NULL) {
        $this->view->showCredentials($this->id, 0, $message);
    }

    public function showChangePassword($message=NULL) {
        $this->view->showCredentials($this->id, 1, $message);
    }

    public function showChangeData($message=NULL) {
        $this->view->showCredentials($this->id, 2, $message);
    }

    public function getPasswordHash() {
        return $this->controller->getHash($this->id);
    }

    public function changePassword($password) {
        $this->controller->updatePassword($this->id, $password);
    }

    public function changeData($name, $surname, $email, $phone, $address) {
        $this->controller->updateData($this->id, $name, $surname, $email, $phone, $address);
    }

    public function getId() {
        return $this->id;
    }
}

class Client extends User {

    private $vc;
    private $vv;

    public function __construct($id) {
        parent::__construct($id);

        $this->vc = new VisitController();
        $this->vv = new VisitView($id);
    }

    public function addVisit($date, $petId, $type) {
        return $this->vc->addVisit($date, $petId, $type, $this->id);
    }

    public function changeVisitDate($visitId, $newDate) {
        return $this->vc->changeVisitDate($visitId, $newDate, $this->id);
    }

    public function showVisits() {
        $this->vv->showVisits();
    }

    public function showVisitTypes() {
        $this->vv->showVisitTypes();
    }
}

class Vet extends User {
    private $vc;
    private $vv;

    public function __construct($id) {
        parent::__construct($id);

        $this->vc = new VisitController();
        $this->vv = new VisitView($id);
    }
}