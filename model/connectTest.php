<?php

//Afficher les erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'connect.php';

// Connexion à la DB
try {
    $pdo = \Model\Connect::connectToDb();
    echo "Connexion réussie à la base de données.";
} catch (\PDOException $exception) {
    echo "Erreur de connexion à la base de données : " . $exception->getMessage();
    exit();
}

// requete de test
$sql = "SELECT * FROM person";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

foreach ($rows as $row) {
    echo $row['fname'] . " " . $row['lname'] . "<br>";
}