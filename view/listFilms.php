<?php

// ************************
$films = $request->fetchAll();


// ************************

//Pour afficher les erreur PHP
ini_set('display_errors', 1); //active l'affichage des erreurs
ini_set('display_startup_errors', 1); //active l'affichage des erreurs qui surviennent lors du démarrage de PHP.
error_reporting(E_ALL); //définit le niveau de rapport d'erreurs sur E_ALL, ce qui signifie qu'il va afficher toutes les erreurs PHP, y compris les erreurs de syntaxe, les erreurs de logique, les avertissements et les notices.


//ob_start() est utilisée pour mettre en mémoire tampon la sortie du script PHP. 
//Lorsque cette fonction est appelée, elle active la mise en mémoire tampon de la sortie et tous les résultats générés par la suite 
//seront stockés dans un tampon plutôt que d'être envoyés directement à la sortie.
ob_start();
?>

<div class="container-cards">
	<?php
	//$request->fetchAll() à la place de $films
	foreach ($films as $film) { ?>


		<div class="card-film">
			<div class="container-flex">
				<div class="container-img">
					<a href="index.php?action=detailsFilm&id=<?= $film["id_film"] ?>">
						<img class="img" src="<?= $film["url_img"] ?>" alt="affiche<?= $film["film_name"] ?>">
					</a>
				</div>
				<div class="container-infos">
					<a href="index.php?action=detailsFilm&id=<?= $film["id_film"] ?>"><?= $film["film_name"] ?></a>
					<p>Sortie en <?= $film["dt_release"] ?></p>
					<a href="index.php?action=detailsfilm&id=<?= $film["id_film"] ?>"><?= ucfirst($film["category_name"]) ?></a>
					<p>Durée : <?= ucfirst($film["film_length"]) ?> min</p>
					<p><?php $times = $film["note"];
						echo str_repeat("<i class='fa-solid fa-star'></i>", $times);
						echo str_repeat("<i class='fa-regular fa-star'></i>", 5 - $times); ?>
					</p>
					<p>Synopsis : <br> <br> <span> <?= ucfirst($film["synopsis"]) ?> </span></p>
				</div>
			</div>
		</div>

	<?php } ?>
</div>

<?php

$title = "Actuellement en salle";
$secondary_title = "Actuellement en salle";
//ob_get_clean() est utilisée pour récupérer le contenu de la mémoire tampon et la vider en même temps. 
//elle retourne le contenu de la mémoire tampon comme une chaîne de caractères et supprime le tampon de sortie.
$content = ob_get_clean();
//L'utilisation de ces fonctions peut être utile lorsque l'on doit générer une sortie conditionnelle ou 
//lorsque l'on doit modifier la sortie générée avant qu'elle ne soit envoyée à la sortie.



require "template.php"; ?>