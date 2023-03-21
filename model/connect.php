<?php

//le namespace de la classe, qui est ici "Model". Les namespaces sont utilisés pour éviter les conflits de noms entre différentes classes.
namespace Model;

// La classe est définie comme étant abstract, ce qui signifie qu'elle ne peut pas être instanciée directement, mais seulement héritée par d'autres classes.
abstract class Connect
{

    //Les constantes HOST, DB, USER et PASS sont des propriétés statiques de la classe Connect. 
    //Elles permettent de stocker les informations de connexion à la DB et sont accessibles à l'intérieur de la classe grâce au mot-clé self suivi de ::
    const HOST = "localhost";
    const DB = "gkcinema";
    const USER = "root";
    const PASS = "";

    // Si la connexion est établie avec succès, un objet PDO (PHP Data Object) est renvoyé. Si une exception de type PDOException est levée, le message d'erreur est retourné.
    public static function connectToDb()
    {
        try {
            return new \PDO(
                //self::HOST correspond à la valeur de la constante HOST de la classe Connect. Pareil pour dbname etc..
                "mysql:host=" . self::HOST . 
                ";dbname=" . self::DB . 
                ";charset=utf8",self::USER,self::PASS
            );
        } catch (\PDOException $e) 
        {
            // return ?
            die('Erreur : ' . $e->getMessage());
        }
    }
}
