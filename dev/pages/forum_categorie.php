<?php if(!isset($_GET['id'])) header('Location: ?page=erreur&erreur=16');

	//Vérification de l'existence du forum :
	$id = $_GET['id'];
	if(!$_Forum_->exist($id)) header('Location: index.php?page=erreur&erreur=17');
	
	if(isset($_GET['id_sous_forum']))
		$id_sous_forum = $_GET['id_sous_forum'];
	$categoried = $_Forum_->infosCategorie($id);
	if(isset($id_sous_forum))
		$sousforumd = $_Forum_->SousForum($id_sous_forum);
	else
		$sousforumd = $_Forum_->infosSousForum($id, 0);
		
	if(!(($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $_PGrades_['PermsDefault']['forum']['perms'] >= $categoried['perms'] OR $categoried['perms'] == 0)) header('Location: ?page=erreur&erreur=7');?>
	<div class="header-page valign-wrapper">
		<div class="container no-pad-bot">
			<div class="row center">
				<h4 class="header col s12 white-text bold">
					Forum
				</h4>
			</div>
		</div>
	</div>

	<div class="container bgcontainer">
		<div class="section">
			<?php if($_SESSION['mode'])
			{
				?>
			<div class="alert alert-warning" role="alert">
				<p style="margin-bottom: 0;" class="text-center">Vous êtes en Mode Joueur. Pour changer de mode, passer sur la page forum.</p>
			</div><?php 
			}
			?>
			<nav>
				<div class="nav-wrapper <?=$couleur?>">
					<div class="row">
						<div class="col s12">
							<a href="index.php" class="breadcrumb white-text">Accueil</a>
							<a href="index.php?page=forum" class="breadcrumb white-text">Forum</a>
							<a href="<?php if(isset($id_sous_forum)){ echo '?page=forum_categorie&id='.$id.''; }else{echo '#';}?>" class="breadcrumb white-text"><?=$categoried['nom'];?></a>
						</div>
					</div>
				</div>
			</nav>
        <?php
		if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addSousForum'] == true) AND !$_SESSION['mode'] && !isset($id_sous_forum))
		{
			?>
			 <ul class="collapsible">
			 	<li>
			 		<div class="collapsible-header">Créez un sous-forum</div>
			 		<div class="collapsible-body">
			 			<form action="?action=create_sf" method="post">
			 				<div class="row">
			 					<div class="col-md-6">
			 						<input type="hidden" name="id_categorie" value="<?php echo $id; ?>" />
			 						<label class="control-label" for="nomSF">Nom</label>
			 						<input type="text" required class="form-control" name="nom" id="nomSF" maxlength="40" />
			 					</div>
			 					<div class="col-md-6">
			 						<label class="control-label" for="img">Material icône : <a
			 								href="https://design.google.com/icons"
			 								target="_blank">https://design.google.com/icons</a></label>
			 						<input type="text" maxlength="300" name="img" id="img" class="form-control" />
			 					</div>
			 				</div>
			 				<div class="row">
			 					<div class="col-md-offset-4 col-md-6">
			 						<button type="submit" class="btn btn-success">Créer un sous-forum</button>
			 					</div>
			 				</div>
			 			</form>
			 		</div>
			 	</li>
			 </ul>


			<?php 
		}
		if(!empty($sousforumd['id']) && !isset($id_sous_forum))
		{
		?>	
		<h3>Sous-Catégories de <?php echo $categoried['nom']; ?></h3>
		<table class="table table-striped">
			<tr>
				<th style="width: 5%"></th>
				<th style="width: 65%">Nom</th>
				<th>Discussions</th>
				<th>Messages</th>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteSousForum'] == true) AND !$_SESSION['mode'])
				{
					?><th style="width: 5%">Actions</th><?php 
				} ?>
			</tr>
			<?php
			$sousforumd = $_Forum_->infosSousForum($id, 1);
			for($a = 0; $a < count($sousforumd); $a++)
			{
				if(($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $_PGrades_['PermsDefault']['forum']['perms'] >= $sousforumd[$a]['perms'] OR $sousforumd[$a]['perms'] == 0)
				{
				?>
			<tr>
				<td><?php if($sousforumd[$a]['img'] == NULL) { ?><a href="?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="?page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><i class="material-icons"><?php echo $sousforumd[$a]['img']; ?></i></a><?php }?></td>
				<td><a href="?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><?php echo $sousforumd[$a]['nom']; ?></a></td>	
				<td><a href="?page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><?php echo $_Forum_->compteTopicsSF($sousforumd[$a]['id']); ?></a></td>
				<td><a href="?page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><?php echo $_Forum_->compteAnswerSF($sousforumd[$a]['id']); ?></a></td>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteSousForum'] == true) AND !$_SESSION['mode'])
				{
					?><td>
					<div id="NomForum<?=$sousforumd[$a]['id'];?>" class="modal">
                            <div class="modal-content">
                            <form action="?action=changeNomForum" method="post">
                                <h4>Modification du nom:</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="hidden" name="id" id="id" value="<?=$sousforumd[$a]['id'];?>">
                                        <input type="hidden" name="entite" id="entite" value="2">
                                        <input value="<?=$sousforumd[$a]['nom'];?>" id="nom" name="nom" type="text" class="validate">
                                        <label class="active" for="nom">Nom du forum</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Annuler</a>
                                <button type="submit" class="modal-close waves-effect waves-green btn-flat">Modifier</a>
                            </div>
                            </form>
                        </div>
                    <button class='dropdown-trigger-forum btn' data-target='toolsscat<?=$sousforumd[$a]['id'];?>'><i class="fas fa-cogs"></i></button>
					<ul id='toolsscat<?=$sousforumd[$a]['id'];?>' class='dropdown-content white' style="background-color: #fff!important">
						<div class="card">
							<div class="card-content">
								<li class="dropdown-item">
									<form action="?action=modifPermsSousForum" method="POST">
										<input type="hidden" name="id" value="<?=$sousforumd[$a]['id'];?>" />
										<label for="permissionscat<<?=$sousforumd[$a]['id'];?>">
										<span>Permissions:</span>
										<input type="number" id="permissionscat<?=$sousforumd[$a]['id'];?>" name="perms" value="<?=$sousforumd[$a]['perms'];?>"
												class="form-control">
										</label>
										
										<div class="center">
											<button type="submit" class="dropdown-item btn waves-effect btn-small">Modifier</button>
										</div>
									</form>
								</li>
								<li>
									<a class="dropdown-item modal-trigger" href="#NomForum<?=$sousforumd[$a]['id'];?>"><i class="fas fa-font"></i> Modifier le nom</a>
								</li>
								<li>
									<a class="dropdown-item"
										href="?action=ordreSousForum&ordre=<?=$sousforumd[$a]['ordre']; ?>&id=<?=$sousforumd[$a]['id']; ?>&id_cat=<?=$sousforumd[$a]['id_categorie'];?>&modif=monter"><i
											class="fas fa-arrow-up"></i> Monter d'un cran</a>
								</li>
								<li>
									<a class="dropdown-item"
										href="?action=ordreSousForum&ordre=<?=$sousforumd[$a]['ordre']; ?>&id=<?=$sousforumd[$a]['id']; ?>&id_cat=<?=$sousforumd[$a]['id_categorie'];?>&modif=descendre"><i
											class="fas fa-arrow-down"></i> Descendre d'un cran</a>
								</li>
								<li>
									<a class="dropdown-item" href="?action=remove_sf&id_cat=<?php echo $id; ?>&id_sf=<?php echo $sousforumd[$a]['id']; ?>"><i
											class="fas fa-trash-alt"></i> Supprimer</a>
								</li>
								<li>
									<a class="dropdown-item" href=<?php if($sousforumd[$a]['close'] == 0) { ?>"?action=lock_sf&id_f=<?=$sousforumd[$a]['id_categorie'];?>&id=<?=$sousforumd[$a]['id'];?>&lock=1" title="Fermer le sous-forum"><i class="fas fa-unlock-alt"<?php } else { ?>"?action=unlock_sf&id_f=<?=$sousforumd[$a]['id_categorie'];?>&id=<?=$sousforumd[$a]['id'];?>&lock=0" title="Ouvrir le sous-forum"><i class="fas fa-lock"<?php } ?> aria-hidden="true"></i></a>
								</li>
							</div>
						</div>
					</ul>

						</td><?php 
				} ?>
			</tr>
			<?php 
				}
			} 
			?>
		</table>
		<?php 
		} 
		?>
		<br/>
		<h3> Les topics de <?php echo $categoried['nom']; if(isset($id_sous_forum)) echo ' - '.$sousforumd['nom']; ?></h3>
		<?php 
		if(isset($id_sous_forum))
			$count_topic_max2 = $_Forum_->compteTopicsSF($id_sous_forum);
		else
			$count_topic_max2 = $_Forum_->compteTopics($id);
		$count_topic_nbrOfPages2 = ceil($count_topic_max2 / 20);
		
		if(isset($_GET['page_topic']))
		{
			$page = $_GET['page_topic'];
		}
		else
		{
			$page = 1;
		}
		
		$count_topic_FirstDisplay2 = ($page - 1) * 20;
		if(isset($id_sous_forum))
			$topicd = $_Forum_->infosSousForumTopics($id_sous_forum, $count_topic_FirstDisplay2);
		else
			$topicd = $_Forum_->infosTopics($id, $count_topic_FirstDisplay2);
		if($count_topic_max2 > 0)
		{
			?>
			<table class="table table-striped table-hover">
				<tr>
					<th style="width: 15%">Par</th>
					<th style="width: 40%">Nom du topic</th>
					<th style="width: 35%">Dernière réponse</th>
					<th style="width: 20%">Réponses</th>
				</tr>
				<?php 
				for($i = 0; $i < count($topicd); $i++)
				{
					if(($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $_PGrades_['PermsDefault']['forum']['perms'] >= $topicd[$i]['perms'] OR $topicd[$i]['perms'] == 0)
					{
					?>
					<tr>
						<td>
						<?=$topicd[$i]['pseudo'];?></a>, <br/>
							le <?=$_Forum_->getDateConvert($topicd[$i]['date_creation']);?>
						</td>
						<td><a href="?&page=post&id=<?php echo $topicd[$i]['id']; ?>"><?php if(isset($topicd[$i]['prefix']) && $topicd[$i]['prefix'] != 0)
						{
							echo $_Forum_->getPrefix($topicd[$i]['prefix']);
						}
							echo ' '.$topicd[$i]['nom']; ?></a></td>
						<td><a href="?&page=post&id=<?php echo $topicd[$i]['id']; ?>"><?php echo $_Forum_->conversionLastAnswer($topicd[$i]['last_answer']); ?></a></td>
						<td><p>Réponses : <?php echo $_Forum_->compteReponse($topicd[$i]['id']); ?>
						<?php if(isset($_Joueur_) && ($_PGrades_['PermsForum']['moderation']['selTopic'] == true OR $_Joueur_['rang'] == 1) && !$_SESSION['mode'])
							{
								?>
							<label>
								<input name="selection" type="checkbox" class="filled-in" value="<?php echo $topicd[$i]['id']; ?>"/>
								<span>Séléctioner</span>
							</label>
										<?php 
							} 
							?>
							</p>
						</td>
					</tr>
					<?php 
					}
				}
				?>
			</table><br/>
			<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['moderation']['addPrefix'] == true OR $_PGrades_['PermsForum']['moderation']['epingle'] == true OR $_PGrades_['PermsForum']['moderation']['closeTopic'] == true) AND !$_SESSION['mode'])
			{
			?>
			<div class="card well">
			<div class="card-title center">Avec la séléction:</div>
			<div class="card-content">
			<form id="sel-form" method='POST' action='?action=selTopic' class="inline">
				<?php if(isset($id_sous_forum)) echo "<input type='hidden' name='idSF' value='$id_sous_forum'>"; 
				if($_PGrades_['PermsForum']['moderation']['addPrefix'] == true OR $_Joueur_['rang'] == 1)
				{ ?> 
				<input type='hidden' name='idCat' value='<?php echo $id; ?>'>
				<span>Appliquer un préfix de discussion :</span>
				<label for='prefix'>
					<select name='prefix' id='prefix'>
						<option value="NULL" selected>Ne pas changer le préfixe</option>
						<option value='0'>Aucun</option>
						<?php 
						$reqPrefix = $_Forum_->getPrefixModeration();
						while($donnees_prefix = $reqPrefix->fetch(PDO::FETCH_ASSOC))
						{
							?><option value="<?php echo $donnees_prefix['id']; ?>"><?=$donnees_prefix['nom'];?></option><?php 
						}
						?>
					</select>
				</label>
				<?php } if($_PGrades_['PermsForum']['moderation']['epingle'] == true or $_Joueur_['rang'] == 1)
				{ ?>
				<span>Epinglé la (les) discussions :</span>
						<label for='ouiEP'>
							<input type='radio' name='epingle' value='1' id='ouiEP'/> 
							<span>Oui</span>
						</label>
						<label for='non'>
							<input type='radio' name='epingle' value='0' id='nonEP' checked />
							<span>Non</span>
						</label>
						<br/>
				<?php } if($_PGrades_['PermsForum']['moderation']['closeTopic'] == true OR $_Joueur_['rang'] ==1)
				{ ?>
					<span>Femer la (les) discussions :</span>
						<label for='oui'>
							<input type='radio' name='close' value='1' id='oui'/> 
							<span>Oui</span>
						</label>
						<label for='non'>
							<input type='radio' name='close' value='0' id='non' checked />
							<span>Non</span>
						</label>
						<br/>
				<?php } if($_PGrades_['PermsForum']['moderation']['deleteTopic'] == true OR $_Joueur_['rang'] == 1)
				{
					?>
					<span>Supprimer la (les) discussions :</span>
						<label for='ouiSP'>
							<input type='radio' name='remove' value='1' id='ouiSP'/> 
							<span>Oui</span>
						</label>
						<label for='nonSP'>
							<input type='radio' name='remove' value='0' id='nonSP' checked />
							<span>Non</span>
						</label>
					<br/>	
					<?php
				} ?>
			</div>
			<div class="card-footer">
			<button type='submit' class='btn waves-effect' style="width: 100%;">Valider</button>
			</form>
			</div>
			</div>
			<?php 
		}
		?>
		<div class="center">
			<ul class="pagination">
			<?php
				for($i = 1; $i <= $count_topic_nbrOfPages2; $i++)
				{
					?>
					<li class="waves-effect"><a class="page-link" href="?&page=forum_categorie&id=<?php echo $id; if(isset($id_sous_forum)) echo "&id_sous_forum=$id_sous_forum"; ?>&page_topic=<?php echo $i; ?>"><?php echo $i;?></a></li><?php
				}
				?>

			</ul>
		</div>
			<?php 
		}
		else 
		{
			?>
			<div class="row" id="alert_box">
				<div class="col s12 m12">
					<div class="card red darken-1">
						<div class="row">
							<div class="col s12 m12">
								<div class="card-content">
									<p class="text-center white-text center">
										<center>Aucun message n'a ecnore était posté !</center>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
		} 
	if(isset($_Joueur_) && ((($categoried['close'] == 0 AND $sousforumd['close'] == 0) OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] == true)) AND !$_SESSION['mode']))
	{
		?>
		<hr/>
		<h4><?php if(isset($id_sous_forum)) { echo 'Crée un topic dans le sous-forum ' .$sousforumd['nom']. ''; }else{ echo 'Crée un topic dans la catégorie '; echo $categoried['nom'];} ?></h4>
		<form action="?&action=create_topic" method="post">
			<div class="row">
				<div class="col m12 s12">
					<div class="input-field">
						<input type="hidden" name="id_categorie" value="<?php echo $id; ?>" />
						<input type="hidden" name="sous-forum"
						value="<?php if(isset($id_sous_forum)) { echo $id_sous_forum; } else { echo 'NULL'; } ?>" />
						<input placeholder="Titre du topic" id="first_name" type="text" id="topicnom" name="nom" class="validate" required>
						<label for="topicnom">Rentrez le nom de votre topic</label>
					</div>
					<div class="card center">
						

						<ul class="collapsible">
							<li>
								<div class="collapsible-header"><i class="fas fa-smile"></i> Emoticones
								</div>
								<div class="collapsible-body">
									<?php 
                                                $smileys = getDonnees($bddConnection);
                                                for($i = 0; $i < count($smileys['symbole']); $i++)
                                                {
                                                    echo '<a class="waves-effect waves-teal btn-flat" href="javascript:insertAtCaret(\'contenue\',\' '.$smileys['symbole'][$i].' \')"><img src="'.$smileys['image'][$i].'" alt="'.$smileys['symbole'][$i].'" title="'.$smileys['symbole'][$i].'" /></a>';
                                                }
                                            ?>
								</div>
							</li>
						</ul>

						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en gras', 'ce texte sera en gras', 'b')"
							style="text-decoration: none;" title="Texte en gras"><i class="fas fa-bold"
								aria-hidden="true"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en italique', 'ce texte sera en italique', 'i')"
							style="text-decoration: none;" title="Texte en italique"><i class="fas fa-italic"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en souligné', 'ce texte sera en souligné', 'u')"
							style="text-decoration: none;" title="Texte souligné"><i class="fas fa-underline"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en barré', 'ce texte sera barré', 's')"
							style="text-decoration: none;" title="Texte barré"><i class="fas fa-strikethrough"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à gauche', 'ce texte sera aligné à gauche', 'left')"
							style="text-decoration: none" title="Texte aligné à gauche"><i class="fas fa-align-left"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en centré', 'ce texte sera centré', 'center')"
							style="text-decoration: none" title="Texte centré"><i class="fas fa-align-center"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à droite', 'ce texte sera aligné à droite', 'right')"
							style="text-decoration: none" title="Texte aligné à droite"><i class="fas fa-align-right"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en justifié', 'ce texte sera justifié', 'justify')"
							style="text-decoration: none" title="Texte justifié"><i class="fas fa-align-justify"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre lien', 'https://www.exemple.com/', 'url', 'Entrez le texte de votre lien', 'Clique ici pour acceder a mon super lien')"
							style="text-decoration: none" title="lien"><i class="fas fa-link"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre image', 'https://craftmywebsite.fr/forum/img/site_logo.png', 'img', 'Entrez ici le titre de votre image (laisser vide si vous ne voulez pas compléter', 'Titre')"
							style="text-decoration: none" title="image"><i class="fas fa-image"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre texte en couleur', 'Ce texte sera coloré', 'color', 'Entrer le nom de la couleur en anglais ou en hexaécimal avec le  # : http://www.code-couleur.com/', 'red ou #40A497')"
							style="text-decoration: none" title="couleur"><i class="fas fa-font"></i></a>
						<a class="waves-effect waves-teal btn-flat"
							href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre message caché', 'contenue du spoiler', 'spoiler', 'Entrer le titre du message caché (si la case est vide le titre sera \'Spoiler\'', 'Spoiler')"
							style="text-decoration: none" title="spoiler"><i class="fas fa-flag"></i></a>
						<a class='dropdown-trigger waves-effect waves-teal btn-flat' href='#' data-target='dropdownfont'><span
								class="material-icons">format_size</span></a>
						<ul id='dropdownfont' class='dropdown-content'>
							<a class="waves-effect waves-teal btn-flat"
								href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 2', 'ce texte sera en taille 2', 'font=2')"><span
									style="font-size: 2em;">2</span></a>
							<a class="waves-effect waves-teal btn-flat"
								href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 5', 'ce texte sera en taille 5', 'font=5')"><span
									style="font-size: 5em;">5</span></a>
						</ul>
						<br />
						<div class="row center card-content">
							<div class="col s12" style="padding-right: 5px;padding-left: 5px;">
								<label>Contenue du topic:</label>
								<textarea name="contenue" oninput="previewTopic(this);" maxlength="10000" class="materialize-textarea" id="contenue"
									rows="20"></textarea>
							</div>
						</div>
						<div class="card-action">
							<span>Prévisualisation</span>
							<p style="height: auto; width: auto; background-color: white;" id="previewTopic"></p>
						</div>
						<div class="card-action">
							<button type="submit" class="btn waves-effect <?=$couleur;?>" style="width: 100%">Envoyer</button>
						</div>
					</div>

				</div>

			</div>
			</div>
		</form>
		<?php 
	}
	elseif(!isset($_Joueur_))
		echo '<div class="alert alert-warning text-center">Connectez-vous pour pouvoir interragir ! </div>';
	?>
	</div>
</div>