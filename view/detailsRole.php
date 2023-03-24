<?php
ob_start();
?>

<div class="container-cards">
	<div class="card-film">
		<div class="container-flex">
			<div class="container-img">
                
           
				<p>Roles list <br><br></p>
		<?php
			if($requestRolesInfos->rowCount()>0){
				foreach($requestRolesInfos->fetchAll() as $roleInfos){ ?>   
                                     
                <div class="container-infos">
				<p><a href="index.php?action=detailsActor&id=<?=$roleInfos['id_actor']?>"> <?= $roleInfos["lname"] ?> <?= $roleInfos["fname"] ?></a></p>
				</div>
				<?php
            }
            }else{ ?>
	            <p>No actor added to this role currently.</p>
	            <?php
                } ?>


			<?php
			$title = "Roles filmo";
			$secondary_title = "Roles filmo";
			?>
			</div>	
		</div>
	</div>
</div>

<?php
$content = ob_get_clean();



require "view/template.php";
?>