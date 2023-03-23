<?php

namespace Controller;

//Pour use la classe Connect dans Model
use Model\Connect;

class CinemaController
{
    //HomePage
    public function homePage()
    {
        $pdo = Connect::connectToDb();
        $request = $pdo->query(
            "
            SELECT *
            FROM film 
            INNER JOIN appartenir ON film.id_film = appartenir.film_id
            INNER JOIN category ON appartenir.film_id = category.id_category
            WHERE film.id_film = 1
            "
        );
        
        include 'view/homePage.php';
    }
    
    //Admin
    public function admin()
    {
        require "view/admin.php";
    }
    
    //Liste des films
    public function listFilms()
    {
        // La méthode listFilms du contrôleur CinemaController utilise la méthode connectToDb de la classe Connect 
        // pour établir une connexion à la DB.
        $pdo = Connect::connectToDb();
        
        
        
        // Le résultat est stocké dans la variable $pdo pour être utilisé dans la requête SQL.
        $request = $pdo->query(
            "
            SELECT *
            FROM film 
            INNER JOIN appartenir ON film.id_film = appartenir.film_id
            INNER JOIN category ON appartenir.category_id = category.id_category
            "
        );
        //Link à la view correspondante
        require "view/listFilms.php";
    }
    
    // *****************************************************
    
    //Liste des directors
    public function listDirectors()
    {
        $pdo = Connect::connectToDb();
        $request = $pdo->query(
            "
            SELECT id_director, person.fname, lname, sexe, DATE_FORMAT(bdate, '%d-%m-%Y') AS bdate, person.url_img
            FROM director
            INNER JOIN person ON director.person_id = person.id_person
            "
        );
        
        require "view/listDirectors.php";
    }
    
    // *****************************************************
    
    //Liste des acteurs
    public function listActors()
    {
        
        $pdo = Connect::connectToDb();
        $request = $pdo->query(
            "
            SELECT id_actor, fname, lname, sexe, DATE_FORMAT(bdate, '%d-%m-%Y') AS bdate, url_img
            FROM actor
            INNER JOIN person ON actor.person_id = person.id_person
            
            "
        );
        
        require "view/listActors.php";
    }
    
    // *****************************************************
    
    //Liste des catégories
    public function listCategorys()
    {
        
        $pdo = Connect::connectToDb();
        $request = $pdo->query(
            "
            SELECT id_category, category_name
            FROM category 
            "
        );
        
        require "view/listCategorys.php";
    }
    
    // *****************************************************
    
    //Liste des roles
    public function listRoles()
    {
        $pdo = Connect::connectToDb();
        $request = $pdo->query(
            "
            SELECT id_role,role_name
            FROM role
            "
        );
        
        require "view/listRoles.php";
    }
    
    // *****************************************************
    
    //Liste des castings
    public function listCastings()
    {
        $pdo = Connect::connectToDb();
        $request = $pdo->query(
            "
            SELECT id_film, film_name, id_actor, fname, lname, id_role, role_name
            FROM casting
            INNER JOIN person ON casting.actor_id = person.id_person
            INNER JOIN role ON casting.role_id = role.id_role
            INNER JOIN film ON casting.film_id = film.id_film
            INNER JOIN actor ON person.id_person = actor.person_id
            "
        );
        
        require "view/listCastings.php";
    }
    
    
    // ************************************************** PARTICULAR REQUEST **************************************************
    
    
    //Un film en particulier
    public function detailsFilm($id_film)
    {
        
        $pdo = Connect::connectToDb();
        // $film_name = a l'id_film qui est en argument de la fonction detailsfilm au dessus
        $film_name = "$id_film";
        //PREPARATION INFO FILM
        $requestFilmInfos = $pdo->prepare(
            "
            SELECT id_film, film_name, dt_release, film_length, synopsis, note, url_img, category_name
            FROM film 
            INNER JOIN casting ON film.id_film = casting.film_id
            INNER JOIN appartenir ON casting.film_id = appartenir.film_id
            INNER JOIN category ON category.id_category = appartenir.category_id
            WHERE  film.id_film = :id_film
            "
        );
        //Execution
        $requestFilmInfos->execute(["id_film" => $id_film]); //"id_film" va être ici = a 1 (film.id_film = 1 dans la requete SQL) et $id_film = a l'argument de la fonction detailsFilm
        
        //PREPARATION INFO ACTOR
        $requestCastingInfos = $pdo->prepare(
            "
            SELECT fname, lname, role_name, id_actor
            FROM person
            INNER JOIN actor ON person.id_person = actor.person_id
            INNER JOIN casting ON casting.actor_id = actor.id_actor
            INNER JOIN role ON role.id_role = casting.role_id
            WHERE casting.film_id = :id_film
            "
        );
        //Execution
        $requestCastingInfos->execute(["id_film" => $id_film]);
        
        //PREPARATION INFO director
        $requestCastingInfosRea = $pdo->prepare(
            "
            SELECT film_name, fname, lname, note, id_director
            FROM film
            INNER JOIN director ON film.director_id = director.id_director
            INNER JOIN person ON director.person_id = person.id_person
            WHERE  film.id_film = :id_film
            "
        );
        //Execution
        $requestCastingInfosRea->execute(["id_film" => $id_film]);
        
        require "view/detailsFilm.php";
    }
    
