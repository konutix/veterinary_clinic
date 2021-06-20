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
    private $ac;
    private $av;

    public function __construct($id) {
        parent::__construct($id);

        $this->vc = new VisitController();
        $this->vv = new VisitView($id);
        $this->ac = new AnimalController();
        $this->av = new AnimalView($id);
    }

    public function addVisit($date, $petId, $type) {
        return $this->vc->addVisit($date, $petId, $type, $this->id);
    }

    public function changeVisitDate($visitId, $newDate) {
        return $this->vc->changeVisitDate($visitId, $newDate, $this->id);
    }

    public function showVisits() {
        $this->vv->showClientVisits();
    }

    public function showVisitTypes() {
        $this->vv->showVisitTypes();
    }

    public function addAnimal($name, $specie, $date, $note) {
        return $this->ac->addAnimal($name, $specie, $date, $note, $this->id);
    }

    public function updateAnimal($animalId, $name, $specie, $date, $note) {
        return $this->ac->updateAnimal($animalId, $name, $specie, $date, $note, $this->id);
    }

    public function showAnimals() {
        $this->av->showAnimals();
    }

    public function cancelVisit($visitId) {
        $this->vc->cancelVisit($visitId, TRUE);
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

    public function showAwaitingVisits() {
        $this->vv->showAwaitingVisits();
    }

    public function showAcceptedVisits() {
        $this->vv->showAcceptedVisits();
    }

    public function acceptVisit($visitID) {
        $this->vc->acceptVisit($visitID, $this->id);
    }

    public function cancelVisit($visitId) {
        $this->vc->cancelVisit($visitId);
    }

    public function commentVisit($visitId, $comment) {
        $this->vc->commentVisit($visitId, $comment);
    }
}