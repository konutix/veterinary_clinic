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
$cl = new Vet($_SESSION['userID']);

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

tabela z przyciskami 'Akceptuj' <br>
można zrobić wgląd w zwierzę    <br>


<h2>Zaakceptowane wizyty</h2>

tabela z możliwością komentowania <br>
można zrobić wgląd w zwierzę      <br>




</body>
</html>