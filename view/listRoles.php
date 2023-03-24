<?php
ob_start();
?>

<div class="container-cards">
    <?php
    foreach ($request->fetchALL() as $role) { ?>

        <div class="card-film">
            <div class="container-flex">
                <div class="container-infos">

                    <p> <a href="index.php?action=detailsRole&id=<?= $role["id_role"] ?>"><?= $role["role_name"] ?></a></p>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php

$title = "Liste des roles";
$secondary_title = "Liste des roles";
$content = ob_get_clean();


require "template.php";
