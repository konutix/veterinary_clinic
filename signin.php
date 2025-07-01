<?php

session_start();
if(!isset($_POST['login'])){
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno != 0) {
    echo "Error: " . $connection->connect_errno . "Opis: " . $connection->connect_error;
} else {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    if ($result = @$connection->query(
        sprintf("SELECT * FROM users WHERE login='%s'",
            mysqli_real_escape_string($connection, $login)))) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])){

            $_SESSION['username'] = $row['username'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];

            unset($_SESSION['error']);

            $result->free_result();
            header('Location: index.php');

        } else {

            $_SESSION['error'] = '<span style="color:darkred">Nieprawidłowy login lub hasło!</span>';
            header('Location: index.php');

        }

    }

    $connection->close();
}

?>