<?php
ob_start();
?>
<form action="index.php?action=insertFilms" method="post">

    <div class="form">
        <label for="film_name">Titre</label>
        <input type="textarea" name="film_name" id="film_name">
    </div>

    <div class="form">
        <label for="dt_release">Dt sortie</label>
        <input type="date" name="dt_release" id="dt_release">
    </div>

    <div class="form">
        <label for="film_length">Durée</label>
        <input type="number" name="film_length" id="film_length">
    </div>

    <div class="form">
        <label for="synopsis">Synopsis</label>
        <input type="textarea" name="synopsis" id="synopsis">
    </div>

    <div class="form">
        <label for="url_img">Affiche</label>
        <input type="textarea" name="url_img" id="url_img">
    </div>

    <div class="form">
        <label for="director">Director</label>
        <select name="director" id="director">
        <?php 
            foreach($requestDirector->fetchAll() as $director){
                echo "<option value='".$director['id_director']."'>".$director['lname']."</option>";
            }; 
            ?>
        </select>
    </div>

    <div class="form">
        <label for="category">category</label>
        <select name="category" id="category">
        <?php 
            foreach($requestCategory->fetchAll() as $category){
                echo "<option value='".$category['id_category']."'>".$category['category_name']."</option>";
            }; 
            ?>
        </select>
    </div>

    <div class="form">
        <label for="note">Note </label>
        <input type="number" min="0" max="5" name="note" id="note">
    </div>

    <div class="formLast">
        <input type="submit" name="submit" value="Ajouter le film">
    </div>

</form>



<?php
$title = "Add film";
$secondary_title = "Add film";
$content = ob_get_clean();
require "view/admin.php";
?>