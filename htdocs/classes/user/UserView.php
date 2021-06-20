<?php


class UserView extends UserModel
{
    public function showCredentials($id, $change, $message=NULL) {
        $userData = $this->getUserData($id);

        require "templates/clientHeader.html.php";

        echo '<div class="row">
                     <div class="column" <h2>Użytkownik</h2>
               <table>';

        switch($change) {
            case 1:
                require "templates/changePassword.html.php";
                break;
            case 2:
                require "templates/changeData.html.php";
                break;
            default:
                require "templates/userInfo.html.php";
                break;
        }

        if(!is_null($message)) {
            echo '<tr><td>'.$message.'</td></tr>';
        }

        echo '</table></div></div>';
        require "templates/clientFooter.html.php";
    }

}