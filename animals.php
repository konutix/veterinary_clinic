<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['username'] == 'doctor'){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title> BOIVET - Strona główna </title>
    <meta charset="utf-8"/>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <link href="css/footable.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/footable.js"></script>
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
<link rel="icon" href="logo.png">

<script>

    $(document).ready(function () {
        $('li.active').removeClass('active');
        $('a[href="' + location.pathname + '"]').closest('li').addClass('active');
    });

</script>

<!-- menu -->
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
                <li><a href="index.php">STRONA GŁÓWNA</a></li>
                <li><a href="about.php">O NAS</a></li>
                <li><a href="services.php">ZAKRES ŚWIADCZEŃ</a></li>
                <li><a href="contact.php">KONTAKT I DOJAZD</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['username'])) {

                    if ($_SESSION['status'] == "client") {
                        echo '<li><a href="visit.php"><span class="glyphicon glyphicon-log-in"></span> umów wizytę</a></li>';
                    }
                    if ($_SESSION['status'] == "doctor") {
                        echo '<li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> dodaj artykuł</a></li>';
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
        <div class="col-sm-8">

            <p class="big"><b>TWOJE ZWIERZAKI</b>

            <table class="table">
                <thead>
                <tr>
                    <th data-breakpoints="xs" class="mid">IMIĘ</th>
                    <th class="mid">DATA URODZENIA</th>
                    <th class="mid">PŁEĆ</th>
                    <th data-breakpoints="xs" class="mid">TYP</th>
                    <th data-breakpoints="xs sm" class="mid" >RASA</th>
                    <th data-breakpoints="xs sm md" class="mid" data-title="OPIS">Opis</th>
                </tr>
                </thead>
                <tbody>
                <?php

                require_once "connect.php";

                $connection = new mysqli($host, $db_user, $db_password, $db_name);

                if ($connection->connect_errno != 0) {
                    echo "Error: " . $connection->connect_errno . "Opis: " . $connection->connect_error;
                } else {

                    $id_user = $_SESSION['id_user'];

                    if ($result = @$connection->query("SELECT * FROM patients WHERE id_user='$id_user'")) {

                        while ($row = $result->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['birth_date'] . '</td>';
                            echo '<td>' . $row['sex'] . '</td>';
                            echo '<td>' . $row['type'] . '</td>';
                            echo '<td>' . $row['race'] . '</td>';
                            echo '<td>' . $row['description'] . '</td>';
                            echo '</tr>';

                        }

                        $result->free_result();

                    }

                    $connection->close();
                }
                ?>
                </tbody>
            </table>

        </div>
        <div class="col-sm-4">

            <?php

            if (!isset($_SESSION['username'])) {

                echo <<<END
            <div class="well" id="panel">
                <p class="logowanie">LOGOWANIE
                    <form action="signin.php" method="post">
                        <label>Nazwa użytkownika:</label>
                        <input type="text" id="username" name="login">
                        <label>Hasło:</label>
                        <input type="password" id="password" name="password">
END;
                if (isset($_SESSION['error'])) {

                    echo $_SESSION['error'];
                    session_unset();

                }

                echo '<p><a href="forgot.php">Zapomniałeś hasła?</a></p>';
                echo '<div id="lower">';
                echo '<input type="submit" value="ZALOGUJ">';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</p>';
            } else {

                echo '<div class="well" id="panel">';

                echo '<br>';
                echo '<p class="logowanie">Witaj ' . $_SESSION['username'] . '!</p>';

                if ($_SESSION['status'] == "client") {

                    echo <<<END
             <a href="visits.php"><input id="username" type="button" value="Umówione wizyty"></a>
             <br><br>
             <a href="visit.php"><input id="username" type="button" value="Umów wizytę"></a>
             <br><br>
             <a href = "animals.php"><input id="username" type="button" value="Twoje zwierzaki"></a>
             <br><br>
             <a href="animal.php"><input id="username" type="button" value="Dodaj zwierzaka"></a>
             <a href="logout.php">
                <div id="lower">
                    <input type="submit" value="Wyloguj się">
                </div>
             </a>
END;
                }
                echo '</div>';

            }
            ?>

        </div>
    </div>
</div>
</div><br>

<footer class="container-fluid text-center">
    <p>Inżynieria Oprogramowania</p>
</footer>

<script>
    jQuery(function ($) {
        $('.table').footable();
    });
</script>
</body>
