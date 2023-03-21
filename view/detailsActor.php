<?php
ob_start();
?>

<div class="container-cards">
	<div class="card-film">
		<div class="container-flex">
			<div class="container-img">
				<?php
				if (isset($requestActorInfos)) {
					$actor_infos = $requestActorInfos->fetch(); ?>
					<img class="img" src="<?=$actor_infos['url_img'] ?>" alt="index.php?action=detailsFilm&id=<?=$film['id_film'] ?>">
			</div>
			<div class="container-infos">
				<p><?= $actor_infos["lname"] . " " . $actor_infos["fname"] . " est un " . $actor_infos["sexe"] . " né le " . $actor_infos["bdate"]  ?> </p>
				<p> Filmographie </p>
			<?php } ?> <?php foreach ($requestActorFilmo->fetchAll() as $actor_film) { ?>
			<p> - <a href="index.php?action=detailsFilm&id=<?= $actor_film['id_film'] ?>"><?= $actor_film["film_name"] . "</a> (" . $actor_film["dt_release"] . ") 
    à joué " . $actor_film["role_name"] ?><br> </p>
			<?php } ?>

			<?php
			$title = 'Films de « ' . ucfirst($actor_infos["fname"]) . " " . ucfirst($actor_infos["lname"]) . " »";
			$secondary_title = 'Films de « ' . ucfirst($actor_infos["fname"]) . " " . ucfirst($actor_infos["lname"]) . " »";
			?>
			</div>	
		</div>
	</div>
</div>

<?php
$content = ob_get_clean();

require "view/template.php";
?>