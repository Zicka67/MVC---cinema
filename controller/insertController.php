<?php

namespace Controller;

use Model\Connect;

class InsertController
{
    //ajouter un film
    public function insertFilm()
    {
        //Connection
        $pdo = Connect::connectToDb();

        $requestDirector = $pdo->query(
            "
            SELECT fname, lname, id_director
            FROM director
            INNER JOIN person ON director.person_id = person.id_person
		"
        );

        $requestCategory = $pdo->query(
            "
            SELECT category_name, id_category
			FROM category 
		"
        );

        // vérifie si le bouton submit a été cliqué sur le formulaire avant de continuer
        if (isset($_POST["submit"])) {

            // Pour filtrer les entrées de formulaire reçues via $_POST.
            $film_name = filter_input(INPUT_POST, "film_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $dt_release = filter_input(INPUT_POST, "dt_release", FILTER_SANITIZE_NUMBER_INT);
            $dt_release = intval(substr($dt_release, 0, 4));
            $film_length = filter_input(INPUT_POST, "film_length", FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_SPECIAL_CHARS);
            $url_img = filter_input(INPUT_POST, "url_img", FILTER_SANITIZE_SPECIAL_CHARS);
            if (empty($url_img)) {
                $url_img = "";
            }
            $director_id = filter_input(INPUT_POST, "director", FILTER_SANITIZE_NUMBER_INT);
            //On précise qu'il faut un tab pour category
            $category = filter_input(INPUT_POST, "category" , FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);

            // Vérifie si toutes les entrées de formulaire requises ne sont pas vides et que les types de données reçus sont valides avant de faire l'insertion dans la DB
            if (!empty($film_name) && !empty($dt_release) && !empty($film_length) && !empty($synopsis) && !empty($url_img) && $director_id != false && !empty($director_id) && $category != false && !empty($category) && $note != false && !empty($note)) {
                
                // Connection a la DB
                $pdo = Connect::connectToDb();
                // var_dump($category); die;

                //On prépare la requete SQL pour envoyer dans le tab film
                $sqlRequest = $pdo->prepare(
                    "
                    INSERT INTO film (film_name, dt_release, film_length, synopsis, url_img, director_id, note)
                    VALUES (:film_name, :dt_release, :film_length, :synopsis, :url_img, :director_id, :note)	
                    "
                );
                //On exécute la requête SQL pour insérer des données dans le tab film avec les valeurs d'entrée transmises sous forme de tableau associatif
                $sqlRequest->execute([
                    "film_name" => $film_name, "dt_release" => $dt_release, "film_length" => $film_length, "synopsis" => $synopsis, "url_img" => $url_img, "director_id" => $director_id, "note" => $note
                ]);

                // Récupère le dernier ID inséré à partir du tab film
                $film_id = $pdo->lastInsertId();
                // var_dump($film_id); die;
                //Préparation de la requete
                $tabFilm = $pdo->prepare("
                    INSERT INTO appartenir (film_id, category_id)
                        VALUES (:film_id, :category_id)  
                ");

                //Exécute la requête SQL pour insérer des données dans le tab appartenir pour chaque category associée au film. 
                foreach($category as $cate){
                    $tabFilm->execute([
                        ":film_id" => $film_id,
                        ":category_id" => $cate
                    ]);

                }   

                //Redirige l'utilisateur vers listFilms après l'insertion réussie des données dans la DB. 
                header('Location: index.php?action=listFilms');
                die();
            }
        }
        require "view/insertAdmin/insertFilm.php";
    }

    //Ajout director
    public function insertDirector()
    {

        if (isset($_POST["submit"])) {


            $birthdate = filter_input(INPUT_POST, "bdate", FILTER_SANITIZE_SPECIAL_CHARS);
            $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);

            //Si non vide
            if (!empty($fname) && !empty($lname) && !empty($sexe) && !empty($birthdate)) {

                $pdo = Connect::connectToDb();


                $sqlRequest1 = $pdo->prepare(
                    "
                    INSERT INTO person (fname, lname, sexe, bdate, url_img)
                    VALUES ('bob', 'bobby', 'homme', '1942-07-13', '')
                    // VALUES (:fname, :lname, :sexe, :bdate, :url_img)
                    "
                );

                $sqlRequest1->execute(["fname" => $fname, "lname" => $lname, "sexe" => $sexe, "bhdate" => $birthdate]);

                header('location:index.php?action=listFilms');
                die();
            }
        }

        require "view/insertAdmin/insertDirector.php";
    }

    //Ajout category
    public function insertCategory()
    {
        if (isset($_POST["submit"])) {
            //Sécurité
            $category_name = filter_input(INPUT_POST, "category_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if (!empty($category_name)) {
                $pdo = Connect::connectToDb();


                $sqlRequest1 = $pdo->prepare(
                    "
                    INSERT INTO category (category_name)
                    VALUES (:category_name)
                    "
                );

                $sqlRequest1->execute(["category_name" => $category_name]);

                header('Location: index.php?action=listCategorys');
                die();
            }
        }

        require "view/insertAdmin/insertCategory.php";
    }

    //Ajout actor
    public function insertPerson()
    {

        if (isset($_POST["submit"])) {
            //Sécurité
            $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lname =  filter_input(INPUT_POST, "lname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $bdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_NUMBER_INT);
            $sexe =  filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $url_img =  filter_input(INPUT_POST, "url_img", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // var_dump($_POST['birthdate']);die;
            if (!empty($fname) && !empty($lname) && !empty($bdate) && !empty($sexe) && !empty($url_img)) {
                $pdo = Connect::connectToDb();

                $sqlRequest = $pdo->prepare(
                    "
                    INSERT INTO person (fname, lname, bdate, sexe, url_img)
                    VALUES (:fname, :lname, :bdate, :sexe, :url_img)
                    "
                );

                $sqlRequest->execute(["fname" => $fname, "lname" => $lname, "bdate" => $bdate, "sexe" => $sexe, "url_img" => $url_img]);

                header('location:index.php?action=listActors');
                // header('location:index.php?action=insertActors');
                die();
            }
        }

        require "view/insertAdmin/insertActor.php";
    }

    //Ajout role
    public function insertRole()
    {
        if (isset($_POST["submit"])) {

            //Securité
            $role_name = filter_input(INPUT_POST, "role_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (!empty($role_name)) {

                $pdo = Connect::connectToDb();


                $sqlRequest = $pdo->prepare(
                    "
                INSERT INTO role (role_name)
                VALUES (:role_name)
                "
                );

                $sqlRequest->execute(["role_name" => $role_name]);

                header('Location: index.php?action=listRoles');
                die();
            }
        }


        require "view/insertAdmin/insertRole.php";
    }


    //insert Casting to DB
    public function insertCasting()
    {
        $pdo = Connect::connectToDb();

        //FILM
        $requestFilm = $pdo->query(
            "
            SELECT film_name, id_film
            FROM film
            "
        );

        //PERSON
        $requestPerson = $pdo->query(
            "
            SELECT lname, fname, id_actor
            FROM actor
            INNER JOIN person ON actor.id_actor = person.id_person
            "
        );

        //ROLE
        $requestRole = $pdo->query(
            "
            SELECT role_name, id_role
            FROM role
            "
        );
        
        if (isset($_POST['submit'])) {
            
            // Securité
            $film_id = filter_input(INPUT_POST, "film_id", FILTER_SANITIZE_NUMBER_INT);
            $actor_id = filter_input(INPUT_POST, "actor_id", FILTER_SANITIZE_NUMBER_INT);
            $role_id = filter_input(INPUT_POST, "role_id", FILTER_SANITIZE_NUMBER_INT);
            // var_dump($actor_id); die; // film 0 - actor null - role ok


            if ($film_id != false && !empty($film_id) && $actor_id != false && !empty($actor_id) && $role_id != false && !empty($role_id)) {
                // var_dump($actor_id); die; //donne 1
                $pdo = Connect::connectToDb();

                $sqlRequest = $pdo->prepare(
                    "
                    INSERT INTO casting (film_id, actor_id, role_id)
                    VALUES (:film_id, :actor_id, :role_id)
                    "
                );
                // var_dump($sqlRequest); die;
                $sqlRequest->execute(["film_id" => $film_id, "actor_id" => $actor_id, "role_id" => $role_id]);


                header('Location: index.php?action=listCastings');
                die();
            };
        }

        require "view/insertAdmin/insertCasting.php";
    }
}
