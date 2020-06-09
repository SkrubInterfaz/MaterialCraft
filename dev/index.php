<?php
require('theme/'. $_Serveur_['General']['theme'] . '/preload.php');
require('include/version.php');
require('theme/'. $_Serveur_['General']['theme'] . '/config/configTheme.php');
?>
<!DOCTYPE html>
<html class="no-js" lang="fr-FR">
<head>
    <meta name="author" content="CraftMyWebsite, MaterializeCSS, PinglsDzn">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?php if(isset($_GET['page'])){$nompage = ucfirst($_GET["page"]);}else{$nompage = $_Serveur_['General']['description'];}?>
    <title><?=$_Serveur_['General']['name'] ." - ". $nompage?></title>

    <meta name="description" content="<?=$_Theme_["All"]["Seo"]["description"];?>">
    <meta name="keywords" content="MaterialCraft, <?=$_Serveur_['General']['name'];?>, serveur minecraft">
    <meta name="theme-color" content="#<?=$_Theme_["All"]["Seo"]["color"];?>">
    <meta name="msapplication-navbutton-color" content="#<?=$_Theme_["All"]["Seo"]["color"];?>">
    <meta name="apple-mobile-web-app-statut-bar-style" content="#<?=$_Theme_["All"]["Seo"]["color"];?>">
    <meta name="apple-mobile-web-app-capable" content="#<?=$_Theme_["All"]["Seo"]["color"];?>">
    <meta property="og:title" content="<?=$_Theme_["All"]["Seo"]["name"];?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?=$_Theme_["All"]["Seo"]["description"];?>">
    <meta property="og:image" content="<?=$_Theme_["All"]["Seo"]["image"];?>">
    <meta property="og:url" content="<?=$_Serveur_['General']['url'];?>">

    <?php
    if(isset($_Theme_['All']['Seo']['google'])){
        echo '<meta name="google-site-verification" content="'.$_Theme_["All"]['Seo']['google'].'" />';
    }
    if(isset($_Theme_['All']['Seo']['bing'])){
        echo '<meta name="msvalidate.01" content="'.$_Theme_["All"]['Seo']['bing'].'" />';
    }
    if($_Theme_['All']['Analytics']['etat'] == "true" AND isset($_Theme_['All']['Analytics']['id'])){ ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$_Theme_['All']['Seo']['GA'];?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?=$_Theme_['All']['Analytics']['id'];?>');
    </script>
    <?php
    }
    if($_Theme_['All']['Ads']['etat'] == "true"){
        echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
    }
    ?>


    <?php
    if(file_exists('favicon.ico')){
        echo '<link rel="icon" type="image/x-icon" href="favicon.ico">';
    }elseif(file_exists('fav.ico')){
        echo '<link rel="icon" type="image/x-icon" href="fav.ico">';
    }elseif(file_exists('favicon.png')){
        echo '<link rel="icon" type="image/png" href="favicon.png">';
    }else{
        echo '<link rel="icon" type="image/png" href="'. $_Theme_['All']['Seo']['image'].'">';
    }
    ?>

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="<?=$_Serveur_['General']['url'];?>">
    <meta name="twitter:title" content="<?=$_Theme_["All"]["Seo"]["name"];?>">
    <meta name="twitter:description" content="<?=$_Theme_["All"]["Seo"]["description"];?>">
    <meta name="twitter:image" content="<?=$_Theme_["All"]["Seo"]["image"];?>">

    <link href="https://use.fontawesome.com/releases/v5.0.2/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
            "background": "#<?php echo $_Theme_['cookies']['bg'];?>"
            },
            "button": {
            "background": "#<?=$codecouleur?>"
            }
        },
        "position": "bottom-left",
        "content": {
            "message": "<?php echo $_Theme_['cookies']['message'];?>",
            "dismiss": "Ok",
            "link": "En savoir plus"
        }
    })});
    </script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/materialize.css" type="text/css" rel="stylesheet"/>
    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/animate.css" type="text/css" rel="stylesheet">
    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/custom.css" type="text/css" rel="stylesheet"/>
    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/forum.css" type="text/css" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/snarl/0.3.4/snarl.min.css" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css" crossorigin="anonymous"/>

    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/form.js"></script>
    <style>
 .textwrite{
  font-family: Roboto, sans-serif, Arial;
  font-weight: bold;
  text-decoration: underline #<?=$codecouleur;?>;
  text-shadow: 1px 1px 2px #000;
}
.actionnews{
  color: #<?=$codecouleur;?> !important;
}
    </style>
