<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
				Confirmer votre action
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section">
<?php 
if(isset($_GET['choix']))
{
	if(isset($_GET['id_topic']))
	{
		$id = htmlspecialchars($_GET['id_topic']);
	}
	$choix = htmlspecialchars($_GET['choix']);
	if(isset($id))
	{
		//vérification + initialisation variable
		if(is_numeric($id) AND is_numeric($choix))
		{
			switch($choix)
			{
				//On switch 
				case '2':
					//si le $_GET['choix'] == 2 alors c'est une suppression de topic 
					//On demande donc une raison et une confirmation
					if($_PGrades_['PermsForum']['moderation']['deleteTopic'] == true OR $_Joueur_['rang'] == 1)
 					{
					?>
                     <div class="row" id="alert_box">
                        <div class="col s12 m12">
                            <div class="card red darken-1">
                            <div class="row">
                                    <div class="col s12">
                                    <div class="card-content white-text">
                                        <p>
                                            ATTENTION ! Si vous supprimez cette discussion elle ne sera plus accessible :( ! Plus jamais !!!
                                        </p>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
					<form action="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=2&confirmation=true" method="post">
						<div class="form-group row">
							<label for="reason" class="col s2 form-control-label">Raison de la suppression</label>
							<div class="col s10">
								<input type="text" class="form-control" id="reason" name="reason" placeholder="Votre raison" required />
							</div>
						</div>
						<div class="form-group row">
							<div class="col s10">
								<button type="submit" class="btn btn-primary">Supprimer ce topic :(</button>
							</div>
							<div class="col s2">
					<a href="index.php" class="btn btn-warning">Annuler</a>
				</div>
						</div>
					</form><?php
					}
					else
						header('Location: ?page=erreur&erreur=7');
				break;
				
				case '3':
					//Là c'est un déplacement du topic 
					//On affiche donc un <select> pour que l'admin choisisse la bonne catégorie
					if($_PGrades_['PermsForum']['moderation']['mooveTopic'] == true OR $_Joueur_['rang'] == 1)
 					{
					?>
					<form action="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=3&confirmation=true" method="post">
						<div class="form-group row">
							<label for="emplacement" class="col s2 form-control-label">Déplacez la discussion vers : </label>
							<div class="col-sm-10">
								<select class="c-select" name="emplacement" id="emplacement" required >
									<?php 
									$emplacement = $bddConnection->query('SELECT * FROM cmw_forum_categorie');
									while($emplacementd = $emplacement->fetch(PDO::FETCH_ASSOC))
									{
										if(isset($emplacementd['sous-forum']))
										{
											?><optgroup label="<?php echo $emplacementd['nom']; ?>">
											<option value="<?php echo $emplacementd['id']; ?>">Déplacer dans la catégorie</option>
											<?php
											$sous_forum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id');
											$sous_forum->execute(array(
												'id' => $emplacementd['id']
											));
											while($sous_forumd = $sous_forum->fetch(PDO::FETCH_ASSOC))
											{
												?><option value="<?php echo $emplacementd['id']; ?>_<?php echo $sous_forumd['id']; ?>"><?php echo $sous_forumd['nom']; ?></option><?php
											}
											?></optgroup><?php
										}
										else 
										{
											?><option value="<?php echo $emplacementd['id']; ?>_0"><?php echo $emplacementd['nom']; ?></option>
										<?php 
										}
									}
								?></select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col s10">
								<button type="submit" class="btn green waves-effect">Déplacer la discussion </button>
							</div>
							<div class="col s2">
					<a href="index.php" class="btn waves-effect">Annuler</a>
				</div>
						</div>
					</form>
					<?php
					}
					else
						header('Location: ?page=erreur&erreur=7');
				break;
			}
		}
	}
	if($choix == 4)
		{
			//la j'ai décidé de stopper le switch chai pas pk x))) 
			//La c'est un signalement de réponse qui nécessite donc une raison
			?>
			<form action="?&action=signalement&confirmation=true" method="post">
				<div class="row">
					<label for="reason" class="col s2">Indiquez une raison</label>
					<input type="text" class="col s10" name="reason" id="reason" placeholder="Indiquez une raison" required />
				</div>
				<input type="hidden" name="id_answer" value="<?php echo $_GET['id']; ?>" />
				<div class="row">
					<div class="col s10">
						<button class="btn waves-effect waves-light waves-green green" type="submit">Signaler ! </button>
					</div>
					<div class="col s2">
					<a href="index.php" class="btn waves-effect">Annuler</a>
				</div>
				</div>
			</form>
			<?php 
		}
	if($choix == 5)
	{
		//Pareil mais signalement de topic
		?>
		<form action="?&action=signalement_topic&confirmation=true" method="post">
			<div class="row">
				<label for="reason" class="col s2 input-field">Indiquez une raison ! </label>
				<div class="col s10">
					<input type="text" class="input-field" name="reason" id="reason" placeholder="Indiquez une raison" required />
					<input type="text" class="disabled" name="id_topic2" value='<?php echo $id; ?>' disabled />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-10">
					<button type="submit" class="btn waves-effect waves-light waves-green green">Signaler ce topic !</button>
				</div>
				<div class="col-sm-2">
					<a href="index.php" class="btn waves-effect">Annuler</a>
				</div>
			</div>
		</form>
		<?php
    }
    echo '    </div>
</div>
';
} 
else
{
	header('Location: ?page=erreur&erreur=7');
}
?>