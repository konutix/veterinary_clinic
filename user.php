<?php
include "./classes/includes.php";
session_start();


if($_SESSION["userID"]==null){
    header("Location: ./login.php");
}

//zalogowany uzytkownik
$user = new User($_SESSION['userID']);

$hashAlg = "md5";

if (isset($_GET['action']) && $_GET['action'] == 'showChange') {
    $user->showChangePassword();
} else if (isset($_GET['action']) && $_GET['action'] == 'changePassword') {
    if ($_POST['oldPassword'] != "" && hash($hashAlg, $_POST['oldPassword']) == $user->getPasswordHash()) {
        if  ($_POST['newPassword'] == "" || (strlen($_POST['newPassword']) < 5)) {
            $user->showChangePasswordMessage("Nowe hasło nieprawidłowe.");
        } else {
            $result = $user->changePassword(hash($hashAlg, $_POST['newPassword']));
            if ($result == 0) {
                $user->showCredentialsMessage("Hasło zmienione.");
            } else {
                $user->showCredentialsMessage("Wystąpił błąd. Spróbuj ponownie później.");
            }
        }
    } else {
        $user->showChangePasswordMessage("Stare hasło nieprawidłowe.");
    }
} else {
    $user->showCredentials();
}

echo '<input type="button" value="Home" class="redirBtn" onClick="document.location.href=\'./index.php\'" />';

?>