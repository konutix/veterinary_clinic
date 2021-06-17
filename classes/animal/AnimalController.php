<?php
include 'classes/includes.php';

class AnimalController extends AnimalModel {

    private function validateAnimalData($name, $specie, $date, $note, $clientId) {
        $noError = true;

        //Nazwa
        if ($name == "throw error") {
            $noError = false;
            $_SESSION['errName'] = "Example error";
        }

        if ((strlen($name) < 2) || (strlen($name) > 100)) {
            $noError = false;
            $_SESSION['errName'] = "Podana nazwa jest nieprawidłowa";
        }

        //Gatunek
        if ((strlen($specie) < 3) || (strlen($specie) > 100)) {
            $noError = false;
            $_SESSION['errSpecie'] = "Podany gatunek jest nieprawidłowy";
        }

        //Data urodzenia
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if (!($d && $d->format('Y-m-d') === $date)) {
            $noError = false;
            $_SESSION['errDate'] = "Proszę podać prawidłową datę, w postaci: rrrr-mm-dd";
        }

        //Uwagi
        if (strlen($note) > 300) {
            $noError = false;
            $_SESSION['errNote'] = "Przekroczono limit znaków";
        }

        return $noError;
    }

	public function addAnimal($name, $specie, $date, $note, $clientId) {

		if ($this->validateAnimalData($name, $specie, $date, $note, $clientId)) {
			$this->addNewAnimal($name, $specie, $date, $note, $clientId);
			return true;
		}
		
		return false;
	}

	public function updateAnimal($id, $name, $specie, $date, $note, $clientId) {

        if ($this->validateAnimalData($name, $specie, $date, $note, $clientId)) {
            if ($this->setAnimal($id, $name, $specie, $date, $note, $clientId) > 0) {
                return true;
            } else {
                $_SESSION['errEditAnimal'] = "Nie udało się edytować zwierzęcia o podanym ID";
            }
        }

        return false;
    }
	
}