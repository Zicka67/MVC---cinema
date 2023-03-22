<?php
ob_start();
?>
<form action="index.php?action=insertCastings" method="post">

    <div class="form">
        <label for="film_id">film_id</label>
        <input type="number" name="film_id" id="film_id">
    </div>

    <div class="form">
        <label for="actor_id">actor_id</label>
        <input type="number" name="actor_id" id="actor_id">
    </div>

    <div class="form">
        <label for="role_id">role_id</label>
        <input type="number" name="role_id" id="role_id">
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