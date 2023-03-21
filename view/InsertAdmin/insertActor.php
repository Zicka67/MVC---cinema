<?php
ob_start();
?>
<form action="index.php?action=insertActors" method="post">

    <label for="film_name">Lname</label>
    <input type="textarea" name="lname" id="lname">

    <label for="film_length">Fname</label>
    <input type="textarea" name="fname" id="fname">

    <label for="dt_release">Sexe</label>
    <input type="textarea" name="sexe" id="sexe">

    <label for="url_img">Bdate</label>
    <input type="date" name="Bdate" id="Bdate">

    <label for="synopsis">url_img</label>
    <input type="textarea" name="url_img" id="url_img">

    <input type="submit" name="submit" value="Insert actor'">

    </form>
        
        
        
        <?php
$title = "Insert actor";
$secondary_title = "Insert actor";
$content = ob_get_clean();
require "view/admin.php";
?>