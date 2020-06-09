<div class="navbar-fixed" id="navbarfixedjs">
<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="index.php" class="brand-logo">
          <img src="theme/<?=$_Serveur_['General']['theme']?>/images/logo.png" alt="Logo du serveur" style="width: 64px;">
        </a>
      <ul class="right hide-on-med-and-down">
    <?php
    // Cette boucle affiche un lien / menu déroulant à chaque tour. On fait autant de tour qu'il y a de textes à afficher.
        for($i = 0; $i < count($_Menu_['MenuTexte']); $i++)
        {
        // Si il y a une liste déroulante contenant le texte du texte de ce tour de boucle, le lien devient un menu déroulant.
            if(isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]))
            {
            // On affiche la structure de base du menu déroulant:
                        ?>
        <li><a class='dropdown-trigger wow fadeInDown' wow-data-delay='<?php echo $i/10; ?>s' data-wow-offset='0' href='#' data-target='dropdown<?=$_Menu_['MenuTexte'][$i]; ?>'><?=$_Menu_['MenuTexte'][$i]; ?></a></li>
         
            <ul id='dropdown<?=$_Menu_['MenuTexte'][$i]; ?>' class='dropdown-content'>
            <li class="spacer"></li>
                <?php
                // On affiche la puce dans le menu déroulant depuis une boucle, qui fait autant de tour qu'il y a de lignes à afficher dans la liste déroulante.
                for($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]); $k++)
                {
                // Dans le cas où le texte de la puce vaut "-divider-", on met une ligne de division
                    if($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == 'LastLinkDontDelete'){}
                    elseif($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == '-divider-')
                    {
                        echo'<li class="divider" tabindex="-1"></li>';
                    }else{
                        echo '<li><a class="'.$couleur.'-text" href="' .$_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$i]][$k]. '">' .$_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k]. '</a></li>';
                    }
                } // Fermeture ligne 22
            echo '</ul>';
        }
        // Si le lien n'est pas un menu déroulant, on l'affiche tout simplement, ou presque, il faut prévoir que si on est sur la page du lien, le lien doit être en foncé (class="active").
        else
        {
            $quellePage = str_replace('?&page=', '', $_Menu_['MenuLien'][$i]);
            //
            if(isset($_GET['page']) AND $quellePage == $_GET['page']) 
                $active = 'active';

            // Si il n'y a pas de get(on est donc sur l'index) et qu'on est au premier tour de boucle --> le premier lien(souvent un lien vers l'accueil justement) est actif (foncé).
            elseif(!isset($_GET['page']) AND $i == 0) 
                $active = 'active';

            // On prévoit que quand il n'y a rien à afficher, la var est vide pour éviter l'erreur.
            else $active = '';

            // On affiche enfin la puce ! 
            echo '<li class=" '.$active.' wow fadeInDown" wow-data-delay=""'. $i/10 .'s"" data-wow-offset="0"><a href="' .$_Menu_['MenuLien'][$i]. '">' .$_Menu_['MenuTexte'][$i]. '</a></li>';
        }
    }
    if(isset($_Joueur_)) { 
        $Img = new ImgProfil($_Joueur_['id']);

        $req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, vu, cmw_forum_post.last_answer AS last_answer_pseudo 
        FROM cmw_forum_topic_followed
        INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
        $req_topic->execute(array(
        'pseudo' => $_Joueur_['pseudo']
        ));
        $alerte = 0;
        while($td = $req_topic->fetch(PDO::FETCH_ASSOC))
        {
            if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0)
            {
                $alerte++;
            }
        }
        $req_answer = $bddConnection->prepare('SELECT vu
        FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
        AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudo AND type = 2');
        $req_answer->execute(array(
            'pseudo' => $_Joueur_['pseudo'],
        ));
        while($answer_liked = $req_answer->fetch(PDO::FETCH_ASSOC))
        {
            if($answer_liked['vu'] == 0)
            {
                $alerte++;
            }
        }
        ?>
    <li><a class='dropdown-trigger' href='#' data-target='dropdowncompteconnecte'>
            <img class="icon-player-topbar" src="<?=$Img->getImgToSize(20, $width, $height); ?>" style="height:18px;max-width: 20px!important;"/> <?=$_Joueur_['pseudo'];?>
        </a>
    </li>
     
    <ul id='dropdowncompteconnecte' class='dropdown-content' style='min-width: 200px !important;'>
    <li class="spacer"></li>
        <?php
        if($_PGrades_['PermsPanel']['access'] == "on" OR $_Joueur_['rang'] == 1)
            echo '<li><a href="admin.php" class="red-text darken-3"><i class="fas fa-tachometer-alt"></i> Administration</a></li>';
        if($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1)
        {
            $req_report = $bddConnection->query('SELECT id FROM cmw_forum_report WHERE vu = 0');
            $signalement = $req_report->rowCount();
            echo '<li><a href="?page=signalement" class="orange-text darken-3"><i class="fas fa-exclamation-triangle"></i> Signalement (<span id="signalement">'. $signalement .'</span>)</a></li>';
        }
        ?>
        <li><a class="profilnavlink" href="?page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><i class="fas fa-user"></i> Mon Compte</a></li>
        <li><a class="profilnavlink" href="?page=token"><i class="fas fa-gem"></i> Tokens (<?php echo $_Joueur_['tokens'] . '';?>)</a></li>
        <li><a class="profilnavlink" href="?page=panier"><i class="fas fa-shopping-basket"></i> Panier (<?php echo $_Panier_->compterArticle(); ?>)</a></li>
        <li><a class="profilnavlink" href="?page=alert"><i class="fa fa-bell"></i>  Alertes (<?php echo $alerte; ?>)</a></li>
        <li><a href="?action=deco" class="red-text darken-4"><i class="fas fa-power-off"></i> Deconnexion</a></li>
    </ul>
    <?php }else{ //Si joueur n'est pas co ?>
        <li><a class='dropdown-trigger' href='#' data-target='dropdowncompte'>Mon Compte</a></li>
        <ul id='dropdowncompte' class='dropdown-content'>
         <li class="spacer"></li>
         <li><a class="modal-trigger" href="#connexion">Connexion</a></li>
         <li><a class="modal-trigger" href="#inscription">Inscription</a></li>
        </ul>
    <?php } ?>
      </ul>
    </ul>

            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul id="slide-out" class="sidenav">

    <?php
    // Cette boucle affiche un lien / menu déroulant à chaque tour. On fait autant de tour qu'il y a de textes à afficher.
    for($i = 0; $i < count($_Menu_['MenuTexte']); $i++)
    {
    // Si il y a une liste déroulante contenant le texte du texte de ce tour de boucle, le lien devient un menu déroulant.
        if(isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]))
        {
        // On affiche la structure de base du menu déroulant:
                    ?>
    <li><a class='dropdown-trigger wow fadeInDown' wow-data-delay='<?php echo $i/10; ?>s' href='#' data-target='dropdown<?=$_Menu_['MenuLien'][$i]; ?>'><?=$_Menu_['MenuTexte'][$i]; ?></a></li>
        <ul id='dropdown<?=$_Menu_['MenuLien'][$i]; ?>' class='dropdown-content'>
        <li class="spacer"></li>
        <?php
            // On affiche la puce dans le menu déroulant depuis une boucle, qui fait autant de tour qu'il y a de lignes à afficher dans la liste déroulante.
            for($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]); $k++)
            {
            // Dans le cas où le texte de la puce vaut "-divider-", on met une ligne de division
                if($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == 'LastLinkDontDelete'){}
                elseif($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == '-divider-')
                {
                    echo'<li class="divider" tabindex="-1"></li>';
                }else{
                    echo '<li><a class="'.$couleur.'-text" href="' .$_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$i]][$k]. '">' .$_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k]. '</a></li>';
                }
            } // Fermeture ligne 22
        echo '</ul>';
    }
    // Si le lien n'est pas un menu déroulant, on l'affiche tout simplement, ou presque, il faut prévoir que si on est sur la page du lien, le lien doit être en foncé (class="active").
    else
    {
        $quellePage = str_replace('?&page=', '', $_Menu_['MenuLien'][$i]);
        //
        if(isset($_GET['page']) AND $quellePage == $_GET['page']) 
            $active = 'active';

        // Si il n'y a pas de get(on est donc sur l'index) et qu'on est au premier tour de boucle --> le premier lien(souvent un lien vers l'accueil justement) est actif (foncé).
        elseif(!isset($_GET['page']) AND $i == 0) 
            $active = 'active';

        // On prévoit que quand il n'y a rien à afficher, la var est vide pour éviter l'erreur.
        else $active = '';

        // On affiche enfin la puce ! 
        echo '<li class=" '.$active.' wow fadeInDown" wow-data-delay="'. $i/10 .'s"><a href="' .$_Menu_['MenuLien'][$i]. '">' .$_Menu_['MenuTexte'][$i]. '</a></li>';
    }
    }
    if(isset($_Joueur_)) { 
    $Img = new ImgProfil($_Joueur_['id']);

    $req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, vu, cmw_forum_post.last_answer AS last_answer_pseudo 
    FROM cmw_forum_topic_followed
    INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
    $req_topic->execute(array(
    'pseudo' => $_Joueur_['pseudo']
    ));
    $alerte = 0;
    while($td = $req_topic->fetch(PDO::FETCH_ASSOC))
    {
        if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0)
        {
            $alerte++;
        }
    }
    $req_answer = $bddConnection->prepare('SELECT vu
    FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
    AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudo AND type = 2');
    $req_answer->execute(array(
        'pseudo' => $_Joueur_['pseudo'],
    ));
    while($answer_liked = $req_answer->fetch(PDO::FETCH_ASSOC))
    {
        if($answer_liked['vu'] == 0)
        {
            $alerte++;
        }
    }
    ?>
    <li class="divider" tabindex="-1"></li>
    <?php
    if($_PGrades_['PermsPanel']['access'] == "on" OR $_Joueur_['rang'] == 1)
        echo '<li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Administration</a></li>';
    if($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1)
    {
        $req_report = $bddConnection->query('SELECT id FROM cmw_forum_report WHERE vu = 0');
        $signalement = $req_report->rowCount();
        echo '<li><a href="?page=signalement"><i class="fas fa-exclamation-triangle"></i> Signalement <span class="badge badge-pill badge-warning" id="signalement">' . $signalement . '</span></a></li>';
    }
    ?>
    <li><a href="?page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><i class="fas fa-user"></i> Mon Compte</a></li>
    <li><a href="?page=token"><i class="fas fa-gem"></i> Tokens (<?php echo $_Joueur_['tokens'] . '';?>)</a></li>
    <li><a href="?page=panier"><i class="fas fa-shopping-basket"></i> Panier (<?php echo $_Panier_->compterArticle(); ?>)</a></li>
    <li><a href="?page=messagerie"><i class="fa fa-envelope"></i> Messagerie</a></li>
    <li><a href="?page=alert"><i class="fa fa-bell"></i>  Alertes (<?php echo $alerte; ?>)</a></li>
    <li><a href="?action=deco" class="red-text darken-4"><i class="fas fa-power-off"></i> Deconnexion</a></li>
    <?php }else{ //Si joueur n'est pas co ?>
    <li><a class="modal-trigger" href="#connexion">Connexion</a></li>
    <li><a class="modal-trigger" href="#inscription">Inscription</a></li>
    <?php } ?>
    </ul>

    </div>
  </nav>

</div>
