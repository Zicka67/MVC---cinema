<?php


ob_start();
$film = $requestFilmInfos->fetch();
?>
<div class="container-cards">
	<div class="card-film">
		<div class="container-flex">
			<div class="container-img">
				<img class="img" src="<?= $film["url_img"]?>" alt="affiche<?=$film["film_name"]?>">
			
			</div>
			<div class="container-infos">
				<p><?= $film["film_name"] ?></p> 
				<p>Sortie en <?= $film["dt_release"] ?></p>
				<p><?= ucfirst($film["film_length"]) ?> min</p>
				<p><?= ucfirst($film["category_name"]) ?></p>
				<p><?php $times = $film["note"];
					echo str_repeat("<i class='fa-solid fa-star'></i>", $times);
					echo str_repeat("<i class='fa-regular fa-star'></i>", 5 - $times); ?>
				</p>
				<p>Synopsis : <?= $film["synopsis"] ?></p>
				<!-- actor listing -->
				<?php foreach ($requestCastingInfos->fetchAll() as $casting) { ?>
					<p><a href="index.php?action=detailsActor&id=<?= $casting['id_actor'] ?>"><?= $casting["lname"] . " " . $casting["fname"] . "</a> à joué " . $casting["role_name"] ?></p>
				<?php }	?>
				<!-- // director listing  -->
				<?php foreach ($requestCastingInfosRea->fetchAll() as $casting) { ?>
					<p><a href="index.php?action=detailsDirector&id=<?= $casting['id_director'] ?>"><?= $casting["lname"] . " " . $casting["fname"] . "</a> à réalisé " . $casting["film_name"] ?></p>
				<?php }	?>
			
				</div>
			</div>
		</div>
	</div>
</div>


<?php

$title = "Détails du film";
$secondary_title = "Détails du film";
$content = ob_get_clean();


require "view/template.php";
