<?php
if(isset($_Joueur_))
{
	?><script>
setInterval(ajax_alerts, 10000);
function ajax_alerts(){
	var url = '?action=get_alerts';
	$.post(url, function(data){
		ajax_new_alerts();
	});
}
function ajax_new_alerts(){
	var url = '?action=new_alert';
	$.post(url, function(donnees){
		if(donnees > 0)
		{
			alertes.innerHTML = donnees;
			M.toast({
				html: 'Vous avez <span id="alertes"></span> nouvelles alertes !',
			});
		}
	 });
}
</script>
<?php
if($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1)
{
	?>
<script>
	setInterval(ajax_signalement, 10000);

	function ajax_signalement() {
		var url = '?action=get_signalement';
		$.post(url, function (signalement) {
			if (signalement > 0) {
				signalement.innerHTML = signalement;
				M.toast({
					html: 'Il y a <span class="signalement"></span> nouveaux signalements',
				});
			}
		});
	}
</script>
	<?php 
}
?>
<script>
$('document').ready(function() {

    var checked = [];

    $("input:checkbox[name=selection]").each(function() {
        $(this).click(function() {

            checked = $("input:checkbox[name=selection]:checked");

        })
    }); 

    $('#sel-form').submit(function() {
        var $form = $(this);
        checked.each(function() {
            $('<input>').attr({
                type: 'hidden',
                name: 'id[]',
                value: $(this).val()
            }).appendTo($form);
        });
    });

});
</script>
<?php 
if(isset($_GET['page']) && $_GET['page'] == "profil")
{
?>
<script>previewTopic($("#signature"));</script>
<?php
}
if(isset($_GET['setTemp']) && $_GET['setTemp'] == 1)
{
	?>
<script> 
M.toast({
	html: 'Votre nouveau mot de passe temporaire vous à été envoyé par mail (Verifier la boite "Spam")',
});
</script>
	<?php
}
if(isset($_GET['envoieMail']) && $_GET['envoieMail'] == true)
{
	?>
<script>
M.toast({
	html: 'Un mail de récupération a bien été envoyé !',
});
</script>
<?php
}
if(isset($_GET['send']))
{
	?>
<script>
M.toast({
	html: 'Votre message à bien été envoyé !',
})
</script><?php
}
if($_GET['page'] == "token" && $_GET['notif'] == "0")
{
	?>
<script>
M.toast({
	html: '<i class="fab fa-paypal"></i> Votre paiement a bien été effectué !',
})
</script>
<?php
}
if($_GET['page'] == "token" && $_GET['notif'] == "1")
{
	?>
<script>
M.toast({
	html: '<p class="red-text darken-3"><i class="fab fa-paypal"></i> Vous avez annuler votre paiement',
})
</script>
<?php }
}
?>
