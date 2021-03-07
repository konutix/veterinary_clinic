<?php

session_start();

if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

if (isset($_POST['title'])) {

    $accept = true;

    //title CHECK
    $title = $_POST['title'];
    if (strlen($title) < 1) {
        $accept = false;
        $_SESSION['err_title'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_title']);
    }

    //content CHECK
    $content = $_POST['content'];
    if (strlen($content) < 1) {
        $accept = false;
        $_SESSION['err_content'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_content']);
    }

    //img CHECK
    $img = $_POST['img'];
    if (strlen($img) < 1) {
        $accept = false;
        $_SESSION['err_img'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_img']);
    }

    $id_user = $_SESSION['id_user'];
    $date = date("Y/m/d");

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
                    $result = $connection->query("SELECT id FROM articles where id='$id'");
                } while ($result->num_rows > 1);

                if ($connection->query("INSERT INTO articles VALUES('$id','$id_user','$date','$title','$content','$img')")) {
                    header('Location: articles.php');
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
                <p class="logowanie">DODAJ ARTYKUŁ
                <form method="post">
                    <label>Tytuł:</label>
                    <input type="text" id="username" name="title">
                    <br>
                    <?php

                    if (isset($_SESSION['err_title'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_title'] . '</p>';
                    }

                    ?>
                    <br>
                    <label>Treść:</label>
                    <textarea id="password" name="content" style="height: 300px; resize: vertical"></textarea>
                    <br>
                    <?php

                    if (isset($_SESSION['err_content'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_content'] . '</p>';
                    }

                    ?>
                    <br>
                    <label>Link do Oobrazka:</label>
                    <input type="text" id="password" name="img">
                    <br>
                    <?php

                    if (isset($_SESSION['err_img'])) {
                        echo '<p style="color: darkred">' . $_SESSION['err_img'] . '</p>';
                    }

                    ?>
                    <div id="lower">
                        <input type="submit" value="OPUBLIKUJ">
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