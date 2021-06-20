<?php

include 'classes/includes.php';

class VisitView extends VisitModel {


    private $userId;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    public function showClientVisits() {

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

    public function showAwaitingVisits() {
        $results = $this->getUnassignedVisits();

        if (empty($results)) {
            echo "Brak oczekujących wizyt<br><br>";
        } else {
            echo '<table><tr><th>ID<th>Data<th>Nazwa<th>Gatunek<th>Typ wizyty<th> ';
            foreach ($results as $visit) {
                echo '<tr><td>' . $visit['ID'] . '<td>' . $visit['date'] . '<td>' . $visit['name'] . '<td>' . $visit['specie'] . '<td>' . $visit['type'];
                echo '<form method="post" name="acceptVisit">';
                echo '<input type="hidden" name="visitIDaccept" value="' . $visit['ID'] .'">';
                echo '<td><input type="submit" value="Akceptuj">';
                echo '</form>';
            }
            echo '</table>';
        }
    }

    public function showAcceptedVisits() {
        $results = $this->getAcceptedVisits($this->userId);

        if (empty($results)) {
            echo "Brak zaakceptowanych wizyt<br><br>";
        } else {
            echo '<table><tr><th>ID<th>Data<th>Nazwa<th>Gatunek<th>Typ wizyty<th> <th> ';
            foreach ($results as $visit) {
                echo '<tr><td>' . $visit['ID'] . '<td>' . $visit['date'] . '<td>' . $visit['name'] . '<td>' . $visit['specie'] . '<td>' . $visit['type'];

                echo '<form method="post" name="commentVisit">' .
                     '<td><input type="text" name="visitComment" value="' . $visit['comment'] .'">' .
                     '<input type="hidden" name="visitIDcomment" value="' . $visit['ID'] .'">' .
                     '<input type="submit" value="Dodaj komentarz">' .
                     '</form>';

                echo '<form method="post" name="acceptVisit">' .
                     '<input type="hidden" name="visitIDcancel" value="' . $visit['ID'] .'">' .
                     '<td><input type="submit" value="Anuluj">' .
                     '</form>';
            }
            echo '</table>';
        }
    }
}
