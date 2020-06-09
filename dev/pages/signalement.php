<?php 

if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1))
{
	$req = $bddConnection->query('SELECT * FROM cmw_forum_report WHERE vu = 0');
	?>
<div class="header-page valign-wrapper">
	<div class="container no-pad-bot">
		<div class="row center">
			<h4 class="header col s12 white-text bold">
				Gestion des signalements
			</h4>
		</div>
	</div>
</div>
<div class="container bgcontainer" style="min-height: 250px;height: 100%;">
	<div class="section row">

		<div class="card">

			<div class="col s12">
			<div class="card-header">
				<h3 style="top: 5px;left: 5px;">Voici la liste des derniers signalements</h3>
			</div>


			<div class="card-content well">
			<table class="table table-striped">
				<tr>
					<th>Type de report</th>
					<th>Raison</th>
					<th>Reporteur</th>
					<th>Lien</th>
				</tr>
			<?php 
			while($data = $req->fetch(PDO::FETCH_ASSOC))
			{
				?><tr>
					<td>
					<?php if($data['type'] == 0)
					{
						echo 'Topic';
					}
					else
					{
						echo 'Réponse';
					}
					?></td>
					<td><?php echo $data['reason']; ?></td>
					<td><?php echo $data['reporteur']; ?></td>
					<td><?php 
					if($data['type'] == 0)
					{
						?><a href="index.php?action=r_t_vu&id=<?php echo $data['id_topic_answer']; ?>" class="btn green waves-effect">Voir le topic</a><?php
						
					}
					else
					{
						$req_topic = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
						$req_topic->execute(array(
							'id' => $data['id_topic_answer']
						));
						$id = $req_topic->fetch(PDO::FETCH_ASSOC);
						$req_page = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
						$req_page->execute(array(
							'id' => $id['id_topic']
						));
						$d_page = $req_page->fetchAll();
						foreach($d_page as $key => $value)
						{
							if($d_page[$key]['id'] == $data['id_topic_answer'])
							{
								$ligne = $key;
							}
						}
						$ligne++;
						$tour = 1;
						unset($d);
						unset($page);
						while($d != TRUE)
						{
							$nb = 20 * $tour;
							if($nb >= $ligne)
							{
								$page = $tour;
								$d = TRUE;
							}
							else
							{
								$tour++;
							}
						}
						?><a href="index.php?action=r_a_vu&id_a=<?php echo $data['id_topic_answer']; ?>&id=<?php echo $id['id_topic']; ?>&page_post=<?php echo $page; ?>" class="btn green waves-effect">Lien vers la réponse</a><?php
					}
					?></td>
				</tr><?php
			}
			?></table>
			</div>
			</div>

		</div>

	</div>
</div>
<?php 
}
else
	header('Location: index.php');
