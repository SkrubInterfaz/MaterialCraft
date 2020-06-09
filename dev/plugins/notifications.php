<?php if(isset($_GET["ActivateSuccess"]) && urldecode($_GET['ActivateSuccess'])){ ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotif fa-check-circle" aria-hidden="true"></i> Votre compte vient d\'être activé avec succès.',
			});
		}
	</script>
<?php } elseif(isset($_GET["WaitActivate"]) && urldecode($_GET['WaitActivate'])) { ?>
	<script>
		window.onload=function(){
			M.addNotification({
				html: '<i class="fa fanotif fa-info-circle" aria-hidden="true"></i> Un mail vient de vous être envoyé pour l\'activation de votre compte. Vérifiez dans les Courriers indésirables.',
			});
		}
	</script>
<?php } elseif(isset($_GET["ActivateImpossible"]) && urldecode($_GET['ActivateImpossible'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotif fa-times-circle" aria-hidden="true"></i> Votre compte ne peut être activé.',
			});
		}
	</script>
<?php } elseif(isset($_GET["MessageEnvoyer"]) && urldecode($_GET['MessageEnvoyer'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotiffa-comment"></i> Votre commentaire vient d\'être envoyé.',
			});
		}
	</script>
<?php } elseif(isset($_GET["MessageTropLong"]) && urldecode($_GET['MessageTropLong'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Votre commentaire est trop long.',
			});
		}
	</script>
<?php } elseif(isset($_GET["MessageTropCourt"]) && urldecode($_GET['MessageTropCourt'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Votre commentaire est trop court.',
			});
		}
	</script>
<?php } elseif(isset($_GET["NotOnline"]) && urldecode($_GET['NotOnline'])) { ?>
	<script>
		window.onload=function(){
			    M.toast({
			    html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Vous n\'êtes pas connecté.',
			});
		}
    </script> 
<?php } elseif(isset($_GET["NewsNotExist"]) && urldecode($_GET['NewsNotExist'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
			    html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Cette nouveauté n\'existe pas.',
		    });
	    }
    </script>
<?php } elseif(isset($_GET["TicketNotExist"]) && urldecode($_GET['TicketNotExist'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
			    html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Ce ticket n\'existe pas.',
		    });
	    }
    </script>
<?php } elseif(isset($_GET["CommentaireNotExist"]) && urldecode($_GET['CommentaireNotExist'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
			    html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Ce commentaire n\'existe pas.',
		    });
	    }
    </script> 
<?php } elseif(isset($_GET["LikeExist"]) && urldecode($_GET['LikeExist'])) { ?>
    <script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Votre mention j\'aime est déjà existante.',
			});
		}
	</script> 
<?php } elseif(isset($_GET["LikeAdd"]) && urldecode($_GET['LikeAdd'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Votre mention j\'aime vient d\'être envoyée.',
			});
		}
	</script>
<?php } elseif(isset($_GET["SuppressionCommentaire"]) && urldecode($_GET['SuppressionCommentaire'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotiffa-check-circle" aria-hidden="true"></i> Votre commentaire vient d\'être supprimé.',
			});
		};
	</script>
<?php } elseif(isset($_GET["SuppressionImpossible"]) && urldecode($_GET['SuppressionImpossible'])) { ?>
	<script>
		window.onload=function(){
			M.toast({
				html: '<i class="fa fanotiffa-times-circle" aria-hidden="true"></i> Le commentaire ne peut être supprimé.',
			});
		}
	</script>
<?php } ?>