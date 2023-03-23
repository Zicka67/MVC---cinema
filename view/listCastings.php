<?php
ob_start();
?>

<div class="container-cards">
        <?php
        foreach ($request->fetchAll() as $castings) { ?>

                <div class="card-film">
                        <div class="container-flex">
                                <div class="container-img">
                                        <a href="">
                                        </a>
                                </div>
                                <div class="container-infos">
                                        <a href="index.php?action=detailsActor&id=<?=$castings['id_actor']?>"><?= ucfirst($castings["lname"]) . " " . ucfirst($castings["fname"]) ?></a>
                                        <br>
                                        <a href="index.php?action=detailsFilm&id=<?=$castings['id_film']?>"> <?= ucfirst($castings["film_name"]) ?> </a>
                                        <br>
                                        <a href="index.php?action=detailsRole&id=<?=$castings['id_role']?>"> <?= ucfirst($castings["role_name"]) ?> </a>
                                </div>
                                
                        </div>
                </div>
        <?php } ?>
</div>
<?php

$title = "List Castings";
$secondary_title = "List Castings";
$content = ob_get_clean();


require "template.php";