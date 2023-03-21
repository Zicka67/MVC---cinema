<?php
ob_start();
?>

<div class="container-cards">
        <?php
        foreach ($request->fetchAll() as $actor) { ?>

                <div class="card-film">
                        <div class="container-flex">
                                <div class="container-img">
                                        <a href="index.php?action=detailsActor&id=<?= $actor["id_actor"] ?>">
                                                <img class="img" src="<?= $actor["url_img"] ?>" alt="<?= ucfirst($actor["lname"]) . " " . ucfirst($actor["fname"]) ?>">
                                        </a>
                                </div>
                                <div class="container-infos">
                                        <p><?= ucfirst($actor["lname"]) . " " . ucfirst($actor["fname"]) ?></p>
                                        <p><?= $actor["bdate"] ?></p>
                                        <p><?= $actor["sexe"] ?></p>
                                </div>
                        </div>
                </div>
        <?php } ?>
</div>
<?php

$title = "Liste des acteurs";
$secondary_title = "Liste des acteurs";
$content = ob_get_clean();


require "template.php";