</head>

<body>
	<?php if(isset($_Joueur_)) { ?>
		<?php setcookie('pseudo', $_Joueur_['pseudo'], time() + 86400, null, null, false, true); ?>
		<?php }
			include('theme/' .$_Serveur_['General']['theme']. '/entete.php');
			 tempMess(); ?>
		<?php
		include("./include/version.php");
        include("./include/version_distant.php");
        if($versioncms != $versioncmsrelease && ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['update']['showPage'] == 'on')) {?>
        <div class="row" id="alert_box">
            <div class="col s12 m12">
                <div class="card red darken-1">
                   <div class="row">
                        <div class="col s12 m10">
                          <div class="card-content white-text">
                            <p>
                                Une mise à jour du CMS est disponible <a href="https://craftmywebsite.fr/telecharger" target="_blank" class="btn white-text"><?= $versioncmsrelease?></a>
                            </p>
                        </div>
                    </div>
                    <div class="col s12 m2">
                        <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        <style>
        .icon_style{
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 20px;
        color: white;
        cursor:pointer;
        }
        </style><script>
        $('#alert_close').click(function(){
            $( "#alert_box" ).fadeOut( "slow", function() {
            });
        });
        </script>
        <?php }
		$check_installation_dossier = "installation";
		if (is_dir($check_installation_dossier)) {
        ?>
        <div class="container row" id="alert_box">
            <div class="col s12 m12">
                <div class="card red darken-1">
                   <div class="row">
                        <div class="col s12 m10">
                          <div class="card-content white-text">
                            <p>
                                Vous devez absolument supprimer le dossier 'installation/' de votre site !
                            </p>
                            <a href="index.php" class="btn waves-effect">Refaire une vérification</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } else { include('controleur/page.php'); }
include('theme/' .$_Serveur_['General']['theme']. '/pied.php'); ?>
<?php include('theme/' .$_Serveur_['General']['theme']. '/formulaires.php');
?>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="theme/<?=$_Serveur_['General']['theme'];?>/js/materialize.js"></script>
  <script src="theme/<?=$_Serveur_['General']['theme'];?>/js/init.js"></script>
  <script src="theme/<?=$_Serveur_['General']['theme'];?>/js/typed.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="theme/<?=$_Serveur_['General']['theme'];?>/js/custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/snarl/0.3.4/snarl.min.js"></script>
  <script src="theme/<?=$_Serveur_['General']['theme'];?>/js/messagerie.js"></script>
<?php if($_Serveur_['Payement']['dedipass'] == true) {
        echo '<script src="//api.dedipass.com/v1/pay.js"></script>';
}
include('theme/'.$_Serveur_['General']['theme'].'/js/forum.php');
?>
  <script defer src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/zxcvbn.js"></script>
  <script src="theme/<?=$_Serveur_['General']['theme'];?>/plugins/password.js"></script>
  <script src="theme/<?=$_Serveur_['General']['theme'];?>/js/editeur.js"></script>
<script>
$("#textwrite").typed({
    strings: [
    <?php for($i = 1; $i < count($_Theme_['Acceuil']['textdefilant']) + 1; $i++)
        {  ?>
            "<?php echo $_Theme_['Acceuil']['textdefilant'][$i]; ?>",
        <?php }?>
    ],
    startDelay: 500,
		typeSpeed: 100,
		backDelay: 2000,
		loop: true
});
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);

    var dropdownforum = document.querySelectorAll('.dropdown-trigger-forum');
    var dropdownforumOptions = {
        'closeOnClick': false,
        'constrainWidth': false,
        'alignment': 'right'
    }
    var instances = M.Dropdown.init(dropdownforum, dropdownforumOptions);
});
function navbarfixed(x) {
  if (x.matches) {
    if ($("#navbarfixedjs").hasClass("navbar-fixed")){
            $("#navbarfixedjs").removeClass("navbar-fixed");
        }
    }
    else{
    if ($("#navbarfixedjs").hasClass("navbar-fixed")){
    }
    else{
        $("#navbarfixedjs").addClass("navbar-fixed");
    }
  }
}

var x = window.matchMedia("(max-width: 989px)")
navbarfixed(x)
x.addListener(navbarfixed)
</script>
<?php
include('theme/'. $_Serveur_['General']['theme'] .'/js/notif.php');
include('theme/'. $_Serveur_['General']['theme'] .'/plugins/notifications.php');
?>
    </body>
</html>
