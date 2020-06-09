<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme'] == true)
{
	//----------------------------------------------------------------------//
	$ecritureTheme['Pied']['facebook'] = htmlspecialchars($_POST['facebook']);
	$ecritureTheme['Pied']['twitter'] = htmlspecialchars($_POST['twitter']);
	$ecritureTheme['Pied']['youtube'] = htmlspecialchars($_POST['youtube']);
	$ecritureTheme['Pied']['discord'] = htmlspecialchars($_POST['discord']);
	$ecritureTheme['All']['Seo']['color'] = htmlspecialchars($_POST['seocolor']);
	$ecritureTheme['All']['Seo']['name'] = htmlspecialchars($_POST['seoname']);
	$ecritureTheme['All']['Seo']['description'] = htmlspecialchars($_POST['seodescription']);
	$ecritureTheme['All']['Seo']['image'] = htmlspecialchars($_POST['seoimage']);
	$ecritureTheme['All']['Seo']['google'] = htmlspecialchars($_POST['google']);
	$ecritureTheme['All']['Seo']['bing'] = htmlspecialchars($_POST['bing']);
	$ecritureTheme['All']['couleur'] = htmlspecialchars($_POST['couleur']);
	$ecritureTheme['All']['Ads']['etat'] = htmlspecialchars($_POST['etat']);
	$ecritureTheme['All']['Ads']['slot'] = htmlspecialchars($_POST['slot']);
	$ecritureTheme['All']['Ads']['client'] = htmlspecialchars($_POST['client']);
	$ecritureTheme['All']['Analytics']['etat'] = htmlspecialchars($_POST['analyticsetat']);
	$ecritureTheme['All']['Analytics']['id'] = htmlspecialchars($_POST['analytics']);
	$ecritureTheme['Acceuil']['parallax']['1'] = htmlspecialchars($_POST['parallax1']);
	$ecritureTheme['Acceuil']['parallax']['2'] = htmlspecialchars($_POST['parallax2']);
	$ecritureTheme['Acceuil']['parallax']['3'] = htmlspecialchars($_POST['parallax3']);
	$ecritureTheme['Acceuil']['navslide']['1']['image'] = htmlspecialchars($_POST['1img']);
	$ecritureTheme['Acceuil']['navslide']['1']['description'] = htmlspecialchars($_POST['1txt']);
	$ecritureTheme['Acceuil']['navslide']['2']['image'] = htmlspecialchars($_POST['2img']);
	$ecritureTheme['Acceuil']['navslide']['2']['description'] = htmlspecialchars($_POST['2txt']);
	$ecritureTheme['Acceuil']['navslide']['3']['image'] = htmlspecialchars($_POST['3img']);
	$ecritureTheme['Acceuil']['navslide']['3']['description'] = htmlspecialchars($_POST['3txt']);
	$ecritureTheme['Acceuil']['textdefilant']['1'] = htmlspecialchars($_POST['txtd1']);
	$ecritureTheme['Acceuil']['textdefilant']['2'] = htmlspecialchars($_POST['txtd2']);
	$ecritureTheme['Acceuil']['textdefilant']['3'] = htmlspecialchars($_POST['txtd3']);
	$ecritureTheme['Acceuil']['textdefilant']['4'] = htmlspecialchars($_POST['txtd4']);
	$ecritureTheme['cookies']['bg'] = htmlspecialchars($_POST['cookie_color']);
	$ecritureTheme['cookies']['message'] = htmlspecialchars($_POST['cookie_message']);
  	
	$ecriture = new Ecrire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml', $ecritureTheme);
}
?>
