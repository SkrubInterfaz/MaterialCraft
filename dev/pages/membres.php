<div class="header-page valign-wrapper">
    <div class="container no-pad-bot">
        <div class="row center">
            <h4 class="header col s12 white-text bold">
                Membres
            </h4>
        </div>
    </div>
</div>
<div class="container bgcontainer">
    <div class="section">
        <?php 
        $Membres = new MembresPage($bddConnection);
        if(isset($_GET['page_membre']))
        {
        	$page = htmlentities($_GET['page_membre']);
        	$membres = $Membres->getMembres($page);
        }
        else
        {
        	$page = 1;
        	$membres = $Membres->getMembres();
        }
        ?>
        <div class="row">
					<div class="input-field col s12">
						<input id="recherche" type="text" class="validate" oninput="rechercheAjaxMembre();">
						<label for="rechercche">Rechercher un membre</label>
					</div>
        </div>
        <table class="table table-hover table-striped">
        	<thead>
        		<tr>
        			<th scope="col">#</th>
        			<th scope="col">Pseudo</th>
        			<th scope="col">Grade Site</th>
        			<th scope="col">Jetons</th>
        		</tr>
        	</thead>
        	<tbody id="tableMembre">
	        	<?php
	        		foreach($membres as $value)
	        		{
	        			$Img = new ImgProfil($value['id']);
	        			?><tr>
	        				<td scope="row"><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['id'];?></a></td>
	        				<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><img src='<?=$Img->getImgToSize(32, $width, $height);?>' style='width: <?=$width;?>px; height: <?=$height;?>px;' alt='Profil' /> <?=$value["pseudo"];?></a></td>
	        				<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$Membres->gradeJoueur($value["pseudo"]);?></a></td>
	        				<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['tokens'];?></a></td>
	        			</tr>
	        			<?php
	        		}
	        	?>
        	</tbody>
        </table>
					<div class="center">
							<ul class="pagination">
						<?php if($page > 1)
						echo '<li class="waves-effect">
							<a href="?page=membres&page_membre='. ($page-1) .'" aria-label="Précédente">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Précédente</span>
							</a>
						</li>';
						for($i = 1; $i <= $Membres->nbPages; $i++)
						{
							?><li class="waves-effect"><a href="?page=membres&page_membre=<?=$i;?>"><?=$i;?></a></li><?php
						}
					if($page < $Membres->nbPages)
						echo '<li class="waves-effect">
							<a href="?page=membres&page_membre='. ($page+1) .'" aria-label="Suivante">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Suivante</span>
							</a>
						</li>';
						?>
					</ul>
					</div>
	</div>
</div>
<script>
	function rechercheAjaxMembre()
	{
		$("#tableMembre").html("<div class='center'><img src='https://media2.giphy.com/media/3oEjI6SIIHBdRxXI40/200.gif' height='72' widht='72' alt='ça vient ça vient'/> <br/><span>Recherche en cours ..</span> </div>");
		$.ajax({
			url: 'index.php?action=rechercheMembre',
			type: 'POST',
			data: 'ajax=true&recherche='+$('#recherche').val(),
			success: function(code, statut){
				$("#tableMembre").html(code);
			}
		});
	}
</script>