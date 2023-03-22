<?php

//Pour use la classe CinemaController dans controller
use Controller\CinemaController;
use Controller\insertController;

spl_autoload_register(function ($class_name) {
	include $class_name . '.php';
});

$controllerCinema = new CinemaController();
$controllerCinemaInsert = new InsertController();

if (isset($_GET["id"])) {
	//FILTER pour les int
	($id = filter_var($_GET["id"], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE));
}

//Vérifie si la variable $_GET["action"] existe. La variable $_GET est un tableau associatif qui contient les paramètres passés dans l'URL. Dans ce cas, nous cherchons le paramètre "action".
if (isset($_GET["action"])) {
	//Utilise une instruction switch pour exécuter une action différente en fonction de la valeur de $_GET["action"]. Cela signifie que si la valeur de $_GET["action"] correspond à l'une des options dans la structure switch, l'instruction appropriée sera exécutée.
	switch ($_GET["action"]) {
		//Si la valeur de $_GET["action"] est "listFilms", le contrôleur CinemaController appelle la méthode listFilms(). 
		case "listFilms":
			$controllerCinema->listFilms();
			break;
		case "listDirectors":
			$controllerCinema->listDirectors();
			break;
		case "listActors":
			$controllerCinema->listActors();
			break;
		case "listCategorys":
			$controllerCinema->listCategorys();
			break;
		case "listRoles":
			$controllerCinema->listRoles();
			break;
		case "listCastings":
			$controllerCinema->listCastings();
			break;

			// *****************************

		case "detailsFilm":
			$controllerCinema->detailsFilm($id);
			break;
		case "detailsDirector":
			$controllerCinema->detailsDirector($id);
			break;
		case "detailsActor":
			$controllerCinema->detailsActor($id);
			break;
		case "detailsCategory":
			$controllerCinema->detailsCategory($id);
			break;
			// case "detailsCasting":
			// 	$controllerCinema->detailsCasting($id);
			// 	break;
		// case "detailsRole":
		// 	$controllerCinema->detailsRoles($id_role);
		// 	break;


			// ***** ADMIN ****

			case "admin":
				$controllerCinema->admin();
				break;

			// ****************


			// case "insertFilm":
			// 	$controllerCinema->insertFilm();
			// 	break;
			case "insertDirectors":
				$controllerCinemaInsert->insertPerson();
				break;
			case "insertActors":
				$controllerCinemaInsert->insertPerson();
				break;
			// case "insertPerson":
			// 	$controllerCinema->insertPerson();
			// 	break;  ??
			// case "insertCategory":
			// 	$controllerCinema->insertCategory();
			// 	break;	
			// case "insertRole":
			// 	$controllerCinema->insertRole();
			// 	break;
			// case "insertCasting":
			// 	$controllerCinema->insertCasting();
			// 	break;

			// ********DELET************

			// case "deletFilm":
			// 	$controllerCinema->deletFilm();
			// 	break;
			// case "deletDirector":
			// 	$controllerCinema->deletDirector();
			// 	break;
			// case "deletActor":
			// 	$controllerCinema->deletActor();
			// 	break;
			// case "deletCategory":
			// 	$controllerCinema->deletCategory();
			// 	break;	
			// case "deletRole":
			// 	$controllerCinema->deletRole();
			// 	break;
			// case "deletCasting":
			// 	$controllerCinema->deletCasting();
			// 	break;

	}
} else { //Page par défaut (HomePage)
	$controllerCinema->HomePage();
}
