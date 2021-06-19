<?php
require "templates/userMenu.html.php";
echo "<input type=\"button\" value=\"Zarządzaj\"  class=\"redirBtn\" onClick=\"document.location.href='./manage.php'\" />";
echo "
    <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
        <input type=\"hidden\" name=\"accessType\" value=2>
        <input id=\"register\" name=\"register\" class=\"redirBtn\" type=\"submit\" value=\"Dodaj weterynarza\">
    </form>
    <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
        <input type=\"hidden\" name=\"accessType\" value=3>
        <input id=\"register\" name=\"register\" class=\"redirBtn\" type=\"submit\" value=\"Dodaj klienta\">
    </form>";
?>