<?php
ob_start();
?>

<div class="container-cards">
    <?php
    foreach ($request->fetchALL() as $role) { ?>

        <div class="card-film">
            <div class="container-flex">
                <!--<div class="container-img">
                    <a href="index.php?action=listRoles&id=<?= $role["id_role"] ?>">
                        <?php if (isset($role["url_img"]) != "") { ?>
                            <img src="<?= $role["url_img"] ?>" alt="">
                        <?php } else { ?>
                            <p>Aucune image disponible</p>
                        <?php } ?>
                    </a>
                </div> --> 
                <div class="container-infos">
                    <p><?= $role["role_name"] ?></p> </a>
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
