<?php
include 'classes/includes.php';
session_start();

if(!isset($_SESSION["userID"])){
    header("Location: ./register.php");
}

//zalogowany użytkownik
$cl = new Client($_SESSION['userID']);


?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>Przychodnia</title>

    <link rel="stylesheet" href="style.css">


</head>

<body>

	<?php

	$vv = new VisitView($cl->getId());
	$vv->showVisits();

	?>

        <br>//gdzieś pokazać listę typów

    <div class="inputForm">
        <h2>Rezerwacja wizyt</h2>

        <form method="post" name="newVisit">
            Zwierzę (ID): <br> <input type="text" name="animalID"> <br>

            Data: <br> <input type="text" name="date"> <br>

            Typ (ID): <br> <input type="text" name="type"> <br>


            <br> <input class="inputFormButton" type="submit" value="Utwórz">
        </form>

    </div>

    <div class="inputForm">
        <h2>Zmiana daty</h2>

        <form method="post" name="modifyVisitDate">
            ID wizyty: <br> <input type="text" name="visitID"> <br>

            Nowa data: <br> <input type="text" name="newDate"> <br>


            <br> <input class="inputFormButton" type="submit" value="Zmień datę">
        </form>
    </div>


<input type="button" value="Home" class="redirBtn" onClick="document.location.href='./index.php'" />

</body>
</html>