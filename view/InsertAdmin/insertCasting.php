<?php
ob_start();
?>
<form action="index.php?action=insertCastings" method="post">


    <div class="form">
        <label for="film_id">Name </label>
        <select name="film_id" id="film_id">
            <?php
            foreach ($requestFilm->fetchAll() as $film) {
                echo "<option value='" . $film['film_id'] . "'>" . $film['film_name'] . "</option>";
            }; ?>
        </select>
    </div>

    <div class="form">
        <label for="person_id">Person </label>
        <select name="person_id" id="person_id">
            <?php
            foreach ($requestPerson->fetchAll() as $person) {
                echo "<option value='" . $person['id_person'] . "'>" . $person['lname'] . "</option>";
            }; ?>
        </select>
    </div>

    <div class="form">
        <label for="role_id">Role </label>
        <select name="role_id" id="role_id">
            <?php
            foreach ($requestRole->fetchAll() as $role) {
                echo "<option value='" . $role['id_role'] . "'>" . $role['role_name'] . "</option>";
            }; ?>
    </div>


    <div class="formLast">
        <input type="submit" name="submit" value="Insert casting">
    </div>

</form>

<?php
$title = "Insert casting";
$secondary_title = "Insert casting";
$content = ob_get_clean();
require "view/admin.php";
?>