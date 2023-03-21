<?php
ob_start();
?>

<div class="container-cards">
    <?php
    foreach ($request->fetchAll() as $Category) { ?>

        <div class="card-film">
            <div class="container-flex">
                <!--<div class="container-img">
                    <a href="index.php?action=listCategory&id=<?= $Category["id_Category"] ?>">
                        <?php if (isset($Category["url_img"]) != "") { ?>
                            <img src="<?= $Category["url_img"] ?>" alt="">
                        <?php } else { ?>
                            <p>Aucune image disponible</p>
                        <?php } ?>
                    </a>
                </div> --> 
                <div class="container-infos">
                    <a href="index.php?action=detailsCategory&id=<?= $Category['id_category'] ?>"><p><?= $Category["category_name"] ?></p></a>                 
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php

$title = "Liste des Category";
$secondary_title = "Liste des Category";
$content = ob_get_clean();


require "template.php";
