<?php
ob_start();
?>

<div class="container-cards">
    <?php
    foreach ($request->fetchAll() as $director) { ?>

        <div class="card-film">
            <div class="container-flex">
                <div class="container-img">
                    <a href="index.php?action=detailsDirector&id=<?= $director["id_director"] ?>">
                        <?php if (isset($director["url_img"]) != "") { ?>
                            <img src="<?= $director["url_img"] ?>" alt="<?= ucfirst($director["lname"]) . " " . ucfirst($director["fname"]) ?>">
                        <?php } else { ?>
                            <p>Aucune image disponible</p>
                        <?php } ?>
                    </a>
                </div>
                <div class="container-infos">
                    <p><?= ucfirst($director["lname"]) . " " . ucfirst($director["fname"]) ?></p>
                    <p><?= $director["bdate"] ?></p>
                    <p><?= $director["sexe"] ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<?php
$title = "Liste des réalisateurs";
$secondary_title = "Liste des réalisateurs";
$content = ob_get_clean();

require "template.php";
?>