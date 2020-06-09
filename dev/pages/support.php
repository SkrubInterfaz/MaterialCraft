<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
				Support
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section row">
        <div class="col s12">
			<div class="center">
				<h4 class="text-<?=$couleur?>"><i class="fas fa-user-md"></i> Support communautaire</h4>
				<p>Postez des tickets, lisez ceux des autres, répondez à la communauté et discutez avec l'équipe du serveur !</p>
			</div>
	<div class="card">
	  <div class="card-content">
				<table class="table table-bordered">
					<thead class="thead-inverse bg-primary">
						<tr>
							<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { echo '<th style="text-align: center;">Visuel</th>'; } ?>
							<th style="text-align: center;">Pseudo</th>
							<th style="text-align: center;">Titre</th>
							<th style="text-align: center;">Date</th>
							<th style="text-align: center;">Action</th>
                            <th style="text-align: center;">Status </th>
							<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['closeTicket'] == true) { echo '<th style="text-align: center;">Modification</th>'; } ?>
						</tr>
					</thead>
					<tbody>
					<?php $j = 0;
					while($tickets = $ticketReq->fetch(PDO::FETCH_ASSOC)) { ?>
						<tr>
						    <?php if($tickets['ticketDisplay'] == 0 OR $tickets['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) {
						    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { ?>
						    <td class="align-middle">
						        <?php if($tickets['ticketDisplay'] == "0") {
						                echo '<span><i class="glyphicon glyphicon-eye-open"></i> Public</span>';
						            } else {
								        echo '<span ><i class="glyphicon glyphicon-eye-close"></i> Privé</span>';
								} ?>
							</td>
							<?php } ?>

							<td class="text-center align-middle">
								<?php 
								$Img = new ImgProfil($tickets['auteur'], 'pseudo');
								?>
								<a href="index.php?&page=profil&profil=<?php echo $tickets['auteur'] ?>"><img class="icon-player-topbar" src="<?=$Img->getImgToSize(32, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" /> <?php echo $tickets['auteur'] ?></a>
							</td>
						
							<td class="center align-middle">
								<?php echo $tickets['titre'] ?>​
							</td>
						
							<td class="center align-middle">
								<?php echo $tickets['jour']. '/' .$tickets['mois']. ' à ' .$tickets['heure']. ':' .$tickets['minute']; ?>
							</td>
						
							<td class="center align-middle">
								<a class="btn btn-<?=$couleur?> modal-trigger" data-toggle="modal" href="#<?php echo $tickets['id']; ?>Slide">
									Voir <i class="fa fa-eye"></i>
								</a>
							</td>
                            
                            <td class="center align-middle">
                                <?php
                                    $ticketstatus = $tickets['etat'];
                                    if($ticketstatus == "1"){
                                        echo '<button class="btn green">Résolu <span class="glyphicon glyphicon-ok"></span></button>';
                                    } else {
                                        echo '<button class="btn red">Non Résolu <span class="glyphicon glyphicon-remove"></span></button>';
                                    }
                                ?>
                            </td>

							<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['closeTicket'] == true) { ?>
								<td style="text-align: center;">
									<form method="post" action="?&action=ticketEtat&id=<?php echo $tickets['id']; ?>">
										<?php if($tickets['etat'] == 0){ 
											echo '<button type="submit" name="etat" class="btn orange" value="1" />Fermer le ticket</button>';
										}else{
											echo '<button type="submit" name="etat" class="btn orange" value="0" />Ouvrir le ticket</button>';
										} ?>
									</form>
								</td>
							<?php }
							} ?>
						</tr>
						
					<?php if($tickets['ticketDisplay'] == "0" OR $tickets['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { ?>
					<!-- Modal -->
					<div class="modal fade" id="<?php echo $tickets['id']; ?>Slide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-support">
							<div class="modal-content">
							
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel" ><?php echo $tickets['titre']; ?></h4>
								</div>
								
								<div class="modal-body">
									<p class="corp-ticket" style="text-overflow: clip; word-wrap: break-word;">
									<?php
                                    $ticketstatus = $tickets['etat'];
                                    if($ticketstatus == "1"){
                                        echo '<div class="center"><div class="btn green">Résolu !</div></div>';
                                    } else {
                                        echo '';
                                    }
                                ?>
									<?php 
									unset($message);
									$message = espacement($tickets['message']);
									$message = BBCode($message, $bddConnection);
									echo $message; 
									$Img = new ImgProfil($tickets['auteur'], 'pseudo');
									?></p>
									<p class="right">Ticket de : <img src="<?=$Img->getImgToSize(16, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="none" /> <?php echo $tickets['auteur']; ?></p>
									<br>
									<hr>
									
									<?php
									$commentaires = 0;
									if(isset($ticketCommentaires[$tickets['id']]))
									{
										echo '<h5>' .count($ticketCommentaires[$tickets['id']]). ' Commentaires</h3>';
										for($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++)
										{
											$get_idComm = $bddConnection->prepare('SELECT id FROM cmw_support_commentaires WHERE auteur LIKE :auteur AND id_ticket LIKE :id_ticket');
											$get_idComm->bindParam(':auteur', $ticketCommentaires[$tickets['id']][$i]['auteur']);
											$get_idComm->bindParam(':id_ticket', $tickets['id']);
											$get_idComm->execute();
											$req_idComm = $get_idComm->fetch(PDO::FETCH_ASSOC);
									?>
									<div class="card">
    										<div class="card-content">
												<div class="left">
													<?php 
														$Img = new ImgProfil($ticketCommentaires[$tickets['id']][$i]['auteur'], 'pseudo');
														?>
													<p>
													<?php echo $ticketCommentaires[$tickets['id']][$i]['auteur']; ?></span>
													( <?php echo 'Le ' .$ticketCommentaires[$tickets['id']][$i]['jour']. '/' .$ticketCommentaires[$tickets['id']][$i]['mois']. ' à ' .$ticketCommentaires[$tickets['id']][$i]['heure']. ':' .$ticketCommentaires[$tickets['id']][$i]['minute']; ?> )
													</p>
													
												</div>
												<div class="right">
												<div style="text-overflow: clip; word-wrap: break-word;" class="well">
													<?php unset($message);
													$message = espacement($ticketCommentaires[$tickets['id']][$i]['message']);
													$message = BBCode($message, $bddConnection);
													echo $message;  ?></div>
												</div>
										</div>
									</div>
									
									

									<?php
										}
									}		
									else
										echo '<h3 class="ticket-commentaire-titre">0 Commentaire</h3>';
									?>
									
									
									
								</div>
								<?php
								if($tickets['etat'] == "0"){
									echo '<form action="?&action=post_ticket_commentaire" method="post">
												<div class="modal-footer">
													<input type="hidden" name="id" value="'.$tickets['id'].'" /><div class="row">
													<textarea name="message" id="ticket'.$tickets['id'].'" class="materialize-textarea" rows="3" cols="60"></textarea>
													<div class="row">
														<div class="center">
															<button type="submit" class="btn btn-primary">Commenter</button>
														</div>
													</div>
												</div>
											</form>
										';
								} else {
									echo '<div class="modal-footer">
											<form action="" method="post">
												<textarea style="text-align: center;cursor: not-allowed !important;"name="message" class="materialize-textarea" rows="2" placeholder="Ticket résolu ! Merci de contacter un administrateur pour réouvrir votre ticket." disabled></textarea>
											</form>
										  </div>';
								}
								?>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->

					<?php if($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['editMemberComm'] == true) {
						if(!empty($ticketCommentaires[$tickets['id']]))
						{
							for($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++) {
								$get_idComm = $bddConnection->prepare('SELECT id FROM cmw_support_commentaires WHERE auteur LIKE :auteur AND id_ticket LIKE :id_ticket');
								$get_idComm->bindParam(':auteur', $ticketCommentaires[$tickets['id']][$i]['auteur']);
								$get_idComm->bindParam(':id_ticket', $tickets['id']);
								$get_idComm->execute();
								$req_idComm = $get_idComm->fetch(PDO::FETCH_ASSOC); ?>
						<div class="modal fade" id="editComm-<?php echo $req_idComm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editComm">
						    <form method="POST" action="?&action=edit_support_commentaire&id_comm=<?php echo $req_idComm['id']; ?>&id_ticket=<?php echo $tickets['id']; ?>&auteur=<?php echo $ticketCommentaires[$tickets['id']][$i]['auteur']; ?>">
					        <div class="modal-dialog modal-lg" role="document">
						        <div class="modal-content">
							        <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title center" id="editComm">Edition du commentaire</h4>
							        </div>
							        <div class="modal-content">
							            <div class="col md12 s12 center">
							            	<div class="row">
							            		<textarea name="editMessage" class="materialize-textarea" rows="3" style="resize: none;"><?php echo $ticketCommentaires[$tickets['id']][$i]['message']; ?></textarea>
							            	</div>
							            </div>
							        </div>
							        <div class="modal-footer">
							        	<div class="col md12 s12 text-center">
							        		<div class="row">
							        			<button type="submit" class="btn green waves-effect">Valider !</button>
							        		</div>
							        	</div>
							        </div>
							    </div>
							</div>
							</form>
					    </div>
					    <?php }
							}
				       }
				    }
					$j++; } ?>
					</tbody>
			</table>
	</div>
				<div class="card-footer">
				<?php
					/* if(!isset($_Joueur_)) 
					 	echo '<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-user"></span> Se connecter pour ouvrir un ticket</a>'; 
					*/
					
					if(isset($_Joueur_)) 
					{
				?>
					<div class="center">
					<a data-toggle="modal" href="#ticketCree" class="btn green modal-trigger"><i class="fas fa-pencil-square-o"></i> Poster un ticket !</a>
					</div>
					<br/>
				</div>
		  </div>

				<div class="modal fade" id="ticketCree">
				
				<form action="" method="post" onSubmit="envoie_ticket();">
					<div class="modal-content">
						
					<div class="row">
				<div class="col s8 m8">
					<div class="form-group">
						<label class="control-label" for="titre_ticket">Sujet</label>
							<div class="form-group">
								<input type="text" id="titre_ticket" class="form-control" name="titre" placeholder="Sujet">
							</div>
					</div>
				</div>
				<div class="col s4 m4">
					<div class="form-group">
						<label for="vu_ticket">Visibilité</label>
								<?php 
if(!isset($_Serveur_["support"]["visibilite"]) || $_Serveur_["support"]["visibilite"] == "both" ){ ?>
								<select class="form-control" id="vu_ticket" name="ticketDisplay">
									<option value="0">Publique</option>
									<option value="1">Privée</option>
								</select>
								<?php } else {?>
								<select class="form-control" id="vu_ticket" name="ticketDisplay">
									<?php if($_Serveur_["support"]["visibilite"] == "prive"){ ?>
									<option value="1">Privée</option>
									<?php } else {?>
									<option value="0">Publique</option>
									<?php }?>
								</select>
								<?php }?>
							</div>
						</div>
					<div class="form-group">
						<div class="col s12 m12 center">
							<label for="message_ticket">Description détaillée</label>
							<textarea class="materialize-textarea" id="message_ticket" name="message"
								placeholder="Description détaillée de votre problème" rows="3" required></textarea>
						</div>
					</div>
				</div>
					<div class="modal-footer">
						<button type="submit" class="btn green waves-effect champ valider">Envoyer</button>
					</div>
				</div>
				</form>

				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script>
var nbEnvoie = 0
	function envoie_ticket()
	{
		if(nbEnvoie>0)
			return false;
		else
		{
			var data_titre = document.getElementById("titre_ticket").value;
			var data_message = document.getElementById("message_ticket").value;
			var data_vu = document.getElementById("vu_ticket").value;
			$.ajax({
				url  : 'index.php?action=post_ticket',
				type : 'POST',
				data : 'titre=' + data_titre + '&message=' + data_message + '&ticketDisplay=' + data_vu,
				dataType: 'html',
				success: function() {
					sleep(1);
				}
			});
			nbEnvoie++;
			return true;
		}
	}
</script>