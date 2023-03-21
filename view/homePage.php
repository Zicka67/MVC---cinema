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
                    <li><a href="index.php?action=listFilms">Films</a></li>
                    <li><a href="index.php?action=listActors">Actors</a></li>
                    <li><a href="index.php?action=listDirectors">Directors</a></li>
                    <li><a href="index.php?action=listCategorys">Categorys</a></li>
                    <li><a href="index.php?action=listRoles">Roles</a></li>
                </ul>
                <div class="menu-log">
                    <a class="bouton" href="">Sign in</a>
                    <a class="bouton2" href="">Sign up</a>
                    <a class="subscribe" href="index.php?action=admin">Admin</a>
                </div>

            </nav>
        </div>


        <?php
        $films = $request->fetch();
        ob_start();
        ?>
        

        <div class="card-film">
            <div class="container-flex">
                <div class="container_infos">
                    <p><?= $films["film_name"] ?></p>
                    <p><?= ucfirst($films["category_name"]) ?></p>
                    <p><?= $films["dt_release"] ?></p>
                    <p><?= ucfirst($films["film_length"]) ?> min</p>
                    <div>
                        <p><?php $times = $films["note"] ?></p>
                        <?php echo str_repeat("<i class='fa-solid fa-star'></i>", $times);
                        echo str_repeat("<i class='fa-regular fa-star'></i>", 5 - $times); ?>
                    </div>
                </div>
            </div>


        <?php
        $title = "Film en avant";
        $secondary_title = "Film en avant";
        $content = ob_get_clean();
        ?>

        <div class="">
            <?php if (isset($secondary_title)) { ?>
                <h2><?= $secondary_title ?></h2>
            <?php } ?>
            <?php if (isset($content)) { ?>
                <div><?= $content ?></div>
            <?php } ?>
        </div>


        <nav id="stay" class="menu-bot">
            <a class="bouton2" href="">Watch Now</a>
            <a class="bouton1" href="">View Info</a>
            <a href="">+ Favorites</a>
        </nav>

        <!-- ****************************************** MAIN ****************************************** -->

        <div class="main-menu">
            <ul>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Top Rated</a></li>
                <li><a href="#">Trailers</a></li>
                <li class="dropdown">
                    <a id="stay" class="hover-dropdown" href="#">Category</a>
                    <ul class="dropdown-menu">
                        <li><a href="#stay" onclick="filterGridItems('all')">all</a></li>
                        <li><a href="#stay" onclick="filterGridItems('sf')">sf    </a></li>
                        <li><a href="#stay" onclick="filterGridItems('action')">action</a></li>
                        <li><a href="#stay" onclick="filterGridItems('horror')">horror</a></li>
                        <li><a href="#stay" onclick="filterGridItems('comedie')">comedie</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <div class="blogContainer">
          

          <div class="grid-item" data-category="sf">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=1">
                <img src="img\affiche-1120453.jpg" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="action">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=2">
                <img src="img\2484953.webp" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="horror">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=3">
                <img src="img\aevmntjcng4zlfeeegz79frmues-424.jpg" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="comedie">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=4">
                <img src="img\affiche.jpg" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="sf">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=5">
                <img src="img\affclones.jpg" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="action">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=6">
                <img src="img\MV5BOGZmYzVkMmItM2NiOS00MDI3LWI4ZWQtMTg0YWZkODRkMmViXkEyXkFqcGdeQXVyODY0NzcxNw._V1_.jpg" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="comedie">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=7">
                <img src="img\037786_af.jpg" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="sf">
            <a href="http://localhost/MVC-Cinema/index.php?action=detailsFilm&id=8">
                <img src="img\18423997.jpg" alt="">
            </a>
          </div>
          <div class="grid-item" data-category="" style="visibility:hidden">
            <a href="">
                <img src="" alt="">
            </a>
          </div>
        </div>

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

<script src="script.js"></script>



</body>

</html>




<!-- <div class="container-main-img">
            <div class="main-img1">
                <div class="testJs">
                    <a href="" class="img-main" data-category="Sf">
                        <img src="" alt="">
                        <p>SF</p>
                    </a>
                </div>
           
                <div class="testJs" data-category="Action">
                <a href="" class="img-main" data-category="Action">
                        <img src="" alt="">
                        <p>SF</p>
                    </a>

                </div>
         
                <div class="testJs" data-category="Horror">
                <a href="" class="img-main" data-category="Horror">
                        <img src="" alt="">
                        <p>SF</p>
                    </a>
                </div>
            </div>

           
            <div class="main-img2">
                <div class="testJs" data-category="Comedie">
                <a href="" class="img-main" data-category="Comedie">
                        <img src="" alt="">
                        <p>SF</p>
                    </a>
                </div>
         

                <div class="testJs" data-category="Sf">
                <a href="" class="img-main" data-category="Sf">
                        <img src="" alt="">
                        <p>SF</p>
                    </a>
                </div>
         
                <div class="testJs" data-category="Action">
                <a href="" class="img-main" data-category="Action">
                        <img src="" alt="">
                        <p>SF</p>
                    </a>
                </div>
            </div>
        
        </div> -->