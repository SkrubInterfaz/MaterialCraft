<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center <?=$couleur;?>-text text-lighten-2 titre wow bounceIn" wow-data-delay="0.8s" data-wow-duration="1s"><?=$_Serveur_['General']['name'];?></h1>
        <div class="row center">
          <h5 class="header col s12 light wow bounceIn" wow-data-delay="0.9s" data-wow-duration="1s"><?=$_Serveur_['General']['description'];?></h5>
        </div>
        <div class="row center">
          <br>
          <button onclick="copierIP()" class="waves-<?=$couleur;?> btn-flat wow bounceIn" style="color: white;font-family: Roboto, sans-serif, Arial;font-size: 36px" data-wow-delay="1s" data-wow-duration="1s">
          <?php
            if(!empty($_Serveur_['General']['ipTexte'])){
                echo $_Serveur_['General']['ipTexte'];
            }else{
                echo "Adresse inexistante";
            }?>
          </button>
        </div>
			     <input type="text" value="<?=$_Serveur_['General']['ipTexte'];?>" id="ipserveur" style="opacity: 0">
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="<?php echo $_Theme_['Acceuil']['parallax']['1']; ?>" alt="Parallax1"></div>
  </div>


  <div class="container bgcontainer">
    <div class="section">
      <div class="row">

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center wow bounceInLeft" wow-data-delay="1s"> <img src="<?=$_Theme_['Acceuil']['navslide']['1']['image'];?>" alt="Icon 1" width="64px"> </h2>
            <p class="light wow bounceInUp" wow-data-delay="1.5s" ><?=$_Theme_['Acceuil']['navslide']['1']['description'];?></p>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center wow bounceInUp" wow-data-delay="1s"> <img src="<?=$_Theme_['Acceuil']['navslide']['2']['image'];?>" alt="Icon 2" width="64px"> </h2>
            <p class="light wow bounceInUp" wow-data-delay="1.5s"><?=$_Theme_['Acceuil']['navslide']['2']['description'];?></p>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center wow bounceInRight" wow-data-delay="1s"> <img src="<?=$_Theme_['Acceuil']['navslide']['3']['image'];?>" alt="" width="64px"> </h2>
            <p class="light wow bounceInUp" wow-data-delay="1.5s"><?=$_Theme_['Acceuil']['navslide']['3']['description'];?></p>
          </div>
        </div>

      </div>
    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center wow pulse" data-wow-duration="2s">
          <h4 class="header col s12 light"><span style="font-weight: bold !important;">Mon Serveur</span> un serveur <span class="textwrite" id="textwrite"></span></h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="<?=$_Theme_['Acceuil']['parallax']['2'];?>" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container bgcontainer">
    <div class="section">
        <div class="row center col s12">
          <h5 class="header bold wow bounce">Flux de nouveautés</h5>
					<section id="news" class="center">
					<div class="row">
					<ul class="collapsible popout col s12 wow shake">

						<?php 
						$i = 0;
							if(isset($news) && count($news) > 0)
							{
								for($i = 0; $i < 2; $i++)
								{
									if($i < count($news))
									{
							$getCountCommentaires = $accueilNews->countCommentaires($news[$i]['id']);
							$countCommentaires = $getCountCommentaires->rowCount();

							$getcountLikesPlayers = $accueilNews->countLikesPlayers($news[$i]['id']);
							$countLikesPlayers = $getcountLikesPlayers->rowCount();
							$namesOfPlayers = $getcountLikesPlayers->fetchAll();

							$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
							unset($Img);
							$Img = new ImgProfil($news[$i]['auteur'], 'pseudo');
							?>
							<li <?php if($i == 0){ echo 'class="active"';}?>>
              <div class="collapsible-header"><i class="material-icons">label</i><span id="news01" class="gray disabled">#<?=$news[$i]['id'];?></span>&nbsp; <?=$news[$i]['titre'];?></div>
              <div class="collapsible-body row card">
                    <div class="card-header col s12">
                      <span class="card-title black-text left">Par <a href="?page=profil&profil=<?php echo $news[$i]['auteur']; ?>" title="aller voir le profil de l'auteur"><img src="<?=$Img->getImgToSize(24, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="auteur"/> <?php echo $news[$i]['auteur']; ?></a></span>
                    </div>
                    <div class="card-content black-text col s12">
                      <p>
											<?php echo $news[$i]['message']; ?>
											</p>
											<div class="left">
												<p>
												<?php echo 'Posté le '.date('d/m/Y', $news[$i]['date']).' &agrave; '.date('H:i:s', $news[$i]['date']); ?>
												</p>
											</div>
                    </div>
                    <div class="card-action col s12">
                      <div class="right">
											<?php
											if(isset($_Joueur_)) {
												$reqCheckLike = $accueilNews->checkLike($_Joueur_['pseudo'], $news[$i]['id']);
												$getCheckLike = $reqCheckLike->fetch(PDO::FETCH_ASSOC);
												$checkLike = $getCheckLike['pseudo'];
												if($_Joueur_['pseudo'] == $checkLike) {
													echo '<a href="#news'.$news[$i]['id'].'" class="actionnews modal-trigger left"><i class="fas fa-comments"></i> '.$countCommentaires.' Commentaires</a>';
												} else {
													echo '<a href="?&action=likeNews&id_news='.$news[$i]['id'].'" class="actionnews right modal-trigger"><i class="far fa-thumbs-up"></i> J\'aime </a> <a href="#news'.$news[$i]['id'].'" class="actionnews modal-trigger left"><i class="fas fa-comments"></i> '.$countCommentaires.' Commentaires</a>';
												}
											} else {
												echo '<a href="#news'.$news[$i]['id'].'" class="actionnews modal-trigger left"><i class="fas fa-comments"></i> '.$countCommentaires.' Commentaires</a>';
											}
											
											if($countLikesPlayers != 0) {
												echo '<a href="#" class="actionnews modal-trigger"><i class="far fa-thumbs-up"></i> '.$countLikesPlayers;
												echo '</a>';
											} ?>
                      </div>
            </li>


							<?php 
							unset($Img);
							if(isset($_Joueur_)) {
								$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
								while($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) {
									$reqEditCommentaire = $accueilNews->editCommentaire($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
									$getEditCommentaire = $reqEditCommentaire->fetch(PDO::FETCH_ASSOC);
									$editCommentaire = $getEditCommentaire['commentaire'];
									if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {  ?>
									<div id="news<?php echo $news[$i]['id'].'-'.$newsComments['id'].'-edit'; ?>" class="modal">
											<div class="modal-content">
													<h4>Edition du commentaire</h4>
													<form action="?&action=edit_news_commentaire&id_news=<?php echo $news[$i]['id'].'&auteur='.$newsComments['pseudo'].'&id_comm='.$newsComments['id']; ?>" method="post">
													<textarea name="edit_commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required><?php echo $editCommentaire; ?></textarea>
											</div>
											<div class="modal-footer">
												<button type="submit" class="waves-effect waves-green btn-flat">Valider</a>
											</div>
										</form>
									</div>
										<?php }
									}
								} ?>
							<div class="modal bottom-sheet" id="<?php echo "news".$news[$i]['id']; ?>" style="margin: 0;">
								<div class="modal-content modal-lg">
									<div class="modal-content">
										<h3 class="header">Commentaires: <?php echo $news[$i]['titre']; ?></h3>
										<?php
									$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
									while($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) {
										if(isset($_Joueur_)) {
											
											$getCheckReport = $accueilNews->checkReport($_Joueur_['pseudo'], $newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$checkReport = $getCheckReport->rowCount();

											$getCountReportsVictimes = $accueilNews->countReportsVictimes($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$countReportsVictimes = $getCountReportsVictimes->rowCount();
										}
										unset($Img);
										$Img = new ImgProfil($newsComments['pseudo'], 'pseudo');
										?>
										<p>
										<div class="commentssection">
										<center>
											<div class="row center">
													<div class="col l4 s12 m4 right">

														<div class="card s12 m4 container" <?php if(isset($_Joueur_)){echo'style="min-height: 300px;"';}?>>

															<div class="card-content">
																<img class="rounded" src="<?=$Img->getImgToSize(64, $width, $height);?>" style="margin-left: auto; margin-right: auto; display: block; width: <?=$width;?>px; height: <?=$height;?>px;" alt="Auteur" />
																<p class="text-muted text-center username"><?php echo '<B> '.$newsComments['pseudo'].'</B>'; ?>
																</p>
															<?php if(isset($_Joueur_)) { ?>
															<div class="card-action">
																<span style="color: red;"><?php if($newsComments['nbrEdit'] != "0"){echo 'Nombre d\'édition: '.$newsComments['nbrEdit'].' | ';}if($countReportsVictimes != "0"){echo '<B>'.$countReportsVictimes.' Signalement</B> |';} ?></span>
																	<ul class="dropdown-menu">
																		<?php if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {
																			echo '<li><a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'-'.$newsComments['id'].'-edit" class="waves-effect orange waves-orange btn">Editer</a></li>';
																			echo '<li><a href="?&action=delete_news_commentaire&id_comm='.$newsComments['id'].'&id_news='.$news[$i]['id'].'&auteur='.$newsComments['pseudo'].'" class="waves-effect green waves-green btn">Supprimer</a></li>';
																		}
																		if($newsComments['pseudo'] != $_Joueur_['pseudo']) {
																			if($checkReport == "0") {
																				echo '<li><a href="?&action=report_news_commentaire&id_news='.$news[$i]['id'].'&id_comm='.$newsComments['id'].'&victime='.$newsComments['pseudo'].'" class="waves-effect orange waves-orange btn-large">Signaler</a></li>';
																			} else {
																				echo '<li><a href="#">Déjà report</a></li>';
																			}
																		} ?>
																	</ul>
																</div>
																<?php } ?>
															</div>

														</div>
														
													</div>
													<div class="col l8 m8 s12 well" style="min-height: 350px;">
														<?php $com = espacement($newsComments['commentaire']); echo BBCode($com, $bddConnection); ?>
													</div>
											</div>
										</center> <!-- Ticket-Commentaire-->
										<?php } ?>
										</p>
								</div>
									<?php
										if(isset($_Joueur_)) { ?>
											<div class="card-action">
												<form action="?&action=post_news_commentaire&id_news=<?php echo $news[$i]['id']; ?>" method="post">
													<div class="container">
														<div class="input-field col l9">
															<textarea id="commentaire" name="commentaire" class="materialize-textarea"></textarea>
																<label for="commentaire">Votre commentaire</label>
																<span class="center"><i>Minimum de 6 caractères - Maximum de 255 caractères</i></span>
														</div>
													</div>
													<br>
													<div class="col l3 s12">
														<div class="center">
															<button type="submit" class="btn btn-flat">Commenter</button>
														</div>
													</div>
													<br/>
												</form>
										</div>
									<?php } else { ?>
											<div class="alert text-red center">Veuillez-vous connecter pour mettre un commentaire.</div>
										<?php } ?>

										</div><!-- Modal-Footer -->
									</div> <!-- Modal-Content -->
								<!-- </div> -->
						<!-- </div> -->
					<!-- </div> -->

							<?php }  
							}
						}else{
							echo '<p class="center red-text darken-4">Aucune news n\'a était crée !</p>';
						}
						?>
            </div>
				</div>

						</ul>
          </div>
        </div>
    </div>
  </div>
  <div class="parallax-container valign-wrapper">
    <div class="container no-pad-bot">
      <div class="row center">
        <h4 class="header col s12 light wow pulse" data-wow-duration="2s">
					<span style="font-weight: bold !important;">
					<?php
					if($_Serveur_['General']['statut'] == 1)
          { ?>
					Rejoignez nous,</span> nous sommes:
          <br/>
					<?=$playeronline;?> / <?=$maxPlayers;?> <span class="textwrite">joueurs connectés</span> !</h5>
					<?php
					}
					?>
      </div>
    </div>
    <div class="parallax"><img src="theme/<?=$_Serveur_['General']['theme'];?>/images/parallax/bg3.jpg" alt="Unsplashed background img 3"></div>
  </div>