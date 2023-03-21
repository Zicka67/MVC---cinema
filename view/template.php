<!DOCTYPE html>

<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">


<link rel="stylesheet" href="style.css">


<title>ListFilms</title>

</head>

<body>

<div class="container">

    <div class="header-container">

        <nav>
            <h2 class="logo"><a href="index.php">GK Cine</a></h2>
            <ul class="menu">
                <li><a href="index.php?action=listFilms">Films</a></li>
                <li><a href="index.php?action=listActors">Actors</a></li>
                <li><a href="index.php?action=listDirectors">Director</a></li>
                <li><a href="index.php?action=listCategorys">Categorys</a></li>
                <li><a href="index.php?action=listRoles">Roles</a></li>
            </ul>
            <div class="menu-log">
                <a class="bouton1" href="">Sign in</a>
                <a class="bouton2" href="">Sign up</a>
                <a class="subscribe" href="index.php?action=admin">Admin</a>
            </div>
            
        </nav>

        
        <div class="container-content">
            <?php if (isset($secondary_title)) { ?>
                <h2 class="secondaryTitle"><?= $secondary_title ?></h2>
            <?php } ?>
            <?php if (isset($content)) { ?>
                <div class="container-all"><?= $content ?></div>
            <?php } ?>
        </div>

    <footer>

        <div class="footer-copy">
            <p>NomDuSite © Tous droits réservés</p>
        </div>

    </footer>

</div>

</body>

</html>