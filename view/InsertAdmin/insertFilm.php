<?php
ob_start();
?>
<form action="index.php?action=insertFilm" method="post">

    <label for="film_name">Titre</label>
    <input type="textarea" name="film_name" id="film_name">

    <label for="film_length">Durée</label>
    <input type="number" name="film_length" id="film_length">

    <label for="dt_release">Dt sortie</label>
    <input type="number" name="dt_release" id="dt_release">

    <label for="url_img">Affiche</label>
    <input type="textarea" name="url_img" id="url_img">

    <label for="synopsis">Synopsis :</label>
    <input type="textarea" name="synopsis" id="synopsis">

    <label for="note">Note </label>
    <input type="number" min="0" max="5" name="note" id="note">

    <input type="submit" name="submit" value="Ajouter le film">

    </form>
        
        
        
        <?php
$title = "Add film";
$secondary_title = "Add film";
$content = ob_get_clean();
require "view/admin.php";
?>