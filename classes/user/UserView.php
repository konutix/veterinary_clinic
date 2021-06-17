<?php


class UserView extends UserModel
{
    public function showCredentials($id, $change, $message=NULL) {
        $userData = $this->getUserData($id);
        $changePassword = $change;
        require "templates/clientHeader.html.php";

        echo '<div class="row">
                     <div class="column" <h2>Użytkownik</h2>
               <table>';

        if($change) {
            require "templates/changePassword.html.php";
        } else {
            require "templates/userInfo.html.php";
        }

        if(!is_null($message)) {
            echo '<tr><td>'.$message.'</td></tr>';
        }

        echo '</table></div></div>';
        require "templates/clientFooter.html.php";
    }

}