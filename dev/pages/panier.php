<?php if(isset($_Joueur_)){?>
<div class="header-page valign-wrapper">
    <div class="container no-pad-bot">
        <div class="row center">
            <h4 class="header col s12 white-text bold">
                Panier
            </h4>
        </div>
    </div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
    <div class="section row">

        <?php
            if(isset($_GET['success']) && $_GET['success'] == 'true')
            {
                echo '<div class="alert alert-success"><center><strong>Votre achat a été effectué !</strong></center></div>';
            }
            ?>

        <div class="row well">
            <h3>Votre panier:</h3>
            <table class="table table-striped table-bordered">
                <thead class="thead-inverse">
                    <tr>
                        <th widht="5"></th>
                        <th>Item/Grade</th>
                        <th>Description</th>
                        <th>Quantite</th>
                        <th>Prix Unitaire</th>
                        <th>Sous-Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nbArticles = $_Panier_->compterArticle();
                    $precedent = 0;
                    if($nbArticles == 0 )
                        echo '<tr><td colspan="6"><div class="center">Votre panier est vide :\'( </div></td></tr>';
                    else
                    {
                        for($i = 0; $i < $nbArticles; $i++)
                        {
                            ?>
                    <tr>
                        <td width="5"><a
                                href="?action=supprItemPanier&id=<?php echo htmlspecialchars($_SESSION['panier']['id'][$i]); ?>"
                                class="waves-effect waves-orange btn-flat" title="Supprimer l'item du panier"><i
                                    class="fas fa-trash red-text"></i></a></td>
                        <td><?php $_Panier_->infosArticle(htmlspecialchars($_SESSION['panier']['id'][$i]), $nom, $infos); echo $nom; ?>
                        </td>
                        <td><?php echo $infos; ?></td>
                        <td><?php echo htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?></td>
                        <td class="center"><?php echo htmlspecialchars($_SESSION['panier']['prix'][$i]); ?> <i
                                class="fa fa-diamond"></i></td>
                        <td class="center"><?php $precedent += htmlspecialchars($_SESSION['panier']['prix'][$i])*htmlspecialchars($_SESSION['panier']['quantite'][$i]);
                                echo $precedent; ?> <i class="fas fa-gem"></i></td>
                    </tr>
                    <?php
                        } 
                        if(!empty($_SESSION['panier']['reduction']))
                        {
                            echo '<tr><td>'.htmlspecialchars($_SESSION['panier']['code']).'</td><td>'.htmlspecialchars($_SESSION['panier']['reduction_titre']).'</td><td>1</td><td class="w-25 text-center">-'. $_SESSION['panier']['reduction']*100 .'%</td><td></td><td><a href="?action=retirerReduction" class="btn btn-danger link" title="supprimer la réduction"><i class="fa fa-trash"></i></a></td></tr>';
                        }
                    }
                    ?>
                    <tr style="border: 0px;">
                        <td colspan="4"></td>
                        <td>Total:</td>
                        <td><?php echo number_format($_Panier_->montantGlobal(), 0, ',', ' '); ?> <i
                                class="fas fa-gem"></i></td>
                    </tr>
                </tbody>
            </table>
            <div class="col md5">
                <form action="?action=ajouterCode" method="POST">
                    <div class="card-content bg-gray">

                        <input type="text" id="codepromo" name="codepromo" placeholder="Code promo" class="validate">
                        <button type="submit" class="btn waves-effet">Envoyer</button>
                </form>

            </div>
        </div>
    </div>
    <div class="left">
        <a href="?action=viderPanier"><button class="btn red">Vider le panier !</button></a>
    </div>
    <div class="right">
        <a href="?action=achat"><button class="btn green">Acheter !</button></a>
    </div>
</div>
</div>
<?php }else{ header('Location: ?page=boutique'); }?>