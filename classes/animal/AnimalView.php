<?php

include 'classes/includes.php';

class AnimalView extends AnimalModel {
	
	private $userId;
	
	public function __construct($userId) {
		$this->userId = $userId;
	}
	
	public function showAnimals() {

		$results = $this->getAnimalsClient($this->userId);
		
		echo '<table><tr><th>ID<th>Nazwa<th>Gatunek<th>Data urodzenia';
		foreach ($results as $pet) {
			echo '<tr><td>'. $pet['ID'] .'<td>'. $pet['name'] .'<td>'. $pet['specie'] .'<td>'. $pet['birth_date'];
		}
		echo '</table>';
		
	}
	
}