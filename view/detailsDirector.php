<?php
ob_start();
?>

<div class="container-cards">
	<div class="card-film">
		<div class="container-flex">
			<div class="container-img">
				<?php
				if (isset($requestDirectorInfos)) {
					$director_infos = $requestDirectorInfos->fetch(); ?>
					<img class="img" src="<?=$director_infos['url_img'] ?>" alt="">
			</div>
			<div class="container-infos">
				<p><?= $director_infos["lname"] . " " . $director_infos["fname"] . " est un " . $director_infos["sexe"] . " né le " . $director_infos["bdate"]  ?> </p>
				<p> Filmographie </p>
			<?php } ?> <?php foreach ($requestDirectorFilmo->fetchAll() as $director_film) { ?>
			<p> - <a href="index.php?action=detailsFilm&id=<?= $director_film['id_film'] ?>"><?= $director_film["film_name"] . "</a> (" . $director_film["dt_release"] . " )"?><br> </p>
			<?php } ?>

			<?php
			$title = 'Films de « ' . ucfirst($director_infos["lname"]) . " " . ucfirst($director_infos["fname"]) . " »";
			$secondary_title = 'Films de « ' . ucfirst($director_infos["lname"]) . " " . ucfirst($director_infos["fname"]) . " »";
			?>
			</div>	
		</div>
	</div>
</div>

<?php
$content = ob_get_clean();

require "view/template.php";
?>