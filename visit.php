<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['username'] == 'doctor'){
    header('Location: index.php');
    exit();
}

if (isset($_POST['adress'])) {

    $accept = true;

    //DATE CHECK
    $date = $_POST['date'];
    if (strtotime($date) > 0) {
        unset($_SESSION['err_date']);
    } else {
        $accept = false;
        $_SESSION['err_date'] = "Wypełnij to pole";
    }

    //time CHECK
    $time = $_POST['time'];
    if (strtotime($time)) {
        unset($_SESSION['err_time']);
    } else {
        $accept = false;
        $_SESSION['err_time'] = "Wypełnij to pole";
    }

    //patients CHECK
    if (isset($_POST['patients'])) {
        $patients = $_POST['patients'];
        if (strlen($patients[0]) < 1) {
            $accept = false;
            $_SESSION['err_patients'] = "Wypełnij to pole";
        } else {
            unset($_SESSION['err_patients']);
        }
    } else {
        $accept = false;
        $_SESSION['err_patients'] = "Wypełnij to pole";
    }

    //doctor CHECK
    if (isset($_POST['doctor'])) {
        $doctor = $_POST['doctor'];
        if (strlen($doctor) < 1) {
            $accept = false;
            $_SESSION['err_doctor'] = "Wypełnij to pole";
        } else {
            unset($_SESSION['err_doctor']);
        }
    } else {
        $accept = false;
        $_SESSION['err_doctor'] = "Wypełnij to pole";
    }

    //setting adress
    $adress = $_POST['adress'];

    //type of visit CHECK
    $type = $_POST['type'];
    if (strlen($type) < 1) {
        $accept = false;
        $_SESSION['err_type'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_type']);
    }

    $id_user = $_SESSION['id_user'];

    //DATABASE CONNECTION
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            if ($accept) {

                do {
                    $id = rand(9999999, 99999999);
                    $result = $connection->query("SELECT id FROM visits where id='$id'");
                } while ($result->num_rows > 1);

                $animals = '';

                foreach ($patients as $patient) {

                    $animals = $animals . $patient . ' ';

                }

                $id_user = $_SESSION['id_user'];

                if ($connection->query("INSERT INTO visits VALUES('$id','$date','$time',$doctor,'$id_user','$animals','$adress','$type')")) {
                    header('Location: visits.php');
                    exit();
                } else {
                    throw new Exception($connection->error);
                }
            }
            $connection->close();
        }
    } catch (Exeption $err) {
        echo '<span style="color:darkred">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title> BOIVET - Umów wizytę </title>
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

<div class="col-md-3" style="left: 5%; top: 5%; position: absolute; width: 27%">
    <img src="img/logo.png" style="width: 100%">
</div>


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
        </div>
    </div>
</nav>


<div class="container text-center gap2">
    <div class="row">

        <div class="col-sm-12">
            <div class="well" id="panel">
                <p class="logowanie">UMÓW WIZYTĘ
                <form method="post">
                    <label for="data">Data:</label>
                    <input type="date" id="username" name="date">
                    <br>
                    <?php

                    if (isset($_SESSION['err_date'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_date'] . '</p>';
                    }

                    ?>
                    <br>
                    <label for="godzina">Godzina:</label>
                    <input type="time" id="password" name="time">
                    <br>
                    <?php

                    if (isset($_SESSION['err_time'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_time'] . '</p>';
                    }

                    ?>
                    <br>
                    <label for="adres">Adres z miejscowością<br>(jeżeli z dojazdem):</label>
                    <input type="text" id="password" name="adress">
                    <br>

                    <div class="well left">
                        <label for="zwierzaki">Zwierzaki:</label>
                        <?php
                        require_once "connect.php";
                        $connection = new mysqli($host, $db_user, $db_password, $db_name);
                        $id_user = $_SESSION['id_user'];
                        if ($connection->connect_errno != 0) {
                            echo "Error: " . $connection->connect_errno . "Opis: " . $connection->connect_error;
                        } else {
                            if ($result = @$connection->query("SELECT * FROM patients WHERE id_user='$id_user'")) {

                                while ($row = $result->fetch_assoc()) {
                                    echo '<br>';
                                    echo '<input type="checkbox" name="patients[]" value="' . $row['name'] . '"> ' . $row['name'] . ' (' . $row['type'] . ')';
                                }
                                echo '<br>';
                            }
                        }
                        ?>

                        <?php

                        if (isset($_SESSION['err_patients'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_patients'] . '</p>';
                        }

                        ?>
                    </div>
                    <br>
                    <br>
                    <div class="well left">
                        <label for="imienazwisko">Doktor:</label>
                        <?php
                        if ($connection->connect_errno != 0) {
                            echo "Error: " . $connection->connect_errno . "Opis: " . $connection->connect_error;
                        } else {
                            if ($result = @$connection->query("SELECT * FROM users WHERE status='doctor'")) {

                                while ($row = $result->fetch_assoc()) {
                                    echo '<br>';
                                    echo '<input type="radio" name="doctor" value="' . $row['id'] . '"> ' . $row['name'] . ' ' . $row['surname'];
                                }
                                echo '<br>';
                                $result->free_result();
                            }
                            $connection->close();
                        }
                        ?>
                        <?php

                        if (isset($_SESSION['err_doctor'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_doctor'] . '</p>';
                        }

                        ?>
                        <br>
                    </div>
                    <label for="powod">Typ wizyty:</label>
                    <input type="text" id="password" name="type">
                    <br>
                    <?php

                    if (isset($_SESSION['err_type'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_type'] . '</p>';
                    }

                    ?>
                    <br>
                    <div id="lower">
                        <input type="submit" value="ZAREZERWUJ">
                    </div>
                </form>
            </div>
            </p>
        </div>
    </div>
</div>
</div><br>

<footer class="container-fluid text-center">
    <p>Kacper Kurowski, BOIVET 2018</p>
</footer>

</body>
</html>