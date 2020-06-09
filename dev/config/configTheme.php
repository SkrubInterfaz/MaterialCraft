<?php 
$configTheme = new Lire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml');
$_Theme_ = $configTheme->GetTableau();
$theme = $configTheme->GetTableau();

if(!isset($_Theme_['All']['couleur'])){
    $_Theme_['All']['couleur'] = "teal";
}else{
    if(!in_array($_Theme_['All']['couleur'], array('green','red','blue','pink','yellow','purple','indigo','cyan','teal','amber','orange','brown' ))){
        $_Theme_['All']['couleur'] = "teal";
    }
}
$couleur = $_Theme_['All']['couleur'];
if($couleur == 'green'){
    $codecouleur = "4CAF50";
}
if($couleur == 'red'){
    $codecouleur = "e51c23";
}
if($couleur == 'blue'){
    $codecouleur = "2196F3";
}
if($couleur == 'pink'){
    $codecouleur = "e91e63";
}
if($couleur == 'yellow'){
    $codecouleur = "ffeb3b";
}
if($couleur == 'purple'){
    $codecouleur = "9c27b0";
}
if($couleur == 'indigo'){
    $codecouleur = "3f51b5";
}
if($couleur == 'cyan'){
    $codecouleur = "00bcd4";
}
if($couleur == 'teal'){
    $codecouleur = "009688";
}
if($couleur == 'amber'){
    $codecouleur = "ffc107";
}
if($couleur == 'orange'){
    $codecouleur = "ff9800";
}
if($couleur == 'brown'){
    $codecouleur = "795548";
}

?>