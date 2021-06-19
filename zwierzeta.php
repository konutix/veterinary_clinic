<?php
    include 'classes/includes.php';

    session_start();
    $_SESSION["accessType"]=null;

    if(!isset($_SESSION["userID"])){
        header("Location: ./register.php");
    }

	//zalogowany użytkownik	
	$cl = new Client($_SESSION['userID']);
	
	if (isset($_POST['name'])) {
		
		$ac = new AnimalController();

        if ($_POST['animalEditId'] != null) {
            if ($ac->updateAnimal($_POST['animalEditId'], $_POST['name'], $_POST['specie'], $_POST['date'], $_POST['note'], $cl->getId())) {
                $_SESSION['animalAddSuccess'] = "Pomyślnie edytowano zwierzę";
            }
        } else {
            if ($ac->addAnimal($_POST['name'], $_POST['specie'], $_POST['date'], $_POST['note'], $cl->getId())) {
                $_SESSION['animalAddSuccess'] = "Pomyślnie dodano zwierzę";
            }
        }
		
		header("Location: ./zwierzeta.php");
		die();
	} 
	
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>Przychodnia</title>

    <link rel="stylesheet" href="style.css">

    <script>

        function isPositiveInteger(str) {
            let n = Math.floor(Number(str));
            return n !== Infinity && String(n) === str && n >= 0;
        }

        function setEditedAnimalId() {

            let id = prompt('Podaj ID edytowanego zwierzęcia');
            if (id == null) {
                return false;
            }

            while (!isPositiveInteger(id)) {
                id = prompt('Nieprawidłowe ID \nPodaj ID edytowanego zwierzęcia');
                if (id == null) {
                    return false;
                }
            }

            document.animalForm.animalEditId.value = id;
            return true;
        }

    </script>

</head>

<body>
	
	<?php
	
        $av = new AnimalView($cl->getId());
	$av->showAnimals();

	if (isset($_SESSION['animalAddSuccess'])) {
		echo "<h3>" . $_SESSION['animalAddSuccess'] . "</h3>";
		unset($_SESSION['animalAddSuccess']);
	}

    if (isset($_SESSION['errEditAnimal'])) {
        echo '<div class="error">' . $_SESSION['errEditAnimal'] . '</div>';
        unset($_SESSION['errEditAnimal']);
    }


	?>
	
	<div class="inputForm">
		<h2>Dodaj / Edytuj zwierzę</h2>
		
		<form method="post" name="animalForm">
			Nazwa: <br> <input type="text" name="name"> <br>
			<?php
				if (isset($_SESSION['errName'])) {
					echo '<div class="error">'.$_SESSION['errName'].'</div>';
					unset($_SESSION['errName']);
				}
			?>
			Gatunek: <br> <input type="text" name="specie"> <br>
			<?php
				if (isset($_SESSION['errSpecie'])) {
					echo '<div class="error">'.$_SESSION['errSpecie'].'</div>';
					unset($_SESSION['errSpecie']);
				}
			?>
			Data urodzenia: <br> <input type="text" name="date"> <br>
			<?php
				if (isset($_SESSION['errDate'])) {
					echo '<div class="error">'.$_SESSION['errDate'].'</div>';
					unset($_SESSION['errDate']);
				}
			?>
			Uwagi: <br> <input type="text" name="note"> <br>
			<?php
				if (isset($_SESSION['errNote'])) {
					echo '<div class="error">'.$_SESSION['errNote'].'</div>';
					unset($_SESSION['errNote']);
				}
			?>

            <input type="hidden" name="animalEditId" value="">

			<input class="inputFormButton" type="submit" value="Dodaj">
            <input class="inputFormButton" onClick="return setEditedAnimalId()" type="submit" value="Edytuj"> <br>
		</form>
	</div>

    <input type="button" value="Home" class="redirBtn" onClick="document.location.href='./index.php'" />

</body>
</html>