<div class="header-page valign-wrapper">
    <div class="container no-pad-bot">
        <div class="row center">
            <h4 class="header col s12 white-text bold">
                Boutique
            </h4>
        </div>
    </div>
</div>

<div class="container bgcontainer">
    <div class="section">
        <div class="row well">
            <h3><i class="fa fa-info-circle"></i> Comment ça marche?</h3>
            <p>
                La boutique permet d'acheter du contenu In-Game depuis le site grâce à de l'argent réel, cela sert à payer l'hébergement du serveur. La monnaie virtuelle utilisée sur la boutique est le "Jeton", vous pouvez obtenir des jetons en échange de dons <a href="?&page=token">sur cette page</a>
            </p>
            <?php if(isset($_Joueur_['pseudo'])){ 
                    $nbArticles = $_Panier_->compterArticle();
                    $precedent = 0;
                    if($nbArticles == 0 ){

                    } // nbArticles 0 23
                    ?>
                <hr>
                <div class="col s12 m12">
                    <div class="card">
                        <div class="card-content black-text">
                        <style>
                        table
                        {
                            border-collapse: collapse;
                        }
                        td
                        {
                            border: 1px solid black;
                        }
                        </style>
                        <table class="table table-bordered">
                        <tr>
                            <th>Nom de l'article</th>
                            <th>Prix</th>
                        </tr>
                        <?php
                            for($i = 0; $i < $nbArticles; $i++)
                            {
                                ?>
                                <tr>
                                    <td><?php $_Panier_->infosArticle(htmlspecialchars($_SESSION['panier']['id'][$i]), $nom, $infos); echo $nom; ?></td>
                                    <td><?php echo htmlspecialchars($_SESSION['panier']['prix'][$i]); ?> <i class="fa fa-diamond"></i></td>
                                </tr>
                            <?php
                            } 
                        echo '</table>';
                    ?>
                        </div>
                        <div class="panel-footer">
                            <a href="?&page=panier" class="btn btn-block btn-danger btn-lg">Voir mon panier (<?php echo $_Panier_->compterArticle().($_Panier_->compterArticle()>1 ? ' articles' : ' article') ?>)</a>
                        </div>
                    </div>
                    </div>
                    <?php } ?>
                </div>
                </div> <!-- /row 20 -->

        </div> <!-- /well 22 -->
        
        <section id="items" class="container">
            <ul class="collapsible">
            <?php for($j = 0; $j < count($categories); $j++){
                $categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']); ?>
                <li>
                    <div class="collapsible-header">
                        <?php echo $categories[$j]['titre']; ?>
                    </div>
                    <div class="collapsible-body" id="shop-<?php echo $categories[$j]['titre']; ?>">
                            <?php if(!empty($categories[$j]['message'])){ ?>
                                <div class="row" id="alert_box">
                                    <div class="col s12 m12">
                                        <div class="card green darken-1">
                                        <div class="row">
                                                <div class="col s12 m12">
                                                <div class="card-content white-text">
                                                    <p class="text-center center">
                                                        <center><?php echo espacement($categories[$j]['message']); ?></center>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                    <?php
                                        foreach($categories as $key => $value)
                                        {
                                            $categories[$key]['offres'] == 0;
                                        }
                                        for($i = 1; $i <= count($offresTableau); $i++)
                                        {
                                            if($offresTableau[$i]['categorie'] == $categories[$j]['id'])
                                            {
                                                echo '
                                                <div class="col m4 l4 s12">
                                                    <div class="card">
                                                        <hr>
                                                        <span class="card-title"><b><center>'. $offresTableau[$i]['nom'] .'</center></b></span>
                                                        <hr>
                                                        <div class="card-content">
                                                                <div class="offre-description">' .espacement($offresTableau[$i]['description']). '</div>';
                                                            if($offresTableau[$i]['nbre_vente'] != 0 ){
                                                                if($offresTableau[$i]['nbre_vente'] < 0){
                                                                }else
                                                                {
                                                                echo '<center><i>Il en reste : '. $offresTableau[$i]['nbre_vente'] .'</i></center>';
                                                                }
                                                            }elseif($offresTableau[$i]['nbre_vente'] == 0){
                                                                echo '<center><s>Hors stock</s></center>';
                                                            }
                                                            echo '
                                                            </div>
                                                            <div class="card-action center">
                                                            ';
                                                                if(isset($_Joueur_)) {
                                                                        echo '<a class="waves-effect waves-light btn disabled" href="#~" disabled>Prix : ' . ($offresTableau[$i]['prix'] == '0' ? 'gratuit' : $offresTableau[$i]['prix'].'<i class="fas fa-gem">') . ' </i></a></br></br>';   
                                                                    if($offresTableau[$i]['nbre_vente'] == 0){
                                                                        //echo '<a class="waves-effect waves-light btn red darken-4" disabled><i class="fa fa-cart-arrow-down"></i> Rupture de stock </a>';
                                                                        //<a href="#" class="btn btn-info btn-block btn-lg">En rupture de stock</a>
                                                                        } else {
                                                                            echo '<a href="?action=addOffrePanier&offre='. $offresTableau[$i]['id']. '&quantite=1" class="waves-effect waves-light btn red darken-4"><i class="fa fa-cart-arrow-down"></i> Ajouter au panier </a>';
                                                                            // Dispo dans une des prochaines maj du themeecho '<a href="#offre' .$offresTableau[$i]['id']. '" class="modal-trigger waves-effect waves-light btn" title="Voir la fiche produit">Voir la fiche</a>';
                                                                        }
                                                                } 
                                                                else
                                                                {
                                                                    echo'<p class="center">Veulliez vous connecté pour pouvoir commander sur notre boutique</p>';
                                                                }
                                                    echo'</div>
                                                    </div>
                                                </div>
                                                ';
                                                $categories[$j]['offres']++;
                                            }
                                        }
                                    ?>
                                
                            <?php if($categories[$j]['offres'] == 0) {?>
                                <div class="row" id="alert_box">
                                    <div class="col s12 m12">
                                        <div class="card red darken-1">
                                        <div class="row">
                                                <div class="col s12 m12">
                                                <div class="card-content white-text">
                                                    <p>
                                                    <center><strong>Oh zut !</strong> <?=$categories[$j]['titre']?> est encore vide, ré-essayez plus tard !.</center>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col s12 m2">
                                                <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }?>
                    </div>
                </div>
            <?php } ?>
            </li>
        </ul>
        </section>

    </div> <!-- /section 12 -->
</div> <!-- /container 11 -->