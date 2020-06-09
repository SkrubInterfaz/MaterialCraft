<?php
require('modele/forum/adminForum.class.php');

if(isset($_Joueur_) AND isset($_GET['id'], $_GET['objet']))
{
	$AdminForum = new AdminForum($bddConnection);
	$objet = htmlentities($_GET['objet']);
	$id = htmlentities($_GET['id']);
	if($AdminForum->verifEdit($objet, $id, $_Joueur_, $_PGrades_))
	{
		$table = ($objet == 1) ? 'cmw_forum_post': 'cmw_forum_answer';
		$req = $bddConnection->prepare('SELECT * FROM ' .$table. ' WHERE id = :id');
		$req->execute(array(
			'id' => $id
		));
		$donnee = $req->fetch(PDO::FETCH_ASSOC);
		?>
        <div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
                Edition d'un<?=($objet == 1) ? ' topic !': 'e réponse !';?>
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section">
        <form action="?action=editForum" method="POST">
			<div class="container">
				<input type="hidden" name="id" value="<?php echo $id; ?>"/>
				<input type="hidden" name="objet" value="<?php echo $objet; ?>"/>
				<div class="form-group">
					<div class="row">
						<?php if($objet == 1)
						{
							?>
                            <div class="input-field col s12 m12">
                                <input id="titre" name="titre" maxlength="40" type="text" class="validate" value="<?=$donnee['nom'];?>">
                                <label for="titre">Modifier le titre</label>
                            </div>
						<?php 
						} ?>
                        <div class="row">
                            <div class="col m12 s12">
                                <div class="card center">

                                  <ul class="collapsible">
                                        <li>
                                        <div class="collapsible-header"><i class="fas fa-smile"></i> Emoticones</div>
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
                                                        
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en gras', 'ce texte sera en gras', 'b')" style="text-decoration: none;" title="Texte en gras"><i class="fas fa-bold" aria-hidden="true"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en italique', 'ce texte sera en italique', 'i')" style="text-decoration: none;" title="Texte en italique"><i class="fas fa-italic"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en souligné', 'ce texte sera en souligné', 'u')" style="text-decoration: none;" title="Texte souligné"><i class="fas fa-underline"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en barré', 'ce texte sera barré', 's')" style="text-decoration: none;" title="Texte barré"><i class="fas fa-strikethrough"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à gauche', 'ce texte sera aligné à gauche', 'left')" style="text-decoration: none" title="Texte aligné à gauche"><i class="fas fa-align-left"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en centré', 'ce texte sera centré', 'center')" style="text-decoration: none" title="Texte centré"><i class="fas fa-align-center"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à droite', 'ce texte sera aligné à droite', 'right')" style="text-decoration: none" title="Texte aligné à droite"><i class="fas fa-align-right"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en justifié', 'ce texte sera justifié', 'justify')" style="text-decoration: none" title="Texte justifié"><i class="fas fa-align-justify"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre lien', 'https://www.exemple.com/', 'url', 'Entrez le texte de votre lien', 'Clique ici pour acceder a mon super lien')" style="text-decoration: none" title="lien"><i class="fas fa-link"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre image', 'https://craftmywebsite.fr/forum/img/site_logo.png', 'img', 'Entrez ici le titre de votre image (laisser vide si vous ne voulez pas compléter', 'Titre')" style="text-decoration: none" title="image"><i class="fas fa-image"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre texte en couleur', 'Ce texte sera coloré', 'color', 'Entrer le nom de la couleur en anglais ou en hexaécimal avec le  # : http://www.code-couleur.com/', 'red ou #40A497')" style="text-decoration: none" title="couleur"><i class="fas fa-font"></i></a>
                                    <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre message caché', 'contenue du spoiler', 'spoiler', 'Entrer le titre du message caché (si la case est vide le titre sera \'Spoiler\'', 'Spoiler')" style="text-decoration: none" title="spoiler"><i class="fas fa-flag"></i></a>
                                    <a class='dropdown-trigger waves-effect waves-teal btn-flat' href='#' data-target='dropdownfont'><span class="material-icons">format_size</span></a>
                                        <ul id='dropdownfont' class='dropdown-content'>
                                            <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 2', 'ce texte sera en taille 2', 'font=2')"><span style="font-size: 2em;">2</span></a>
                                            <a class="waves-effect waves-teal btn-flat" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 5', 'ce texte sera en taille 5', 'font=5')"><span style="font-size: 5em;">5</span></a>
                                        </ul>
                                    <br/>
                                    <div class="row center card-content">
                                        <div class="col s12" style="padding-right: 5px;padding-left: 5px;" >
                                            <label>Edition du message</label>
                                            <textarea name="contenue" maxlength="10000" class="materialize-textarea" id="contenue" rows="20"><?php echo $donnee['contenue']; ?></textarea>                                        
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-primary waves-effect">Envoyer</button>
                                    </div>
                                </div>

                        </div>

                    </div>
	    	         </div>
	    	         </div>
                </div>
            </div>
		  </form>
        </div>
    </div>
    
	      <?php 
	  }
}
else
	header('Location: ?page=erreur&erreur=0');
