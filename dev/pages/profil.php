<?php	$getprofil = $_GET['profil'];
?>
<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
				Joueur: <?php echo htmlspecialchars($getprofil); ?>
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section row">

		<?php 
		if(isset($_Joueur_) AND $_GET['profil'] == $_Joueur_['pseudo'])
		{
				if(isset($_GET['erreur']))
				{
					if($_GET['erreur'] == 1)
						echo '<script>M.toast({html: "Erreur, l\'email rentré est vide"})</script>';
					elseif($_GET['erreur'] == 2)
						echo '<script>M.toast({html: "Erreur, un des champs est trop court ( < à 4caractères)"})</script>';
					elseif($_GET['erreur'] == 3)
						echo '<script>M.toast({html: "Erreur, un des champs est trop court ( < à 4caractères)"})</script>';
					elseif($_GET['erreur'] == 4)
						echo '<div class="alert alert-danger"><center>Vous n\'avez pas assez de tokens :( </center></div>';
					elseif($_GET['erreur'] == 5)
						echo '<script>M.toast({html: "Pseudo inconnu ..."})</script>';
					elseif($_GET['erreur'] == 6)
						echo '<script>M.toast({html: "Extension non autorisé "})</script>';
					elseif($_GET['erreur'] == 7)
						echo '<script>M.toast({html: "Fichier trop volumineux (Max 2Mo)"})</script>';
					elseif($_GET['erreur'] == 8)
						echo '<script>M.toast({html: "Des champs sont manquant !"})</script>';
					else
						echo '<script>M.toast({html: "Erreur indéterminé"})</script>';
				}
				elseif (isset($_GET['success'])) {
					if($_GET['success'] == 'true')
						echo '<script>M.toast({html: "Informations mise à jour !"})</script>';
					elseif($_GET['success'] == "jetons")
						echo '<script>M.toast({html: "'.htmlspecialchars($_GET['montant']).' jetons envoyé à '.htmlspecialchars($_GET['pseudo']).'"})</script>';
					elseif($_GET['success'] == "image")
						echo '<script>M.toast({html: "Profil mis à jour !"})</script>';
					elseif($_GET['success'] == "imageRemoved")
						echo '<script>M.toast({html: "Photo de profil supprimé de nos serveurs ! (Vider votre cache CTRL+F5)"})</script>';
				}
				?>

		<ul class="tabs tab-demo z-depth-1">
			<li class="tab"><a class="active <?=$couleur;?>-text" style="border-color: <?=$couleur;?>;" href="#infos">Mes informations</a></li>
			<li class="tab"><a class="<?=$couleur;?>-text" href="#jetons">Donner des jetons</a></li>
			<li class="tab"><a class="<?=$couleur;?>-text" href="#settings">Autres paramétres</a></li>
		</ul>

		<div id="infos" class="col s12">

			<div class="card">

				<div class="card-content">
					<div class="row" style="padding-top: 15px;">
						<form class="col s12" method="post" action="?&action=changeProfil" role="form">
							<div class="row">
								<div class="input-field col s12">
									<input disabled value="<?=$_Joueur_['pseudo'];?>" id="disabled" type="text"
										style="cursor: not-allowed !important;">
									<label for="disabled">Pseudo</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="password" name="mdpAncien" type="password" placeholder="Mot de passe actuel"
										class="validate">
									<label for="password">Password</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input placeholder="Nouveau mot de passe" name="mdpNouveau" id="new_mdp" type="password"
										class="validate">
									<label for="new_mdp">Nouveau mot de passe</label>
								</div>
								<div class="input-field col s6">
									<input id="new_mdp_conf" placeholder="Répeter le nouveau mot de passe" type="password"
										name="mdpConfirme" class="validate">
									<label for="new_mdp_conf">Confirmer nouveau mot de passe</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="email" type="email" name="email" value="<?=$joueurDonnees['email'];?>" class="validate">
									<label for="email">Email</label>
								</div>
							</div>
							<div class="row">
								<div class="col s12">
									<div class="input-field">
										<div class="switch">
											<label for="emailvisible">Qui peut voir votre email ?</label><br />
												<label>
													Moi
													<input type="checkbox" id="emailvisible"
														<?php if($joueurDonnees['show_email'] == 0) echo ''; else echo 'checked';?> onclick="window.location='?action=modifShowEmail&actuel=<?=$joueurDonnees['show_email'];?>'">
													<span class="lever"></span>
													Tout le monde
												</label>
										</div>
									</div>
								</div>
						</form>
					</div>
				</div>
				<div class="card-footer">
					<div class="center">
						<button type="submit" class="btn green waves-effect">Valider les changements</button>
					</div>
				</div>

				<div class="card-content" id="generalcontent">

					<div class="row">

						<div class="col s6">
							<h3 class="header-bloc header-form">Modifier sa photo de profil</h3>
							<form class="form-horizontal" method="post" action="?action=modifImgProfil" role="form"
								enctype="multipart/form-data">
								<div class="form-group">
									<label for="img-profil" class="control-label">Importer votre image (< 1Mo, jpeg, jpg, png, bmp, ico,
											gif)</label> <input type="file" name="img_profil" required class="form-control-file"
											id="img-profil">
								</div>
								<div class="form-group">
									<div class="center">
										<button type="submit" class="btn btn-success">Envoyer</button>
									</div>
								</div>
							</form>
						</div>

						<div class="col s6">
							<h3 class="header-bloc">Photo de profil actuelle</h3>
							<?php
									$Img = new ImgProfil($_Joueur_['id']);
									echo "<div class='center'><img src='".$Img->getImgToSize(128, $width, $height)."' style='width: ".$width."px; height: ".$height."px;' alt='Profil' /></div>";
									if($Img->modif)
									{
										echo '<div class="center"><a class="btn red" style="margin-top: 10px;" href="?action=removeImgProfil">Supprimer</a></div>';
									}
									?>
						</div>

					</div>


				</div>

			</div>
		</div>
	</div>
	<div id="jetons" class="col s12">
		<div class="card">

			<div class="card-content">
				<form method="post" action="?&action=give_jetons" role="form">


					<div class="row">
						<div class="col-sm-6">
							<label for="pseudo" class="col-sm-4 control-label">Pseudo du receveur</label>
							<input type="text" required class="form-control" name="pseudo"
								placeholder="Le nom de la personne a qui vous souhaiter donner des jetons" id="pseudo">
							<label for="montant" class="col-sm-4 control-label">Montant</label>
							<input type="number" required name="montant" class="form-control" placeholder="0" />
						</div>
					</div>
					<div class="center">
						<button type="submit" class="btn green waves-effect">Envoyer</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="settings" class="col s12">
		<div class="card">

			<div class="card-content">

				<form method="post" action="?&action=changeProfilAutres" role="form">

					<?php 
							foreach($listeReseaux as $value)
							{
								?>
					<div class="row">
						<div class="col s12 m12">
							<div class="input-field">
								<input id="id_<?=$value['nom'];?>" name="<?=$value['nom'];?>" type="text" class="validate"
									placeholder="Votre nom d'utilisateur <?=$value['nom'];?>"
									value="<?php if($joueurDonnees[$value['nom']] != 'inconnu') echo $joueurDonnees[$value['nom']]; ?>">
								<label for="id_<?=$value['nom'];?>"><?=ucfirst($value['nom']);?></label>
							</div>
						</div>
					</div>
					<?php 
							}
							?>
					<div class="row">
						<div class="col s6">
							<div class="input-field">
								<input type="number" name="age" id="age" class="validate" min="0" max="99" placeholder="17"
									value="<?php if($joueurDonnees['age'] != 'inconnu') echo $joueurDonnees['age']; ?>">
								<label for="age">Age</label>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col m12 s12">
							<div class="card center">

								<ul class="collapsible">
									<li>
										<div class="collapsible-header"><i class="fas fa-smile"></i> Emoticones</div>
										<div class="collapsible-body">
											<?php 
                      $smileys = getDonnees($bddConnection);
                      for ($i = 0; $i < count($smileys['symbole']); $i++) {
                      	echo '<a class="waves-effect waves-teal btn-flat" href="javascript:insertAtCaret(\'signature\',\' '.$smileys['symbole'][$i].
                      	' \')"><img src="'.$smileys['image'][$i].
                      	'" alt="'.$smileys['symbole'][$i].
                      	'" title="'.$smileys['symbole'][$i].
                      	'" /></a>';
                      }
                                            ?>
										</div>
									</li>
								</ul>

								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en gras', 'ce texte sera en gras', 'b')"
									style="text-decoration: none;" title="Texte en gras"><i class="fas fa-bold"
										aria-hidden="true"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en italique', 'ce texte sera en italique', 'i')"
									style="text-decoration: none;" title="Texte en italique"><i class="fas fa-italic"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en souligné', 'ce texte sera en souligné', 'u')"
									style="text-decoration: none;" title="Texte souligné"><i class="fas fa-underline"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en barré', 'ce texte sera barré', 's')"
									style="text-decoration: none;" title="Texte barré"><i class="fas fa-strikethrough"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en aligné à gauche', 'ce texte sera aligné à gauche', 'left')"
									style="text-decoration: none" title="Texte aligné à gauche"><i class="fas fa-align-left"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en centré', 'ce texte sera centré', 'center')"
									style="text-decoration: none" title="Texte centré"><i class="fas fa-align-center"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en aligné à droite', 'ce texte sera aligné à droite', 'right')"
									style="text-decoration: none" title="Texte aligné à droite"><i class="fas fa-align-right"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en justifié', 'ce texte sera justifié', 'justify')"
									style="text-decoration: none" title="Texte justifié"><i class="fas fa-align-justify"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text_complement('signature', 'Ecrivez ici l\'adresse de votre lien', 'https://www.exemple.com/', 'url', 'Entrez le texte de votre lien', 'Clique ici pour acceder a mon super lien')"
									style="text-decoration: none" title="lien"><i class="fas fa-link"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text_complement('signature', 'Ecrivez ici l\'adresse de votre image', 'https://craftmywebsite.fr/forum/img/site_logo.png', 'img', 'Entrez ici le titre de votre image (laisser vide si vous ne voulez pas compléter', 'Titre')"
									style="text-decoration: none" title="image"><i class="fas fa-image"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text_complement('signature', 'Ecrivez ici votre texte en couleur', 'Ce texte sera coloré', 'color', 'Entrer le nom de la couleur en anglais ou en hexaécimal avec le  # : http://www.code-couleur.com/', 'red ou #40A497')"
									style="text-decoration: none" title="couleur"><i class="fas fa-font"></i></a>
								<a class="waves-effect waves-teal btn-flat"
									href="javascript:ajout_text_complement('signature', 'Ecrivez ici votre message caché', 'signature du spoiler', 'spoiler', 'Entrer le titre du message caché (si la case est vide le titre sera \'Spoiler\'', 'Spoiler')"
									style="text-decoration: none" title="spoiler"><i class="fas fa-flag"></i></a>
								<a class='dropdown-trigger waves-effect waves-teal btn-flat' href='#' data-target='dropdownfont'><span
										class="material-icons">format_size</span></a>
								<ul id='dropdownfont' class='dropdown-content'>
									<a class="waves-effect waves-teal btn-flat"
										href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en taille 2', 'ce texte sera en taille 2', 'font=2')"><span
											style="font-size: 2em;">2</span></a>
									<a class="waves-effect waves-teal btn-flat"
										href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en taille 5', 'ce texte sera en taille 5', 'font=5')"><span
											style="font-size: 5em;">5</span></a>
								</ul>
								<br />
								<div class="row center card-content">
									<div class="col s12" style="padding-right: 5px;padding-left: 5px;">
										<label for="signature">Signature Forum</label>
										<textarea name="signature" maxlength="10000" class="materialize-textarea" id="signature" rows="20"><?php if(isset($joueurDonnees['signature'])) echo $joueurDonnees['signature']; ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="center">
							<button type="submit" class="btn btn-primary validerChange">Valider champs facultatifs</button>
						</div>
				</form>

			</div>
		</div>
		</div>
	</div>

	<?php
	}
	?>
	<div class="col s12">

		<div class="card">

			<div class="card-content">


				<div class="row">
					<div class="col s6">
						<h3>Statistiques</h3>
						<table class="table">
							<tr>
								<td>Status</td>
								<td><?php echo $serveurProfil['status']; ?></td>
							</tr>
							<tr>
								<td>Age</td>
								<td>
									<?=$joueurDonnees['age'] ." ". ($joueurDonnees['age'] != "??" && $joueurDonnees['age'] > 1 ? "ans" : "an")?>
								</td>
							</tr>
							<tr>
								<td>Pseudo</td>
								<td><?php echo htmlspecialchars($getprofil); ?></td>
							</tr>
							<tr>
								<td>Grade Site</td>
								<td><?php echo $gradeSite; ?></td>
							</tr>
							<tr>
								<td>Inscription</td>
								<td>
									<?php echo 'Le '.date('d/m/Y', $joueurDonnees['anciennete']).' &agrave; '.date('H:i:s', $joueurDonnees['anciennete']); ?>
								</td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php if($joueurDonnees['show_email'] == 0)
								echo $joueurDonnees['email'];
							else
								echo 'inconnue'; ?></td>
							</tr>
							<?php 
						foreach($listeReseaux as $value)
						{
							?><tr>
								<td><?=ucfirst($value['nom']);?></td>
								<td><?=$joueurDonnees[$value['nom']];?></td>
							</tr><?php 
						}
						?>
							<tr>
								<td># votes</td>
								<td>
									<?php require_once("modele/topVotes.class.php");
								$nbreVotes = new TopVotes($bddConnection);
								echo $nbreVotes->getNbreVotes($getprofil);?>
								</td>
							</tr>
						</table>
					</div>
					<div class="col s6">
						<h3><?php echo htmlspecialchars($getprofil); ?></h3>
						<?php 
						$Img = new ImgProfil($joueurDonnees['id']);
						?>
						<img src="<?=$Img->getImgToSize(128, $width, $height);?>"
							style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="<?=htmlspecialchars($getprofil);?>" />
						<img src="https://minotar.net/body/PinglsDzn/400.png"
							style="width: auto; height: 400px;padding-left: 30%;" alt="none" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>