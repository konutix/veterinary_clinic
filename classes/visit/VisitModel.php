<?php

include 'classes/includes.php';

class VisitModel extends DbConnect {

    protected function getClientVisits($clientId) {
        $query = "SELECT A.ID, `date`, `name`, `doctor_id`, `type`, `status`, `comment` 
                  FROM appointments A JOIN pets P ON A.pet_id=P.ID WHERE P.user_id=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$clientId]);

        return $statement->fetchAll();
    }


}