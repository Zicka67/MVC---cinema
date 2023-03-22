<?php
ob_start();
?>

<form action="index.php?action=insertRoles" method="post">

    <div class="form">
        <label for="role_name">Role Name</label>
        <input type="textarea" name="role_name" id="role_name">
    </div>

    <div class="form formLast">
    <input type="submit" name="submit" value="Insert Role">
    </div>

</form>

<?php
$title = "Insert role";
$secondary_title = "Insert role";
$content = ob_get_clean();
require "view/admin.php";
?>