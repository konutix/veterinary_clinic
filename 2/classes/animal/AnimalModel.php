<?php 

include 'classes/includes.php';

class AnimalModel extends DbConnect {
	
	protected function getAnimalsClient($userId) {
		$query = "SELECT * FROM pets WHERE user_id=?";
		$statement = $this->connect()->prepare($query);
		$statement->execute([$userId]);
		
		return $statement->fetchAll();
	}
	
	protected function getAnimalsAppointment($appId) {
		$query = "SELECT name FROM pets P JOIN appointments A ON P.id=A.pet_id WHERE A.id=" . $appId;
		$statement = $this->connect()->query($query);
		return $statement->fetch();
	}
	
	protected function addNewAnimal($name, $specie, $date, $note, $clientId) {
		$query = "INSERT INTO pets (`name`, `specie`, `birth_date`, `note`, `user_id`) VALUES (?,?,?,?,?)";
		$statement = $this->connect()->prepare($query);
		$statement->execute([$name, $specie, $date, $note, $clientId]);
	}


	protected function setAnimal($id, $name, $specie, $date, $note, $clientId) {
	    $query = "UPDATE pets SET `name`=?, `specie`=?, `birth_date`=?, `note`=? WHERE `id`=? AND `user_id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$name, $specie, $date, $note, $id, $clientId]);

        return $statement->rowCount();
    }
}