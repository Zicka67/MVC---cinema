<?php
ob_start();
?>

<form action="index.php?action=insertCategorys" method="post">

    <div class="form">
        <label for="category_name">Category Name</label>
        <input type="textarea" name="category_name" id="category_name">
    </div>

    <div class="form formLast">
    <input type="submit" name="submit" value="Insert category">
    </div>

</form>

<?php
$title = "Insert actor";
$secondary_title = "Insert actor";
$content = ob_get_clean();
require "view/admin.php";
?>