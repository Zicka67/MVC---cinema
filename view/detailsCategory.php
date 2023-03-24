<?php
ob_start();
?>

<div class="container-cards">
	<div class="card-film">
		<div class="container-flex">
			<div class="container-img">
                
           
				<p>Category list <br><br></p>
		<?php
			if($SqlCategoryFilmo->rowCount()>0){
				foreach($SqlCategoryFilmo->fetchAll() as $categoryFilmoFilm){ ?>     
                
				<p> - <a href="index.php?action=detailsFilm&id=<?=$categoryFilmoFilm['id_film']?>"> <?= $categoryFilmoFilm["film_name"] ?> </a> <?php "sorti en : " . $categoryFilmoFilm["dt_release"] . " de"  . $categoryFilmoFilm["film_length"] . "min"?></p>
				
				<?php
            }
            }else{ ?>
	            <p>No movies added to this category currently.</p>
	            <?php
                } ?>


			<?php
			$title = "Filmo categories";
			$secondary_title = "Filmo categories";
			?>
			</div>	
		</div>
	</div>
</div>

<?php
$content = ob_get_clean();



require "view/template.php";
?>