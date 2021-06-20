<?php

include 'classes/includes.php';

class VisitView extends VisitModel {


    private $userId;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    public function showVisits() {

        $results = $this->getClientVisits($this->userId);

        if (empty($results)) {
            echo "Brak zarezerwowanych wizyt<br><br>";
        } else {
            echo '<table><tr><th>ID<th>Nazwa<th>Data<th>Typ wizyty<th>Komentarz lekarza<th>Akceptacja';
            foreach ($results as $visit) {
                echo '<tr><td>' . $visit['ID'] . '<td>' . $visit['name'] . '<td>' . $visit['date'] . '<td>' . $visit['type'] . '<td>' . $visit['comment'];
                if ($visit['doctor_id'] > 0) {
                    echo '<td><input type="checkbox" checked disabled>';
                } else {
                    echo '<td><input type="checkbox" disabled>';
                }
            }
            echo '</table>';
        }
    }

    public function showVisitTypes() {
        $results = $this->getVisitTypes($this->userId);


        echo '<table><tr><th>ID<th>Nazwa<th>Opis';
        foreach ($results as $type) {
            echo '<tr><td>' . $type['ID'] . '<td>' . $type['name'] . '<td>' . $type['description'];
        }
        echo '</table>';

    }
}
