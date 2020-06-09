<?php 
if($pages['titre'] == "" && $pageContenu[$j][0] == ""){ 
        header('Location: ?page=erreur&erreur=8000000');
    } ?>
<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
            <?php echo $pages['titre']; ?>
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section row">
    <?php for($j = 0; $j < count($pages['tableauPages']); $j++) { ?>
        <div class="col s12">
            <h3>
            <?php echo $pageContenu[$j][0]; ?>
            </h3>
    		<div><?php echo $pageContenu[$j][1]; ?></div>		
        </div>
    <?php } ?>
    </div>
</div>