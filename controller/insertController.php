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
        
        // Ajout en DB
        if (isset($_POST["submit"])) {
            
            // Sécurité
            $film_name = filter_input(INPUT_POST, "film_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $dt_release = filter_input(INPUT_POST, "dt_release", FILTER_SANITIZE_NUMBER_INT);
            $film_length = filter_input(INPUT_POST, "film_length", FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_SPECIAL_CHARS);
            $url_img = filter_input(INPUT_POST, "url_img", FILTER_SANITIZE_SPECIAL_CHARS);
            if (empty($url_img)) {
                $url_img = "";
            }
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
            $director_id = filter_input(INPUT_POST, "director_id", FILTER_SANITIZE_NUMBER_INT);
            
            
            // SI chaque var n'est pas vide
            if (!empty($film_name) && !empty($dt_release) && !empty($film_length) && !empty($synopsis) && !empty($url_img) && !empty($note) && !empty($director_id)) {
                
                $pdo = Connect::connectToDb();
                
                
                $sqlRequest1 = $pdo->prepare(
                    "
                    INSERT INTO film (film_name, dt_release, film_length, synopsis, url_img, note, director_id)
                    VALUES (:film_name, :dt_release, :film_length, :synopsis, :url_img, :note, :director_id)	
                    "
                );
                
                $sqlRequest1->execute([
                    "film_name" => $film_name, "dt_release" => $dt_release, "film_length" => $film_length, "synopsis" => $synopsis, "url_img" => $url_img, "note" => $note, "director_id" => $director_id
                ]);
                
                header('Location: index.php?action=listFilms');
                die();
            }
        }
        require "view/admin_insert/insertFilm.php";
    }
    
    //Ajout director
    public function insertDirector()
    {
        
        if (isset($_POST["submit"])) {
            
            /* FILTRER pour eviter failles XSS 
            puis associer a une variable */
            $birthdate= filter_input(INPUT_POST, "bdate", FILTER_SANITIZE_SPECIAL_CHARS);
            $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);
            
            //VERIFIE si DEFINI
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
                
                header('location:index.php?action=listDirectors');
                die();
            }
        }
        
        require "view/admin_insert/insertDirector.php";
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
        
        require "view/admin_insert/insertCategory.php";
    }
    
    //Ajout actor
    public function insertPerson()
    {
        
        if (isset($_POST["submit"])) {
            //Sécurité
            $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lname =  filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
            $bdate = filter_input(INPUT_POST, "bdate", FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe =  filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);
            $url_img =  filter_input(INPUT_POST, "url_img", FILTER_SANITIZE_SPECIAL_CHARS);
            
            if ($fname && $lname && $bdate && $sexe && $url_img) {
                
                $pdo = Connect::connectToDb();
                
                $sqlRequest1 = $pdo->prepare(
                    "
                    INSERT INTO person (fname, lname, bdate, sexe, url_img)
                    VALUES (:fname, :lname, :bdate, :sexe, :url_img)
                    "
                );
                
                $sqlRequest1->execute(["fname" => $fname, "lname" => $lname, "bdate" => $bdate, "sexe" => $sexe, "url_img" => $url_img]);
                
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
                
                
                $sqlRequest1 = $pdo->prepare("
                INSERT INTO role (role_name)
                VALUES (:role_name)
                ");
                
                $sqlRequest1->execute(["role_name" => $role_name]);
                
                header('Location: index.php?action=listRoles');
                die();
            }
        }
        
        
        require "view/admin_insert/insertRole.php";
    }
    
    
    //insert Casting to DB
    public function insertCasting()
    {
        $pdo = Connect::connectToDb();
        
        //request for from select
        $sqlRequestfilm = $pdo->query(
            "
            SELECT film_name, id_film
            FROM film
            "
        );
        
        //request actor for form select
        $sqlRequestActor = $pdo->query(
            "
            SELECT CONCAT(fname, ' ', lname) AS actorName, id_actor
            FROM actor
            "
        );
        
        //request tole for form select
        $sqlRequestRole = $pdo->query(
            "
            SELECT role_name, id_role
            FROM role
            "
        );
        
        
        
        if (isset($_POST['submit'])) {
            
            // Securité
            $actor_id= filter_input(INPUT_POST, "actor_id", FILTER_SANITIZE_SPECIAL_CHARS);
            $film_id = filter_input(INPUT_POST, "film_id", FILTER_SANITIZE_SPECIAL_CHARS);
            $role_id = filter_input(INPUT_POST, "role_id", FILTER_SANITIZE_SPECIAL_CHARS);
            
            
            
            if (!empty($actor_id) && !empty($role_id) && !empty($film_id)) {
                $pdo = Connect::connectToDb();
                
                $sqlRequest1 = $pdo->prepare(
                    "
                    INSERT INTO casting (film_id, actor_id, role_id)
                    VALUES ('10', '1', '6')
                    "
                );
                
                $sqlRequest1->execute(["film_id" => $film_id, "actor_id" => $actor_id,"role_id" => $role_id]);
                
                
                header('Location: index.php?action=listCastings');
                die();
            };
        }
        
        require "view/admin_insert/insertCasting.php";
    }
}