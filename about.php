<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title> BOIVET - O nas</title>
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
                <li><a class="current" href="about.php">O NAS</a></li>
                <li><a href="services.php">ZAKRES ŚWIADCZEŃ</a></li>
                <li><a href="contact.php">KONTAKT I DOJAZD</a></li>
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
    <div class="row well">
        <div class="col-sm-8">
            <p class="big titel"><b>O Nas</b>
            <p class="left">Klinika Weterynaryjna BOIVET została utworzona w 2018r. W trosce o pacjentów weterynarze
                stale doskonalą umiejętności zdobywając najnowszą wiedzę z zakresu weterynarii
                uczestnicząc w licznych kursach, szkoleniach i sympozjach. Zaowocowało to ukończeniem przez każdego z
                pracowników studiów specjalizacyjnych.</p><br><br>


            <p class="mid">
                Nasz Zespół tworzą:<br><br>


                lek. wet. Tomasz Niepokonasz -
                Specjalista chirurgii weterynaryjnej, tel: 0 - 509-128-086<br> <img class="kolo" src="img/doc1.jpg">
                <br><br>


                lek. wet. Magdalena Wrona -
                Specjalista chorób psów i kotów, tel: 0 - 509-128-087<br> <img class="kolo" src="img/doc2.jpg">
                <br><br>


                lek. wet. Michał Bogierski -
                Specjalista chorób zwierząt egzotycznych, tel: 0 -509-128-042<br><img class="kolo" src="img/doc3.jpg">
            </p>
        </div>
        <div class="col-sm-4">

            <?php

            if (!isset($_SESSION['username'])) {


                echo '<div class="well" id="panel">';
                if (isset($_SESSION['signup_success'])) {

                    echo 'Rejestracja przebiegła pomyślnie. Możesz się zalogować';
                    unset($_SESSION['signup_success']);
                }
                echo <<<END
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
</div>
</div><br>

<footer class="container-fluid text-center">
    <p>Inżynieria Oprogramowania</p>
</footer>

</body>
</html>