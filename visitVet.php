<?php
include 'classes/includes.php';
session_start();
$_SESSION["accessType"]=null;

if(!isset($_SESSION["userID"])){
    header("Location: ./register.php");
}

if($_SESSION['access'] == 3) {
    header("Location: ./wizyty.php");
}


//zalogowany użytkownik
$vet = new Vet($_SESSION['userID']);


if(isset($_POST['visitIDaccept'])) {
    $vet->acceptVisit($_POST['visitIDaccept']);

    header('Location: ./visitVet.php');
    die();
} else if(isset($_POST['visitIDcancel'])) {
    $vet->cancelVisit($_POST['visitIDcancel']);

    header('Location: ./visitVet.php');
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

<h2>Oczekujące wizyty</h2>

<?php
    $vet->showAwaitingVisits();

?>

   <br>


<h2>Zaakceptowane wizyty</h2>


<?php


if (isset($_SESSION['errCancelVisit'])) {
    echo '<div class="error">' . $_SESSION['errCancelVisit'] . '</div>';
    unset($_SESSION['errCancelVisit']);
}


$vet->showAcceptedVisits();

?>




</body>
</html>