    //les acteurs du film en particulier
    public function actorFromFilm($id_film)
    {
        $pdo = Connect::connectToDb();
        // $film_name = a l'id_film qui est en argument de la fonction detailsfilm au dessus
        $film_name = "$id_film";
        //les acteurs du film en particulier
        $requestActorFromFilm = $pdo->prepare(
            "
            SELECT id_actor, fname, lname, role_name
            FROM actor
            INNER JOIN casting ON casting.actor_id = actor.id_actor
            INNER JOIN person ON actor.person_id = person.id_person
            INNER JOIN role ON actor.id_actor = role.id_role
            WHERE film_id = :id_film
            "
        );
        
        $requestActorFromFilm->execute(["id_film" => $id_film]);
        
        
        require "view/detailsFilm.php";
    }
    
    //Un director en particulier
    public function detailsDirector($id_director)
    {
        
        $pdo = Connect::connectToDb();
        
        $director_name = "$id_director";
        
        $requestDirectorInfos = $pdo->prepare(
            "
            SELECT fname, lname, sexe, DATE_FORMAT(bdate, '%d-%m-%Y') AS bdate, url_img
            FROM director
            INNER JOIN person ON director.person_id = person.id_person
            WHERE director.id_director = :id_director
            "
        );
        
        $requestDirectorInfos->execute(["id_director" => $id_director]);
        
        
        $requestDirectorFilmo = $pdo->prepare(
            "
            SELECT id_director, id_film, film_name, dt_release
            FROM director
            INNER JOIN person ON director.person_id = person.id_person
            INNER JOIN film ON director.id_director = film.director_id
            WHERE id_director = :id_director
            "
            // "
            // SELECT id_film,film_name, dt_release, film_length, note
            // FROM director 
            // INNER JOIN film  ON film.director_id = director.id_director
            // WHERE director.id_director = :id_director
            // "
        );
        
        $requestDirectorFilmo->execute(["id_director" => $id_director]);
        
        
        require "view/detailsDirector.php";
    }
    
    //Un acteur en particulier
    public function detailsActor($id_actor)
    {
        
        $pdo = Connect::connectToDb();
        
        $requestActorInfos = $pdo->prepare(
            "
            SELECT id_actor, fname, lname, sexe, DATE_FORMAT(bdate, '%d/%m/%Y') AS bdate, url_img
            FROM actor 
            INNER JOIN person ON actor.person_id = person.id_person
            WHERE id_actor = :id_actor
            "
        );
        $requestActorInfos->execute(["id_actor" => $id_actor]);
        
        
        
        $requestActorFilmo = $pdo->prepare(
            "
            SELECT id_actor, id_film, film_name, dt_release, role_name
            FROM actor 
            INNER JOIN casting ON casting.actor_id = actor.id_actor
            INNER JOIN film ON casting.film_id = film.id_film
            INNER JOIN role ON role.id_role = casting.role_id
            WHERE id_actor = :id_actor
            "
        );
        
        $requestActorFilmo->execute(["id_actor" => $id_actor]);
        
        
        require "view/detailsActor.php";
    }
    
    
    public function detailsCategory($id_category)
    {
        
        // Infos category
        $pdo = Connect::connectToDb();

        $SqlCategoryInfo = $pdo->prepare("
        SELECT category_name, id_category
        FROM category
        WHERE id_category = :id_category
        ");
        $SqlCategoryInfo->execute(["id_category" => $id_category]);
        
        
        // Liste film par category
        $pdo = Connect::connectToDb();

        $SqlCategoryFilmo = $pdo->prepare(
            "
            SELECT film_name, dt_release, film_length
            FROM category_film
            INNER JOIN film ON category_film.id_film = film.id_film
            WHERE category_film.id_category = :id_category
            "
        );
        $SqlCategoryFilmo->execute(["id_category" => $id_category]);
        
        
        require "view/detailsCategory.php";
    }
    
    
    public function detailsRole($id_role)
    {
        
        
        $pdo = Connect::connectToDb();
        $category_name = "$id_role";
        $requestRolesInfos = $pdo->prepare(
            "
            SELECT role_name, fname, lname
            FROM role
            INNER JOIN actor ON role.id_role = actor.id_actor
            INNER JOIN person ON actor.person_id = person.id_person
            "
        );
        $requestRolesInfos->execute(["id_role" => $id_role]);
        
        require "view/detailsActors.php";
    }
    
    //Category filmo                                                              //A CORRIGER
    // public function requestCategory($id_category)
    // {
        
    //     $pdo = Connect::connectToDb();
    //     $category_name = "$id_category";
    //     $requestCategoryFilmo = $pdo->prepare(
    //         "
    //         SELECT film_name, dt_release, film_length, category_id, category_name, id_film
    //         FROM film 
    //         INNER JOIN category ON film.id_category = category.category_id
    //         WHERE id_category = :id_category
    //         "
    //     );
    //     $requestCategoryFilmo->execute(["id_category" => $id_category]);
        
        
    //     require "view/detailsCategory.php";
    // }
    
}




