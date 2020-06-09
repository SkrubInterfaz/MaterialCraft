<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
				Ban-list
			</h4>
		</div>
	</div>
</div>
	

<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section">

<?php if(count($jsonCon) > 0) {
			require('modele/app/chat.class.php');
			$Chat = new Chat($jsonCon);?>
			<ul class="tabs z-depth-1">
			<?php for($i = 0; $i < count($jsonCon); $i++) {?>
				<li class="tab">
					<a href="#serv_<?= $i ?>" class="<?php if($i == 0) echo 'active'; ?>"><?php echo $lecture['Json'][$i]['nom']; ?></a>
				</li>
			<?php }?>
			</ul>
			
<?php for($i=0; $i < count($jsonCon); $i++) {
?>
				<div id="serv_<?=$i?>">
					<table class="table-responsive table-bordered">
						<tr>
							<th>Pseudo</th>
							<th>Date</th>
							<th>Source</th>
							<th>Durée</th>
							<th>Raison</th>
						</tr>
                
                <?php 
						foreach($banlist[$i] as $element) {?>
                
                        <tr>
							<td title="<?= $element->uuid?>"><?= $element->name?></td>
							<td><?= $element->created ?></td>
							<td><?= $Chat->formattage($element->source); ?></td>
							<td><?= $element->expires ?></td>
							<td><?= $element->reason ?></td>
                
                        </tr>
						<?php }?>
                
                    </table>
                </div>
                
				<?php }?>
        <?php }else{ ?>
            <div class="row">
                <div class="col s12 m12">
                <div class="card red darken-3">
                    <div class="card-content white-text">
                    <span class="card-title">Erreur</span>
                    <p>Aucun serveur n'a été relié au site web ! Veulliez contacter l'administrateur du site web</p>
                    </div>
                </div>
                </div>
            </div>
        <?php
            }?>
    </div>
</div>