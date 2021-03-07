<?php
session_start();

if(!isset($_SESSION['username'])){
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


<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Kropki na karuzeli (bez nich nie działa) -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Zdjęcia na karuzele -->
    <div class="carousel-inner" role="listbox">

        <div class="item active">
            <img src="img/karuzela1.jpg" alt="Image">
            <div class="carousel-caption">
            </div>
        </div>

        <div class="item">
            <img src="img/karuzela2.jpg" alt="Image">
            <div class="carousel-caption">
            </div>
        </div>

        <div class="item">
            <img src="img/karuzela3.jpg" alt="Image">
            <div class="carousel-caption">
            </div>
        </div>

        <div class="item">
            <img src="img/karuzela4.jpg" alt="Image">
            <div class="carousel-caption">
            </div>
        </div>
    </div>


</div>

<!-- logo -->
<div class="col-md-3" style="left: 5%; top: 4%; position: absolute; width: 18%">
    <img src="img/logo.png" style="width: 100%">
</div>


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

            <p class="big"><b>TWOJE WIZYTY</b>

            <table class="table">
                <thead>
                <tr>
                    <th data-breakpoints="xs" class="mid">DATA</th>
                    <th class="mid">GODZINA</th>
                    <th class="mid">DOKTOR</th>
                    <th data-breakpoints="xs" class="mid">PACJENT/PACJENCI</th>
                    <th data-breakpoints="xs sm" class="mid">ADRESS</th>
                    <th data-breakpoints="xs sm md" class="mid" data-title="TYP"></th>
                </tr>
                </thead>
                <tbody>
                <?php

                require_once "connect.php";

                $connection = new mysqli($host, $db_user, $db_password, $db_name);

                if ($connection->connect_errno != 0) {
                    echo "Error: " . $connection->connect_errno . "Opis: " . $connection->connect_error;
                } else {

                    if ($_SESSION['status'] == 'client') {
                        $id_user = $_SESSION['id_user'];

                        if ($result = @$connection->query("SELECT * FROM visits WHERE id_client='$id_user'")) {

                            while ($row = $result->fetch_assoc()) {

                                echo '<tr>';
                                echo '<td>' . $row['date'] . '</td>';
                                echo '<td>' . $row['time'] . '</td>';

                                $id_doctor = $row['id_doctor'];
                                $doc_result = @$connection->query("SELECT * FROM users WHERE id='$id_doctor'");
                                $doc_row = $doc_result->fetch_assoc();

                                echo '<td>' . $doc_row['name'] .' '. $doc_row['surname'] . '</td>';
                                echo '<td>' . $row['patient'] . '</td>';
                                echo '<td>' . $row['place'] . '</td>';
                                echo '<td>' . $row['type'] . '</td>';
                                echo '</tr>';

                            }

                            $result->free_result();

                        }
                    }
                    if ($_SESSION['status'] == 'doctor') {
                        $id_user = $_SESSION['id_user'];

                        if ($result = @$connection->query("SELECT * FROM visits WHERE id_doctor='$id_user'")) {

                            while ($row = $result->fetch_assoc()) {

                                echo '<tr>';
                                echo '<td>' . $row['date'] . '</td>';
                                echo '<td>' . $row['time'] . '</td>';
                                echo '<td>' . $_SESSION['name']. $_SESSION['surname'] . '</td>';
                                echo '<td>' . $row['patient'] . '</td>';
                                echo '<td>' . $row['place'] . '</td>';
                                echo '<td>' . $row['type'] . '</td>';
                                echo '</tr>';

                            }

                            $result->free_result();

                        }
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

                if ($_SESSION['status'] == "doctor") {

                    echo <<<END
             <a href="visits.php"><input id="username" type="button" value="Umówione wizyty"></a>
             <br><br>
             <a href="articles.php"><input id="username" type="button" value="Twoje artykuły"></a>
             <br><br>
             <a href="article.php"><input id="username" type="button" value="Dodaj artykuł"></a>
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
    <p>Kacper Kurowski, BOIVET 2018</p>
</footer>

<script>
    jQuery(function ($) {
        $('.table').footable();
    });
</script>
</body>
