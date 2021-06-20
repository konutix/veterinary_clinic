<?php

include 'classes/includes.php';

class VisitController extends VisitModel {

    protected function validateTypeId($type) {

        $types = $this->getVisitTypes();
        foreach ($types as $t) {
            if($t['ID'] == $type) {
                return true;
            }
        }
        return false;
    }

    protected function validateDatetime($date) {
        $dateTime = new DateTime($date);
        $interval = new DateInterval("P1D");
        $dateLimit  = (new DateTime("now"))->add($interval);

        return $dateTime > $dateLimit;
    }

    public function addVisit($date, $petId, $type, $clientId)
    {
        $isValid = true;

        if (!$this->validateTypeId($type)) {
            $isValid = false;
            $_SESSION['errTypeID'] = "Niepoprawny typ wizyty";
        }

        if (!$this->validateDatetime($date)) {
            $isValid = false;
            $_SESSION['errDate'] = "Podaj prawidłową datę z conajmniej 24 godzinnym wyprzedzeniem";
        }


        if ($isValid) {
            if ($this->addNewVisit($date, $petId, $type, $clientId) > 0) {
                return true;
            } else {
                $_SESSION['errAnimalID'] = "Sprawdź poprawność ID";
            }
        }

        return false;
    }

    public function changeVisitDate($visitId, $newDate, $clientId) {

        $isValid = true;

        if (!$this->validateDatetime($newDate)) {
            $isValid = false;
            $_SESSION['errNewDate'] = "Podaj prawidłową datę z conajmniej 24 godzinnym wyprzedzeniem<br>";
        }

        $oldDate = ($this->getDate($visitId)['date']);
        if (!$this->validateDatetime($oldDate)) {
            $isValid = false;
            $_SESSION['errNewDate'] .= "Nie można zmieniać daty wizyty na 24 godziny przed jej rozpoczęciem";
        }

        if ($isValid) {
            if ($this->updateVisitDate($visitId, $newDate, $clientId) > 0) {
                return true;
            } else {
                $_SESSION['errVisitID'] = "Sprawdź poprawność ID";
            }
        }


        return false;
    }

    public function acceptVisit($visitId, $vetId) {
        $this->assignVetToVisit($visitId, $vetId);
    }

    public function cancelVisit($visitId, $delete=FALSE) {

        $visitDate = ($this->getDate($visitId)['date']);
        if ($this->validateDatetime($visitDate)) {
            if ($delete) {
               $this->deleteVisit($visitId);
            } else {
                $this->assignVetToVisit($visitId, 0);
            }
        } else {
            $_SESSION['errCancelVisit'] = "Nie można anulować wizyty";
        }
    }

    public function commentVisit($visitId, $comment) {
        $this->setVisitComment($visitId, $comment);
    }
} 
