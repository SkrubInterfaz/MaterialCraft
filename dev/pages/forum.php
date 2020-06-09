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

    <div class="row" id="alert_box">
        <div class="col s12 m12">
            <div class="card green darken-1">
                <div class="row">
                    <div class="col s12 m12">
                        <div class="card-content white-text">
                            <p class="text-center center">
                                Bienvenue sur le forum de <?php echo $_Serveur_['General']['name']; ?>,
                                Ici vous pourrez échanger et partager avec toute la communauté du serveur !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="forum" class="col s12 m12">
<?php 
$fofo = $_Forum_->affichageForum();
for($i = 0; $i < count($fofo); $i++)
{ 
	if($_PGrades_['PermsDefault']['forum']['perms'] >= $fofo[$i]['perms'] OR ($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $fofo[$i]['perms'] == 0)
	{
	?>
		<table class="striped m6">
		<thead>
			<tr>
				<th colspan="5" style="width: <?=(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteForum'] == true) AND !$_SESSION['mode']) ? '90%' : '100%';?>;"><h3 class="text-center"><?php echo ucfirst($fofo[$i]['nom']); ?></h3>
                <?php if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteForum'] == true) AND !$_SESSION['mode']) { ?>
                    <button class='dropdown-trigger-forum btn' data-target='fofooptions<?=$fofo[$j]['id']; ?>'>Paramétres du forum</button>
                <?php } ?>
                </th>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteForum'] == true) AND !$_SESSION['mode'])
				{
					?>
                <th></th>
                    <?php if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteForum'] == true) AND !$_SESSION['mode']) { ?>
                        <div id="NomForum<?=$fofo[$i]['id'];?>" class="modal">
                            <div class="modal-content">
                            <form action="?action=changeNomForum" method="post">
                                <h4>Modification du nom:</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="hidden" name="id" id="id" value="<?=$fofo[$i]['id'];?>">
                                        <input type="hidden" name="entite" id="entite" value="0">
                                        <input value="<?=$fofo[$i]['nom'];?>" id="nom" name="nom" type="text" class="validate">
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
                        <ul id='fofooptions<?=$fofo[$j]['id']; ?>' class='dropdown-content'>
                            <li><a class="dropdown-item"
                                    href="?action=ordreForum&ordre=<?=$fofo[$i]['ordre']; ?>&id=<?=$fofo[$i]['id']; ?>&modif=monter"><i
                                        class="fas fa-arrow-up"></i> Monter d'un cran</a></li>
                            <li><a class="dropdown-item"
                                    href="?action=ordreForum&ordre=<?=$fofo[$i]['ordre']; ?>&id=<?=$fofo[$i]['id']; ?>&modif=descendre"><i
                                        class="fas fa-arrow-down"></i> Descendre d'un cran</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li><a href="?action=remove_forum&id=<?php echo $fofo[$i]['id']; ?>"
                                    class="text-center red-text">Supprimer</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li><a class="modal-trigger" href="#NomForum<?=$fofo[$i]['id'];?>"
                                    class="text-center">Editer le nom</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li class="white">
                                <div class="permissions">
                                    <div class="card white">
                                        <div class="card-title">Permission:</div>
                                        <div class="card-content">
                                            <form action="?action=modifPermsForum" method="POST">
                                                <input type="hidden" name="id" value="<?=$fofo[$i]['id'];?>" />
                                                <input type="number" name="perms" value="<?=$fofo[$i]['perms'];?>"
                                                    class="validate">
                                        </div>
                                        <div class="card-footer center">
                                            <button type="submit" class="btn">Modifier</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider" tabindex="-1"></li>
                        </ul>
                    <?php }
				}
				?>
			</tr>
		</thead>
<?php
$categorie = $_Forum_->infosForum($fofo[$i]['id']);
?>

    <tbody>
<?php   for($j = 0; $j < count($categorie); $j++) { 
			
			$derniereReponse = $_Forum_->derniereReponseForum($categorie[$j]['id']);
			if(($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $_PGrades_['Permsdefault']['forum']['perms'] >= $categorie[$j]['perms'] OR $categorie[$j]['perms'] == 0)
			{
			?>
            <tr>

				<td style="width: 3%;"><?php if($categorie[$j]['img'] == NULL) { ?><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="?page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons"><?php echo $categorie[$j]['img']; ?></i></a><?php }?></td>
				<td style="width: 38%;"><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $categorie[$j]['nom']; ?></a>
				<?php 	if($_Joueur_['rang'] == 1 AND !$_SESSION['mode'])
							$perms = 100;
						elseif($_PGrades_['PermsDefault']['forum']['perms'] > 0)
							$perms = $_PGrades_['PermsDefault']['forum']['perms'];
						else
							$perms = 0;

				$sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie AND perms <= :perms');
							$sousforum->execute(array(
								'id_categorie' => $categorie[$j]['id'],
								'perms' => $perms
							));
							$sousforum = $sousforum->fetchAll(); 
							if(count($sousforum) != 0)
							{ ?><br/><small>(Sous-forum  :<?php echo count($sousforum); ?>)</small>
				<?php } ?>
				</td>
			<td class="text-center"><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>" style="display: flex;"><?php echo $CountTopics = $_Forum_->compteTopicsForum($categorie[$j]['id']); ?> Topics</a></td>
			<td class="text-center"><a href="?page=forum_categorie&id=<?=$categorie[$j]['id']; ?>" style="display: flex;"><?=$_Forum_->compteMessages($categorie[$j]['id']) + $CountTopics; ?> Messages</a></td>
			<td class="text-center"><?php if($derniereReponse) { ?> 
					<a href="?page=post&id=<?php echo $derniereReponse['id']; ?>" title="<?=$derniereReponse['titre'];?>">Dernier: <?php $taille = strlen($derniereReponse['titre']);
					echo substr($derniereReponse['titre'], 0, 15);
					if(strlen($taille > 15)){ echo '...'; } ?><br/><?=$derniereReponse['pseudo'];?>, Le <?php $date = explode('-', $derniereReponse['date_post']); echo '' .$date[2]. '/' .$date[1]. '/' .$date[0]. ''; ?></a>
			<?php
				}
				else { ?><p> Il n'y a pas de sujet dans ce forum </p> <?php } 
				?></td>
                <?php if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['general']['deleteCategorie'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode']){ ?>
                    <td class="text-center">
                        <button class='dropdown-trigger-forum btn' data-target='options<?=$categorie[$j]['id']; ?>'><i class="fas fa-cogs"></i></button>
                    </td>
                <?php } ?>
                <div id="NomForum<?=$categorie[$j]['id'];?>-type1" class="modal">
                            <div class="modal-content">
                            <form action="?action=changeNomForum" method="post">
                                <h4>Modification du nom:</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="hidden" name="id" id="id" value="<?=$categorie[$j]['id'];?>">
                                        <input type="hidden" name="entite" id="entite" value="1">
                                        <label class="active" for="nom">Nom du forum</label>
                                        <input value="<?=$categorie[$j]['nom'];?>" id="nom" name="nom" type="text" class="validate">
                                        <input value="<?=($categorie[$j]['img'] == NULL) ? 'chat' : $categorie[$j]['img'];?>" id="icone" name="icone" type="text" class="validate">
                                        <small class="center">Icones (https://design.google.com/icons/)</small>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Annuler</a>
                                <button type="submit" class="modal-close waves-effect waves-green btn-flat">Modifier</a>
                            </div>
                            </form>
                        </div>
                <ul id='options<?=$categorie[$j]['id']; ?>' class='dropdown-content'>
                    <li><a class="dropdown-item"
                            href="?action=ordreCat&ordre=<?=$categorie[$j]['ordre']; ?>&id=<?=$categorie[$j]['id']; ?>&modif=monter"><i
                                class="fas fa-arrow-up"></i> Monter d'un cran</a></li>
                    <li><a class="dropdown-item"
                            href="?action=ordreCat&ordre=<?=$categorie[$j]['ordre']; ?>&id=<?=$categorie[$j]['id']; ?>&modif=descendre"><i
                                class="fas fa-arrow-down"></i> Descendre d'un cran</a></li>
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="?action=remove_cat&id=<?php echo $categorie[$j]['id']; ?>"
                            class="text-center red-text">Supprimer</a></li>
                    <li class="divider" tabindex="-1"></li>
                    <li><a class="modal-trigger" href="#NomForum<?=$categorie[$j]['id'];?>-type1">Editer le nom</a></li>
                    <li class="divider" tabindex="-1"></li>
                    <?php if($categorie[$j]['close'] == 0) { ?>
                    <li class="white"><a href="?action=lock_cat&id=<?=$categorie[$j]['id'];?>&lock=1" title="Fermer le forum"><i class="fas fa-unlock-alt"></i></a></li>
                    <?php }else{ ?>
                    <li class="white"><a href="?action=unlock_cat&id=<?=$categorie[$j]['id'];?>&lock=0" title="Ouvrir le forum"><i class="fas fa-lock"></i></a></li>
                    <?php } ?>
                    <li class="divider" tabindex="-1"></li>
                    <li class="white">
                        <div class="permissions">
                            <div class="card white">
                                <div class="card-title">Permission:</div>
                                <div class="card-content">
                                    <form action="?action=modifPermsCategorie" method="POST">
                                        <input type="hidden" name="id" value="<?=$categorie[$j]['id'];?>" />
                                        <input type="number" name="perms" value="<?=$categorie[$j]['perms'];?>"
                                            class="validate">
                                </div>
                                <div class="card-footer center">
                                    <button type="submit" class="btn">Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

			</tr>
			<?php }
			} ?>
	</tbody>
</table>
<?php
	}
} ?>

    <?php
    if($_PGrades_['PermsForum']['general']['addForum'] == true OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addCategorie'] == true)
    {
        echo '<hr/>';
        ?>
                <div class="center">
                    <a href="?action=mode_joueur" class="btn waves-effect">Passer en mode visuel <?php echo ($_SESSION['mode']) ? "Administrateur" : "Joueur"; ?></a>
                </div>
            <?php 
            if($_PGrades_['PermsForum']['general']['addForum'] == true OR $_Joueur_['rang'] == 1)
            { ?>
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header">Ajouter une Catégorie</div>
                    <div class="collapsible-body">
                        <form action="?action=create_forum" method="post">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="nomCat" name="nom" type="text" maxlength="80" class="validate">
                                    <label for="nomCat">Nom de la catégorie</label>
                                </div>
                            </div>
                            <button type="submit" class="btn">Créer une catégorie</button>
                        </form>
                    </div>
                    </div>
                </li>
            </ul>
            <?php
            }
            if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addCategorie'] == true)
            { ?>
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header">Ajouter Forum </div>
                    <div class="collapsible-body">
                        <form action="?action=create_cat" method="post">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="nomFo" name="nom" type="text" maxlength="80" class="validate" required>
                                    <label for="nomFo">Nom du forum</label>
                                </div>
                                <div class="input-field col s8">
                                    <input id="iconeFo" name="img" type="text" class="validate">
                                    <label for="iconeFo">Icone du forum Icon disponible sur : <a href="https://design.google.com/icons/" target="_blank">https://design.google.com/icons/</a></label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="forum" id="forumCat" required>
                                        <?php
                                        for($z = 0; $z < count($fofo); $z++)
                                        {
                                            ?><option value="<?php echo $fofo[$z]['id']; ?>"><?php echo $fofo[$z]['nom']; ?></option><?php
                                        }
                                        ?>
                                    </select>
                                    <label for="forumCat">Catégorie : </label>
                                </div>
                            </div>

                            <button type="submit" class="btn">Créer un forum</button>
                        </form>
                    </div>
                </li>
            </ul>
        <?php
            }
        }
         ?>
        
        </div>

    </div>
</div>
