<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="view\styleHomePage.css">



    <title>HomePage</title>
</head>

<body>


    <div class="container">

        <div class="header-container">

            <nav>
                <h2 class="logo"><a href="index.php?action=listFilms">GK Cine</a></h2>
                <ul class="menu">
                    <li><a href="index.php?action=insertFilms">Add films</a></li>
                    <li><a href="index.php?action=insertActors">Add actors</a></li>
                    <li><a href="index.php?action=insertDirectors">Add directors</a></li>
                    <li><a href="index.php?action=insertCategorys">Add categorys</a></li>
                    <li><a href="index.php?action=insertRoles">Add roles</a></li>
                </ul>
                <div class="menu-log">
                    <a class="bouton" href="">Sign in</a>
                    <a class="bouton2" href="">Sign up</a>
                    <a class="subscribe" href="index.php">HomePage</a>
                </div>

            </nav>
        </div>

        <div class="">
            <?php if (isset($secondary_title)) { ?>
                <h2><?= $secondary_title ?></h2>
            <?php } ?>
            <?php if (isset($content)) { ?>
                <div><?= $content ?></div>
            <?php } ?>
        </div>


        <nav class="menu-bot">
            <a class="bouton2" href="">Watch Now</a>
            <a class="bouton1" href="">View Info</a>
            <a href="">+ Favorites</a>
        </nav>

        <!-- ****************************************** MAIN ****************************************** -->
<!-- 
        <div class="main-menu">
            <ul>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Top Rated</a></li>
                <li><a href="#">Trailers</a></li>
                <li class="dropdown">
                    <a class="hover-dropdown" href="#">Category</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">SF</a></li>
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Horror</a></li>
                        <li><a href="#">Comedie</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="container-main-img">
            <div class="main-img1">
                <a href="" class="img-main">
                    <img src="" alt="">
                </a>
                <a href="" class="img-main">
                    <img src="" alt="">
                </a>
                <a href="" class="img-main">
                    <img src="" alt="">
                </a>
            </div>
            <div class="main-img2">
                <a href="" class="img-main">
                    <img src="" alt="">
                </a>
                <a href="" class="img-main">
                    <img src="" alt="">
                </a>
                <a href="" class="img-main">
                    <img src="" alt="">
                </a>
            </div>
        </div> -->

        <footer>
            <nav class="footer-links">
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
            </nav>

            <div class="footer-copy">
                <p>NomDuSite © Tous droits réservés</p>
            </div>
        </footer>

    </div>
</body>

</html>