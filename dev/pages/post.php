<?php
require('modele/forum/date.php');
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	if(isset($_Joueur_))
	$_JoueurForum_->topic_lu($id, $bddConnection);
	$topicd = $_Forum_->getTopic($id);
	if(!empty($topicd['id']))
	{
		if(($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR ($_PGrades_['PermsDefault']['forum']['perms'] >= $topicd['perms'] AND $_PGrades_['PermsDefault']['forum']['perms'] >= $topicd['permsCat']) OR ($topicd['perms'] == 0 AND $topicd['permsCat'] == 0))
		{
	?>
	
<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
				Post > <?=$topicd['nom'];?>
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
    <div class="section">
      <div class="row">

        <div class="center">
        	<?php if(isset($_Joueur_) && $_JoueurForum_->is_followed($id))
						{
							?>

        	<a class="waves-effect waves-light btn <?=$couleur;?>" href="?&action=follow&id_topic=<?php echo $topicd['id']; ?>">Suivre cette discussion</a>

        	<?php }
						else if(isset($_Joueur_))
						{
						?>

        	<a class="waves-effect waves-light btn <?=$couleur;?>" href="?&action=unfollow&id_topic=<?php echo $topicd['id']; ?>">Ne plus suivre cette discussion</a>
        	<?php } ?>
        	<a class="waves-effect waves-light btn <?=$couleur;?>" href="?&page=forum_categorie&id=<?php echo $topicd['id_categorie']; if(isset($topicd['sous_forum'])) { ?>&id_sous_forum=<?php echo $topicd['sous_forum']; } ?>">Revenir à l'index de la catégorie</a>

        </div>
        <br>
        <nav class="">
          <div class="nav-wrapper  grey lighten-5">
            <div class="col s12">
              <a href="index.php" class="breadcrumb">Accueil</a>
              <a href="index.php?page=forum" class="breadcrumb">Forum</a>
			  <a class="breadcrumb" href="?&page=forum_categorie&id=<?php echo $topicd['id_categorie']; ?>"><?php echo $topicd['nom_categorie']; ?></a>
			  <?php if(isset($topicd['sous_forum'])) { ?>
			  <a class="breadcrumb-item" href="?page=forum_categorie&id=<?php echo $topicd['id_categorie']; ?>&id_sous_forum=<?php echo $topicd['sous_forum']; ?>"><?php echo $topicd['nom_sf']; ?></a>
			  <?php } ?>
			  <a class="breadcrumb active" aria-current="page" href="#"><?php echo $topicd['nom']; ?></a>
            </div>
          </div>
        </nav>
      </div>
	
	<?php if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['moderation']['closeTopic'] == true OR $_PGrades_['PermsForum']['moderation']['deleteTopic'] == true OR $_PGrades_['PermsForum']['moderation']['mooveTopic'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode']) { ?>
	<div class="row">
		<div class="col m4 offset-m2">
			<a class='dropdown-trigger btn <?=$couleur;?>' href='#' data-target='action-modo'>Modération</a>

				<ul id='action-modo' class='dropdown-content'>
					<?php 
					if($_PGrades_['PermsForum']['moderation']['closeTopic'] == true OR $_Joueur_['rang'] == 1)
					{
						if($topicd['etat'] == 1)
						{
							?>
						<li>
							<a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=4">Ouvrir la discussion</a>
						</li>
						<?php
						}
						else
						{
							?>
							<li>
								<a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=1">Fermer la discussion</a>
							</li>
						<?php 
						}
					}
					if($_PGrades_['PermsForum']['moderation']['deleteTopic'] == true OR $_Joueur_['rang'] == 1)
					{
						?>
						<li>
							<a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=2">Supprimer le topic</a>
						</li>
						<?php 
					}
					if($_PGrades_['PermsForum']['moderation']['mooveTopic'] == true OR $_Joueur_['rang'] == 1)
					{
						?>
						<li>
							<a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=3">Déplacer la discussion</a>
						</li>
						<?php 
					}
					?>
					</ul>
			</div>

		<div class="col m4 offset-m2">

		  <a class='dropdown-trigger btn <?=$couleur?>' href='#' data-target='accesslevel'>Niveau d'accés</a>

			<ul class="dropdown-content" id="accesslevel">
				<li class="white">
							<form class="px-4 py-3" action="?action=modifPermsTopics" method="POST">
								<div class="form-group">
								<label for="perms">Niveau de permission</label>
								<input type="hidden" name="id" value="<?=$id;?>">
								<input type="number" min="0" max="100" class="form-control" id="perms" name="perms" value="<?=$topicd['perms'];?>">
								</div>
								<div class="center">
									<button type="submit" class="btn success">Modifier</button>
								</div>
							</form>
				</li>
			</ul>
		</div>

	</div><?php } ?>

	<div class="row">

		<div class="right col s9">

			<div class="card-panel grey lighten-5" style="margin-right: -10px; min-height: 380px !important;">
				<div style="text-overflow: clip; word-wrap: break-word;">
					<?php 
				unset($contenue);
				$contenue = espacement($topicd['contenue']);
				$contenue = BBCode($contenue, $bddConnection);
				echo $contenue;
				?>
				<hr/>
				<?php 
				$signature = $_Forum_->getSignature($topicd['pseudo']);
				$signature = espacement($signature);
				$signature = BBCode($signature, $bddConnection);
				echo $signature;
				?>
				<?php if(isset($_Joueur_)){ ?>
					<div class="row">
						<div class="center">
						<?php if(isset($_Joueur_) && ($_Joueur_['pseudo'] == $topicd['pseudo'] OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['editTopic'] == true) AND !$_SESSION['mode']))
								{
									?>
									<br/>
									<br/>
									<div class="col m6 s12">
										<form action="?action=editForum" method="post">
											<input type="hidden" name="objet" value="topic"/>
											<input type="hidden" name="id" value="<?php echo $id; ?>" />
											<button type="submit" class="btn">Editer le topic</button>
										</form>
									</div>
									<?php 
								}
									if(isset($_Joueur_) && ($_Joueur_['pseudo'] == $topicd['pseudo'] OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteTopic'] == true) AND !$_SESSION['mode']))
									{
										?>
									<div class="col m6 s12">
									<form action="?action=remove_topic" method="post">
										<input type="hidden" name="id_topic" value="<?php echo $id; ?>" />
										<a class="btn red modal-trigger" href="#topic_<?php echo $id; ?>">
											Supprimer</a>
											<div class="modal well" id="topic_<?php echo $id; ?>">
												<button type="submit" class="btn red darken-2">Confirmer la suppression du topic </button>
											</div>
									</form>
									</div><?php
									}
								?>
						</div>
					</div>
				<?php } ?> 
				<?php 
					$countlike = $_Forum_->compteLike($topicd['id'], $count1, 1);
					$countdislike = $_Forum_->compteDisLike($topicd['id'], $count2, 1);
					if($count1 > 0 OR $count2 > 0)
					{
						echo '<div class="right">';
						if($count1 > 0)
							echo $count1.' personnes aiment ça.<br/>';
					
						if($count2 > 0)
							echo $count2.' personnes n\'aiment pas ça';

						echo '</div><br/>';
					} ?>
					<div class="left">
					<?php
					if(isset($_Joueur_) AND $_Joueur_['pseudo'] != $topicd['pseudo']){
						echo '
						<form action="?&action=signalement_topic" method="post">
							<input type="hidden" name="id_topic2" value='. $id .' />
							<button type="submit" class="btn red">Signaler !</button>
						</form>
						';
					}
					?>
					</div>
				</div>
			</div>
				
			<div class="right">
				<p>
				Le <?php  echo $topicd['jour']; ?> <?php $mois = switch_date($topicd['mois']); echo $mois; ?> <?php echo $topicd['annee'];?>  <?php if($topicd['d_edition'] != NULL) { echo 'édité le '; $d_edition = explode('-', $topicd['d_edition']); echo $d_edition[2]; echo '/' .$d_edition[1]. '/' .$d_edition[0]. ''; } ?>
				</p>
					<?php
					if(isset($_Joueur_))
					{
						if(array_search($_Joueur_['pseudo'], array_column($countlike, 'pseudo')) === FALSE AND array_search($_Joueur_['pseudo'], array_column($countdislike, 'pseudo')) === FALSE AND $_Joueur_['pseudo'] != $topicd['pseudo'])
						{
					?>
					<div class="row">
						<div class="col m2">
							<form class="form-inline" action="?&action=like" method="post">
								<input type="hidden" name="choix" value="1" />
								<input type="hidden" name="type" value="1" />
								<input type="hidden" name="id_answer" value="<?php echo $topicd['id']; ?>" />
								<button type="submit" class="waves-effect waves-success btn-flat" title="J'aime" ><i class="far fa-thumbs-up"></i></button>
							</form>
						</div>
						<div class="col m4">
						</div>
						<div class="col m2">
							<form class="form-inline" action="?&action=like" method="post">
								<input type="hidden" name="choix" value="2" />
								<input type="hidden" name="type" value="1" />
								<input type="hidden" name="id_answer" value="<?php echo $topicd['id']; ?>" />
								<button type="submit" class="waves-effect waves-red btn-flat" title="Je n'aime pas"><i class="far fa-thumbs-down"></i></button>
							</form>
						</div>
					</div>
					<?php
					}
					elseif(array_search($_Joueur_['pseudo'], array_column($countlike, 'pseudo')) !== FALSE OR array_search($_Joueur_['pseudo'], array_column($countdislike, 'pseudo')) !== FALSE)
					{
					?><div class="row">
						<div class="col">
							<form class='form-inline' action="?&action=unlike" method="post">
								<input type="hidden" name="id_answer" value="<?php echo $topicd['id']; ?>" />
								<input type="hidden" name="type" value="1" />
								<button type="submit" class="waves-effect waves-red btn-flat" title="Ne plus aimer">Je n'aime plus</button>
							</form>
						</div>
					</div><?php

				}
			}
			?>
			</div>

		</div>

		<div class="left col s3 card-panel grey lighten-5 z-depth-1">

			<div class="center">
				<img src="https://cravatar.eu/avatar/<?php echo $topicd['pseudo']; ?>/128" class="circle responsive" style="padding-top: 10px;" alt="Auteur.png"><br>
				<p class="username center"><?php echo $topicd['pseudo']; ?></p>
				<?php echo $_Forum_->gradeJoueur($topicd['pseudo']); ?>
				<br />

			</div>
			<br>

		</div>

	</div>


	<!-- Affichage des réponses -->
	 <?php 
    $count_Max = $_Forum_->compteReponse($id);
    $count_nbrOfPages = ceil($count_Max / 30);

    if(isset($_GET['page_post']))
    {
        $page = $_GET['page_post'];
    } else {
        $page = 1;
    }

    $count_FirstDisplay = ($page - 1) * 30;
	$answerd = $_Forum_->affichageReponse($id, $count_FirstDisplay);
    for($i = 0; $i < count($answerd); $i++)
	{ ?>
		<hr/>

	<div class="row">

<div class="right col s9">

	<div class="card-panel grey lighten-5" style="margin-right: -10px; min-height: 380px !important;">
		<div style="text-overflow: clip; word-wrap: break-word;">
		<?php $answere = $answerd[$i]['contenue'];
		$answere = espacement($answere);
		$answere = BBCode($answere, $bddConnection);
		echo $answere;
		?>
		<hr/>
		<?php 
				$signature = $_Forum_->getSignature($answerd[$i]['pseudo']);
				$signature = espacement($signature);
				$signature = BBCode($signature, $bddConnection);
				echo $signature;
				?>
		<?php if(isset($_Joueur_)){ ?>
			<div class="row">
				<div class="center">
				<?php if(isset($_Joueur_) && ($_Joueur_['pseudo'] == $answerd[$i]['pseudo'] OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['editTopic'] == true) AND !$_SESSION['mode']))
						{
							?>
							<br/>
							<br/>
							<div class="col m6 s12">
								<form action="?action=editForum" method="post">
									<input type="hidden" name="objet" value="topic"/>
									<input type="hidden" name="id" value="<?=$answerd[$i]['id'];?>" />
									<button type="submit" class="btn">Editer le topic</button>
								</form>
							</div>
							<?php 
						}
							if(isset($_Joueur_) && ($_Joueur_['pseudo'] == $answerd[$i]['pseudo'] OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteTopic'] == true) AND !$_SESSION['mode']))
							{
								?>
							<div class="col m6 s12">
							<form action="?action=remove_answer" method="post">
								<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
								<input type="hidden" name="page" value="<?php if(isset($_GET['page_post'])) { echo $_GET['page_post']; } else { echo '1'; }?>" />
								<a class="btn red modal-trigger" href="#answer_<?php echo $answerd[$i]['id']; ?>">
											Supprimer</a>
									<div class="modal well" id="answer_<?php echo $answerd[$i]['id']; ?>">
										<button type="submit" class="btn red darken-2">Confirmer la suppression</button>
									</div>
							</form>
							</div><?php
							}
						?>
				</div>
			</div>
		<?php } ?> 
		<?php 
			$countlikeanswerd[$i] = $_Forum_->compteLike($answerd[$i]['id'], $count1, 1);
			$countdislikeanswerd[$i] = $_Forum_->compteDisLike($answerd[$i]['id'], $count2, 1);
			if($count1 > 0 OR $count2 > 0)
			{
				echo '<div class="right">';
				if($count1 > 0)
					echo $count1.' personnes aiment ça.<br/>';
			
				if($count2 > 0)
					echo $count2.' personnes n\'aiment pas ça';

				echo '</div><br/>';
			} ?>
			<div class="left">
			<?php
			if(isset($_Joueur_) AND ($_Joueur_['pseudo'] != $answerd[$i]['pseudo'])){
				echo '
				<form action="?&action=signalement_topic" method="post">
					<input type="hidden" name="id_topic2" value='. $id .' />
					<button type="submit" class="btn red">Signaler !</button>
				</form>
				';
			}
			?>
			</div>
		</div>
	</div>
		
	<div class="right">
		<p>
		Le <?php echo $answerd[$i]['day']; ?> <?php $answerd[$i]['mois'] = switch_date($answerd[$i]['mois']); echo $answerd[$i]['mois']; ?> <?php echo $answerd[$i]['annee']; ?> <?php if($answerd[$i]['d_edition'] != NULL){ echo 'édité le '; $d_edition = explode('-', $answerd[$i]['d_edition']); echo '' .$d_edition[2]. '/' .$d_edition[1]. '/' .$d_edition[0]. ''; } ?>
		</p>
			<?php
			if(isset($_Joueur_))
			{
				if(array_search($_Joueur_['pseudo'], array_column($countlikeanswerd[$i], 'pseudo')) === FALSE AND array_search($_Joueur_['pseudo'], array_column($countdislike, 'pseudo')) === FALSE AND $_Joueur_['pseudo'] != $topicd['pseudo'])
				{
			?>
			<div class="row">
				<div class="col m2">
					<form class="form-inline" action="?&action=like" method="post">
						<input type="hidden" name="choix" value="1" />
						<input type="hidden" name="type" value="1" />
						<input type="hidden" name="id_answer" value="<?php echo $topicd['id']; ?>" />
						<button type="submit" class="waves-effect waves-success btn-flat" title="J'aime" ><i class="far fa-thumbs-up"></i></button>
					</form>
				</div>
				<div class="col m4">
				</div>
				<div class="col m2">
					<form class="form-inline" action="?&action=like" method="post">
						<input type="hidden" name="choix" value="2" />
						<input type="hidden" name="type" value="1" />
						<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
						<button type="submit" class="waves-effect waves-red btn-flat" title="Je n'aime pas"><i class="far fa-thumbs-down"></i></button>
					</form>
				</div>
			</div>
			<?php
			}
			elseif(array_search($_Joueur_['pseudo'], array_column($countlikeanswerd[$i], 'pseudo')) !== FALSE OR array_search($_Joueur_['pseudo'], array_column($countdislikeanswerd[$i], 'pseudo')) !== FALSE)
			{
			?><div class="row">
				<div class="col">
					<form class='form-inline' action="?&action=unlike" method="post">
						<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
						<input type="hidden" name="type" value="1" />
						<button type="submit" class="waves-effect waves-red btn-flat" title="Ne plus aimer">Je n'aime plus</button>
					</form>
				</div>
			</div><?php

		}
	}
	?>
	</div>

</div>

<div class="left col s3 card-panel grey lighten-5 z-depth-1">

	<div class="center">
		<img src="https://cravatar.eu/avatar/<?php echo $answerd[$i]['pseudo']; ?>/128" class="circle responsive" style="padding-top: 10px;" alt="Auteur.png"><br>
		<p class="username center"><?php echo $answerd[$i]['pseudo']; ?></p>
		<?php echo $_Forum_->gradeJoueur($answerd[$i]['pseudo']); ?>
		<br />

	</div>
	<br>

</div>

</div>
<?php 
	}

	?>

		<div class="center">
		<ul class="pagination"><?php
			for($i = 1; $i <= $count_nbrOfPages; $i++)
			{
                ?>
				<li class="waves-effect">
					<a href="?&page=post&id=<?php echo $id; ?>&page_post=<?php echo $i; ?>"><?php echo $i;?></a>
				</li><?php
			} ?>    
        </ul>
		</div>
	<?php 
	 
	 if($topicd['etat'] == 1 AND (($_Joueur_['rang'] != 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] != true) AND $_SESSION['mode']))
	 {
		 ?>
		 <div class="row" id="alert_box">
            <div class="col s12 m12">
                <div class="card red darken-1">
                   <div class="row">
                        <div class="col s12 m10">
                          <div class="card-content white-text">
                            <p>
								Le topic est fermé ! Aucune réponse n'est possible ! 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<script>M.toast({html: "<i class='fas fa-exclamation-triangle'></i> Ce topic et fermé au réponses !"})</script>
		
	<?php 
	 }
	 elseif(isset($_Joueur_) && ($topicd['etat'] == 0 OR (($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] == true) AND !$_SESSION['mode'])))
	 {
		$data = $_Forum_->isLock($topicd['id_categorie']);	
		if($data['close'] == 0 OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] == true) AND !$_SESSION['mode'])
		{
		 ?>
		 
	<hr/>
	<form action="?&action=post_answer" method="post">
		<div class="row">
			<div class="col m12 s12">
				<div class="card center">
					<input type="hidden" name="id_topic" value="<?php echo $id; ?>" />

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
							<textarea name="contenue" oninput="previewTopic(this);" maxlength="10000"
								class="materialize-textarea" id="contenue" rows="20"></textarea>
						</div>
					</div>
					<div class="card-action">
						<span>Prévisualisation</span>
						<p style="height: auto; width: auto; background-color: white;" id="previewTopic"></p>
					</div>
					<div class="card-action">
						<button type="submit" class="btn waves-effect <?=$couleur;?>" style="width: 100%">Répondre</button>
					</div>
				</div>

			</div>

		</div>
		</div>
	</form>


	<?php 
		}
	 }
	 ?>
			 	</div>
			</div>
		</div>
	</div>
</div>
<?php
		}
		else
			header('Location: ?page=erreur&erreur=7');
	}
	else
	{
		header('Location: index.php');
	}
}
else
	header('Location: ?page=erreur&erreur=17');//fatale
?>
