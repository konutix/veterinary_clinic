<?php

include 'classes/includes.php';

class VisitModel extends DbConnect {

    protected function getVisitTypes() {
        $query = "SELECT * FROM `appointment type`";
        $statement = $this->connect()->query($query);
        return $statement->fetchAll();
    }

    protected function getDate($visitId) {
        $query = "SELECT date FROM `appointments` WHERE ID=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$visitId]);

        return $statement->fetch();
    }

    protected function getClientVisits($clientId) {
        $query = "SELECT A.ID, `date`, P.name, `doctor_id`, T.name type, `status`, `comment` FROM appointments A
                  JOIN pets P ON A.pet_id=P.ID JOIN `appointment type` T ON A.type=T.ID WHERE P.user_id=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$clientId]);

        return $statement->fetchAll();
    }

    protected function getUnassignedVisits() {
        $query = "SELECT A.ID, `date`, P.name, specie, T.name type FROM appointments A
                  JOIN pets P ON A.pet_id=P.ID JOIN `appointment type` T ON A.type=T.ID WHERE doctor_id=0 ORDER BY A.ID";
        $statement = $this->connect()->query($query);

        return $statement->fetchAll();
    }

    protected function getAcceptedVisits($vetID) {
        $query = "SELECT A.ID, `date`, P.name, specie, T.name type, comment FROM appointments A
                  JOIN pets P ON A.pet_id=P.ID JOIN `appointment type` T ON A.type=T.ID WHERE doctor_id=" . $vetID;
        $statement = $this->connect()->query($query);

        return $statement->fetchAll();
    }

    protected function assignVetToVisit($visitId, $vetId) {
        $query = "UPDATE appointments SET `doctor_id`=" . $vetId . " WHERE ID=" . $visitId;
        $statement = $this->connect()->query($query);
    }
    
    protected function addNewVisit($date, $petId, $type, $clientId) {
        $query = "INSERT INTO appointments (`date`, `pet_id`, `type`) 
                  SELECT ?,?,? WHERE ? IN (SELECT user_id FROM pets WHERE ID=?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$date, $petId, $type, $clientId, $petId]);

        return $statement->rowCount();
    }

    protected function updateVisitDate($visitId, $newDate, $clientId) {
        $query = "UPDATE appointments SET `date`=? WHERE `id`=? AND ? IN (SELECT U.ID FROM appointments A 
                  JOIN pets P ON A.pet_id = P.ID JOIN users U ON P.user_id=U.ID)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$newDate, $visitId, $clientId]);

        return $statement->rowCount();
    }

    protected function setVisitComment($visitId, $comment) {
        $query = "UPDATE appointments SET `comment`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$comment, $visitId]);
    }
}
