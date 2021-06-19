<?php
include 'classes/includes.php';
session_start();

if(!isset($_SESSION["userID"])){
    header("Location: ./register.php");
}

if($_SESSION['access'] == 2) {
    header("Location: ./visitVet.php");
}

//zalogowany użytkownik
$cl = new Client($_SESSION['userID']);

if (isset($_POST['animalID'])) {

    if ($cl->addVisit($_POST['date'],$_POST['animalID'], $_POST['type'])) {
        $_SESSION['visitAddSuccess'] = "Pomyślnie utworzono rezerwację";
    }

    header('Location: ./wizyty.php');
    die();
} else if (isset($_POST['newDate'])) {

    if ($cl->changeVisitDate($_POST['visitID'], $_POST['newDate'])) {
        $_SESSION['dateChangeSuccess'] = "Pomyślnie zmieniono datę wizyty";
    }

    header('Location: ./wizyty.php');
    die();
}

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>Przychodnia</title>

    <link rel="stylesheet" href="style.css">


</head>

<body>

<input type="button" value="Home" class="redirBtn" onClick="document.location.href='./index.php'" /> <br><br>

	<?php

    echo '<h2>Umówione wizyty</h2>';
	$cl->showVisits();

	echo '<h2>Typy wizyt</h2>';
	$cl->showVisitTypes();

    if (isset($_SESSION['visitAddSuccess'])) {
        echo "<h3>" . $_SESSION['visitAddSuccess'] . "</h3>";
        unset($_SESSION['visitAddSuccess']);
    }

    if (isset($_SESSION['dateChangeSuccess'])) {
        echo "<h3>" . $_SESSION['dateChangeSuccess'] . "</h3>";
        unset($_SESSION['dateChangeSuccess']);
    }

	?>


    <div class="inputForm">
        <h2>Rezerwacja wizyt</h2>

        <form method="post" name="newVisit">
            Zwierzę (ID): <br> <input type="text" name="animalID"> <br>
            <?php
            if (isset($_SESSION['errAnimalID'])) {
                echo '<div class="error">'.$_SESSION['errAnimalID'].'</div>';
                unset($_SESSION['errAnimalID']);
            }
            ?>
            Data: <br> <input type="datetime-local" name="date"> <br>
            <?php
            if (isset($_SESSION['errDate'])) {
                echo '<div class="error">'.$_SESSION['errDate'].'</div>';
                unset($_SESSION['errDate']);
            }
            ?>
            Typ (ID): <br> <input type="text" name="type"> <br>
            <?php
            if (isset($_SESSION['errTypeID'])) {
                echo '<div class="error">'.$_SESSION['errTypeID'].'</div>';
                unset($_SESSION['errTypeID']);
            }
            ?>

            <br> <input class="inputFormButton" type="submit" value="Utwórz">
        </form>

    </div>

    <div class="inputForm">
        <h2>Zmiana daty</h2>

        <form method="post" name="modifyVisitDate">
            ID wizyty: <br> <input type="text" name="visitID"> <br>
            <?php
            if (isset($_SESSION['errVisitID'])) {
                echo '<div class="error">'.$_SESSION['errVisitID'].'</div>';
                unset($_SESSION['errVisitID']);
            }
            ?>
            Nowa data: <br> <input type="datetime-local" name="newDate"> <br>
            <?php
            if (isset($_SESSION['errNewDate'])) {
                echo '<div class="error">'.$_SESSION['errNewDate'].'</div>';
                unset($_SESSION['errNewDate']);
            }
            ?>


            <br> <input class="inputFormButton" type="submit" value="Zmień datę">
        </form>
    </div>


</body>
</html>