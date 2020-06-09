<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
				Chat Minecraft
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section row">
			<?php
			if(count($jsonCon) >= 1)
			{
				$Chat = new Chat($jsonCon);
				?>
                <ul class="tabs z-depth-1">
					<?php
					for($i = 0; $i < count($jsonCon); $i++)
					{
					?>
                	  <li class="tab  <?php if($i == 0) echo 'active'; ?>" id="ajaxtab-<?=$i;?>"><a href="#categorie-<?php echo $i; ?>"><?php echo $lecture['Json'][$i]['nom']; ?></a></li>
					<?php
					}
					?>
				</ul>
					<?php
					for($i=0; $i < count($jsonCon); $i++)
					{
						$messages = $Chat->getMessages($i);
					?>
                    	<div id="categorie-<?php echo $i; ?>">
							<div class="well" style="background-color: #CCCCCC;">
								<?php
								if($messages != false)
								{
									foreach($messages as $value)
									{
										//var_dump($value);
										$Img = new ImgProfil($value['player'], 'pseudo');

										?>
											<p class="username"><img class="rounded" src="<?=$Img->getImgToSize(32, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="avatar de l'auteur" title="<?php echo $value['player']; ?>" /> <?=($value['player'] == '') ? 'Console': $value['player'].', '.$_Forum_->gradeJoueur($value['player']);?> à <span class="font-weight-light"><?=date('H:i:s', $value['time']);?></span> -> <?=$Chat->formattage(htmlspecialchars($value['message']));?></p>
										<?php
									}
								}
								?>
							</div>
						</div>
					<?php
					}
					?>
					</div>
				<?php
				if(isset($_Joueur_))
				{
					?>
					<form action="?action=sendChat" method="POST">
						<div class="row">
							<div class="col m8 s8 l8">
								<input type="text" name="message" placeholder="T'apper votre message (Max 100 caractéres)" max="100" class="form-control">
							</div>
							<div class="col m2 s2 l2">
								<select name="i" class="form-control">
									<?php
									for($i=0; $i < count($jsonCon); $i++)
									{
										?><option value="<?=$i;?>"><?=$lecture['Json'][$i]['nom'];?></option><?php
									}
									?>
								</select>
							</div>
							<div class="col m2 s2 l2">
								<button class="btn waves-effect waves-light" type="submit">Envoyer</button>
							</div>
						</div>
					</form>
					<?php
				}else{
                    echo '
                    <div class="row">
                    <div class="col s12 m12">
                    <div class="card red darken-3">
                        <div class="card-content white-text">
                        <span class="card-title">Erreur</span>
                        <p>Vous devez vous connecter pour avoir accées à cette page !</p>
                        </div>
                    </div>
                    </div>
                </div>
                    ';
                }
				?>
				<!-- </div> -->
			<?php
            }
            else
            echo '
            <div class="row">
            <div class="col s12 m12">
            <div class="card red darken-3">
                <div class="card-content white-text">
                <span class="card-title">Erreur</span>
                <p>Aucun serveur n\'a été relié au site web ! Veulliez contacter l\'administrateur du site web</p>
                </div>
            </div>
            </div>
        </div>
            ';
			?>

    </div>
</div>
<script>
	setInterval(AJAXActuChat, 10000);
	function AJAXActuChat()
	{
		<?php for($i = 0; $i < count($jsonCon); $i++)
		{
			?>if($('#ajaxtab-<?=$i;?>').hasClass("active"))
			{
				var active = <?=$i;?>;
			}
			<?php
		}
		?>
		$.ajax({
			url: 'index.php?action=chatActu',
			type: 'POST',
			data: 'ajax=true&active='+active,
			success: function(code, statut){
				$("#messages").html(code);
			}
		});
	}
</script>