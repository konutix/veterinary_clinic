<?php
include "./classes/includes.php";
session_start();
$_SESSION["accessType"]=null;
if(!isset($_SESSION["userID"])){
    header("Location: ./register.php");
}

//zalogowany uzytkownik
$user = new User($_SESSION['userID']);

$hashAlg = "md5";
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch($action) {
        case 'showChange':
            $user->showChangePassword();
            break;

        case 'changePassword':
            if ($_POST['oldPassword'] != "" && hash($hashAlg, $_POST['oldPassword']) == $user->getPasswordHash()) {
                if  ($_POST['newPassword'] == "" || (strlen($_POST['newPassword']) < 5)) {
                    $user->showChangePassword("Nowe hasło nieprawidłowe.");
                } else {
                    $result = $user->changePassword(hash($hashAlg, $_POST['newPassword']));
                    if ($result == 0) {
                        $user->showCredentials("Hasło zmienione.");
                    } else {
                        $user->showCredentials("Wystąpił błąd. Spróbuj ponownie później.");
                    }
                }
            } else {
                $user->showChangePassword("Stare hasło nieprawidłowe.");
            }
            break;

        case 'showDataChange':
            $user->showChangeData();
            break;

        case 'changeData':
            $result = $user->changeData($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['address']);

            if ($result == 0) {
                $user->showCredentials("Dane zmienione");
            } else {
                $user->showCredentials("Wystąpił błąd. Spróbuj ponownie później.");
            }
            break;
    }

} else {
    $user->showCredentials();
}

echo '<input type="button" value="Home" class="redirBtn" onClick="document.location.href=\'./index.php\'" />';

?>