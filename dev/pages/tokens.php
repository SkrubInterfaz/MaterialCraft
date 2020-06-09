<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
            Achats de jetons
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section row">
        <div class="col s12">
		<?php if(isset($_GET['success']) AND $_GET['success'] == 'true'){ ?>
	<div class="alert alert-success">Votre code a bien été validé, vous avez été crédité de <?php echo $_GET['tokens']; ?>  Jetons ! </div>
	<?php } elseif(isset($_GET['success']) AND $_GET['success'] == 'false'){ ?>
	<div class="alert alert-danger">Le code entré est incorrect, vous n'avez pas été crédité...</div>
	<?php } 
	if(isset($_Joueur_['pseudo']) && $_Serveur_['Payement']['paypal'] == true) 
		{
			?>
	<div class="card">
		<div class="card-content">
				<div class="row">
				<div class="col s12 m12">
					<h3>PayPal</h3>
		<div class="row" id="alert_box">
            <div class="col s12 m12">
                <div class="card green darken-1">
                   <div class="row">
                        <div class="col s12 m10">
                          <div class="card-content white-text">
                            <p>
								Deux possibilités s'offrent à vous pour les dons, vous pouvez payer par PayPal, soit avec votre compte PayPal soit avec votre Carte Bleu de manière sécurisée depuis le site PayPal (le payement ne s'effectue donc pas sur notre serveur/site). L'avantage de PayPal est que le joueur reçoit plus de Jetons qu'avec un payement téléphonique (qui sont surtaxés).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			<?php 
			require_once('controleur/tokens/paypal.php'); 
			?>
			<div class="row">
				<?php
				if(isset($offresTableau))
					for($i = 0; $i < count($offresTableau); $i++)
					{
						echo '
						<div class="col s4">
							<div class="well">
								<div class="contenuBoutique">
									<h3 class="titre-offre">'. $offresTableau[$i]['nom'] .'</h3>
									' .espacement($offresTableau[$i]['description']). '
								</div>
								<div class="footer-offre"> ';
									if(isset($_Joueur_)) {
										if($lienPaypal[$i] == 'viaMail')
											require('controleur/paypal/paypalMail.php');
										else
											echo '<a href="'. $lienPaypal[$i] .'" class="btn btn-primary">Acheter !</a>';
									}
									else { echo'<a href="?&page=connection" class="btn btn-danger">Connexion..</a>'; }
									echo '
									<button class="btn blue right waves-effect">' .$offresTableau[$i]['prix']. ' euro</button>
								</div>
							</div>
						</div>		';
					}
					else
						echo '
						<div class="row" id="alert_box">
						<div class="col s12 m12">
							<div class="card red darken-1">
							   <div class="row">
									<div class="col s12 m10">
									  <div class="card-content white-text">
										<p>
											Aucune offre n\'est disponible via PayPal
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
						';
					?>
				</div>
					</div>
				</div>
			</div>
		</div>
			<?php 
		}
	if(isset($_Joueur_['pseudo']) && $_Serveur_['Payement']['dedipass'] == true)
	{
		?>
		<div class="card">
			<div class="row">
				<div class="col s12 m12">
				<h3>Dedipass</h3>
				<div class="row" id="alert_box">
            <div class="col s12 m12">
                <div class="card red darken-1">
                   <div class="row">
                        <div class="col s12 m10">
                          <div class="card-content white-text">
                            <p>
 <div class="row" id="alert_box">
            <div class="col s12 m12">
                <div class="card green darken-1">
                   <div class="row">
                        <div class="col s12 m10">
                          <div class="card-content white-text">
                            <p>
							Vous pouvez donner via Dedipass, vous paierez ainsi avec votre forfait téléphonique, c'est donc un avantage important. D'un autre côté, vous serez déversé de moins de jetons qu'avec un payement paypal (qui sont beaucoup moins taxés).
                            </p>
                        </div>
                    </div>
                    <div class="col s12 m2">
                        <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			 <div class="card-content">
					<div data-dedipass="<?=$_Serveur_['Payement']['public_key'];?>" data-dedipass-custom=""></div>		
			</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
				</div>
			</div>
		</div>
	</div>
</div>