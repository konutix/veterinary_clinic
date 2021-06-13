<?php

session_start();

if(isset($_SESSION['username'])){
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="pl-PL">
	<head>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<title> BOIVET - Rejestracja </title>
		<meta charset="utf-8"/>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="mystyle.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>

    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }


    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

  .carousel-inner img {
      width: 100%;
      margin: auto;
      min-height:200px;
  }


  </style>
</head>
<body>

<script>

$(document).ready(function() {
  $('li.active').removeClass('active');
  $('a[href="' + location.pathname + '"]').closest('li').addClass('active');
});

</script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
		<span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">STRONA GŁÓWNA</a></li>
        <li><a href="about.php">O NAS</a></li>
        <li><a href="services.php">ZAKRES ŚWIADCZEŃ</a></li>
		<li><a href="contact.php">KONTAKT I DOJAZD</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> REJESTRACJA</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container text-center gap2">
  <div class="row">

    <div class="col-sm-12">
	<div class="well" id="panel">
	<p class="logowanie">WPISZ DANE BY ODZYSKAĆ HASŁO
	<form>
	<label for="data">Nazwa użytkownika:</label>
	<input type="text" id="username" name="data">
	<label for="nazwa">Adres e-mail:</label>
	<input type="password" id="password" name="nazwa">
	<div id="lower">
	<input type="submit" value="RESETUJ">
	</div>
</form>
</div>
</p>
      </div>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Inżynieria Oprogramowania</p>
</footer>

</body>
</html>