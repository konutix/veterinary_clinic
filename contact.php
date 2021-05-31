<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title> BOIVET - Kontakt i dojazd </title>
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
            min-height: 200px;
        }


    </style>
</head>
<body>

<script>

    $(document).ready(function () {
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
                <li><a class="current" href="contact.php">KONTAKT I DOJAZD</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['username'])) {

                    if ($_SESSION['status'] == "client") {
                        echo '<li><a href="visit.php"><span class="glyphicon glyphicon-log-in"></span> UMÓW WIZYTĘ</a></li>';
                    }
                    if ($_SESSION['status'] == "doctor") {
                        echo '<li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> DODAJ ARTYKUŁ</a></li>';
                    }

                } else {
                    echo '<li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> REJESTRACJA</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>


<div class="container text-center gap">
    <div class="row">
        <div class="col-sm-8" id="map">
            <script>
                function initMap() {
                    var uluru = {lat: 51.767067, lng: 19.456624};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: uluru
                    });
                    var marker = new google.maps.Marker({
                        position: uluru,
                        map: map
                    });
                }
            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Z_MTez6OGoVeHUGlnRoTaJLkj-bRZ9o&callback=initMap">
            </script>

        </div>
        <div class="col-sm-4">
            <div class="well">
                <p>KONTAKT</p>
                <p> Tel: 1-800-123-332 <br>
                    e-mail: <a href="#">przychodnia@vet.pl
                    </a></p>


            </div>

        </div>
        <div class="well">
            <p>ADRES</p>
            <p>Piotrkowska 98-82<br>
                90-004<br>
                Łódź</p>
        </div>
    </div>
</div>
</div><br>

<footer class="container-fluid text-center">
    <p>Inżynieria Oprogramowania</p>
</footer>

</body>
</html>