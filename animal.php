<?php

session_start();

if(!isset($_SESSION['username']) || $_SESSION['username'] == 'doctor'){
    header('Location: index.php');
    exit();
}

if (isset($_POST['name'])) {

    $accept = true;
    
    //NAME CHECK
    $name = $_POST['name'];
    if (strlen($name) < 1) {
        $accept = false;
        $_SESSION['err_name'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_name']);
    }

    //BIRTH CHECK
    $birth = $_POST['birth'];
    if (strlen($birth) < 1) {
        $accept = false;
        $_SESSION['err_birth'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_birth']);
    }

    //sex CHECK
    $sex = $_POST['sex'];
    if (strlen($sex) < 1) {
        $accept = false;
        $_SESSION['err_sex'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_sex']);
    }

    //type CHECK
    $type = $_POST['type'];
    if (strlen($type) < 1) {
        $accept = false;
        $_SESSION['err_type'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_type']);
    }

    //race CHECK
    $race = $_POST['race'];
    if (strlen($race) < 1) {
        $accept = false;
        $_SESSION['err_race'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_race']);
    }

    $description = $_POST['description'];

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
                    $result = $connection->query("SELECT id FROM patients where id='$id'");
                } while ($result->num_rows > 1);

                if ($connection->query("INSERT INTO patients VALUES('$id','$name','$birth','$sex','$type','$race','$description','$id_user')")) {
                    header('Location: animals.php');
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
        </div>
    </div>
</nav>


<div class="container text-center gap2">
    <div class="row">

        <div class="col-sm-12">
            <div class="well" id="panel">
                <p class="logowanie">DODAJ ZWIERZAKA
                <form method="post">
                    <label>Imię:</label>
                    <input type="text" id="username" name="name">
                    <br>
                    <?php

                    if (isset($_SESSION['err_name'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_name'] . '</p>';
                    }

                    ?>
                    <br>
                    <label>Data urodzenia:</label>
                    <input type="date" id="password" name="birth">
                    <br>
                    <?php

                    if (isset($_SESSION['err_birth'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_birth'] . '</p>';
                    }

                    ?>
                    <br>
                    <label>Płeć:</label>
                    <input type="text" id="password" name="sex">
                    <br>
                    <?php

                    if (isset($_SESSION['err_sex'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_sex'] . '</p>';
                    }

                    ?>
                    <br>
                    <label>Typ zwierzaka:</label>
                    <input type="text" id="password" name="type">
                    <br>
                    <?php

                    if (isset($_SESSION['err_type'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_type'] . '</p>';
                    }

                    ?>
                    <br>
                    <label>Rasa:</label>
                    <input type="text" id="password" name="race">
                    <br>
                    <?php

                    if (isset($_SESSION['err_race'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_race'] . '</p>';
                    }

                    ?>
                    <br>
                    <label>Opis:</label>
                    <input type="text" id="password" name="description">
                    <div id="lower">
                        <input type="submit" value="DODAJ">
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