<?php
ob_start();
?>

<form action="index.php?action=insertActors" method="post">

    <div class="form">
        <label for="film_name">Lname</label>
        <input type="textarea" name="lname" id="lname">
    </div>

    <div class="form">
    <label for="film_length">Fname</label>
    <input type="textarea" name="fname" id="fname">
    </div>

    <div class="form">
    <label for="dt_release">Sexe</label>
    <input type="textarea" name="sexe" id="sexe">
    </div>

    <div class="form">
    <label for="url_img">Bdate</label>
    <input type="date" name="Bdate" id="Bdate">
    </div>

    <div class="form">
    <label for="synopsis">url_img</label>
    <input type="textarea" name="url_img" id="url_img">
    </div>

    <div class="form formLast">
    <input type="submit" name="submit" value="Insert actor">
    </div>

</form>

<?php
$title = "Insert actor";
$secondary_title = "Insert actor";
$content = ob_get_clean();
require "view/admin.php";
?>