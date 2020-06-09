<?php include('theme/'.$_Serveur_['General']['theme'].'/config/configTheme.php');
?>
<style>
    center {
        font-family: Verdana;
        font-size: 32px;
        font-weight: bold;
    }
    .customelement{
        font-weight: bold;
        font-size: 26px;
    }
</style>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/config/jscolor.js"></script>
<div class="col-xs-12">
    <div class="panel panel-default cmw-panel">
        <div class="panel-heading cmw-panel-header">
            <h3 class="panel-title"><strong>Configuration du thème</strong></h3>
        </div>
        <div class="panel-body container-fluid">
            <form method="POST" action="?&action=configTheme">

                <div>
                    <p class="text-center">
                        <div class="form-group">
                            <label for="exampleSelect1">Couleurs du théme
                                ('green','red','blue','pink','yellow','purple','indigo','cyan','teal','amber','orange','brown','gray')</label>
                            <select class="form-control" id="exampleSelect1" name="couleur">
                                <option value="green" <?php if($_Theme_['All']['couleur'] == "vert") echo 'selected'; ?>>vert</option>
                                <option value="red" <?php if($_Theme_['All']['couleur'] == "red") echo 'selected'; ?>>rouge</option>
                                <option value="blue" <?php if($_Theme_['All']['couleur'] == "blue") echo 'selected'; ?>>bleu</option>
                                <option value="pink" <?php if($_Theme_['All']['couleur'] == "pink") echo 'selected'; ?>>rose</option>
                                <option value="yellow" <?php if($_Theme_['All']['couleur'] == "yellow") echo 'selected'; ?>>jaune</option>
                                <option value="purple" <?php if($_Theme_['All']['couleur'] == "purple") echo 'selected'; ?>>purple</option>
                                <option value="indigo" <?php if($_Theme_['All']['couleur'] == "indigo") echo 'selected'; ?>>indigo</option>
                                <option value="cyan" <?php if($_Theme_['All']['couleur'] == "cyan") echo 'selected'; ?>>cyan</option>
                                <option value="teal" <?php if($_Theme_['All']['couleur'] == "teal") echo 'selected'; ?>>turquoise</option>
                                <option value="amber" <?php if($_Theme_['All']['couleur'] == "amber") echo 'selected'; ?>>amber</option>
                                <option value="orange" <?php if($_Theme_['All']['couleur'] == "orange") echo 'selected'; ?>>orange</option>
                                <option value="brown" <?php if($_Theme_['All']['couleur'] == "brown") echo 'selected'; ?>>brown</option>
                                <option value="gray" <?php if($_Theme_['All']['couleur'] == "gray") echo 'selected'; ?> disabled>gray</option>
                            </select>
                        </div>
                    </p>
                </div>

                <div class="container-fluid">
                
                <div class="panel panel-default cmw-panel">
                    
                    <a role="button" data-toggle="collapse" href="#Header" aria-exepanded="false">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title">Header</h3>
                        </div>
                    </a>
                    <div class="collapse" id="Header">
                        <div class="panel-body">
                            <div class="container-fluid">

                                <div class="row">
                                    <label class="control-label">Google (Token de Validation)</label>
                                    <input type="text" class="form-control" name="google"
                                        value="<?php echo $_Theme_['All']['Seo']['google']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Bing / Yahoo (Token de Validation)</label>
                                    <input type="text" class="form-control" name="bing"
                                        value="<?php echo $_Theme_['All']['Seo']['bing']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label customelement">Calcul de l'audiance (Google
                                        Analytics)</label>
                                    <div class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="analyticsetat"
                                                class="custom-control-input" value="false"
                                                <?php if($_Theme_['All']['Analytics']['etat'] != "true") { echo ' checked=""'; }?>>
                                            <label class="custom-control-label" for="customRadio1">Désactivé</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="analyticsetat"
                                                class="custom-control-input" value="true"
                                                <?php if($_Theme_['All']['Analytics']['etat'] == "true") { echo ' checked=""'; }?>>
                                            <label class="custom-control-label" for="customRadio2">Activé</label>
                                        </div>
                                    </div>
                                    <label class="control-label">ID du site (gtag.js)</label>
                                    <input type="text" class="form-control" name="analytics"
                                        value="<?php echo $_Theme_['All']['Analytics']['id']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label customelement">Publicité (AdSense)</label>
                                    <div class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="etat"
                                                class="custom-control-input" value="false"
                                                <?php if($_Theme_['All']['Ads']['etat'] != "true") { echo ' checked=""'; }?>>
                                            <label class="custom-control-label" for="customRadio1">Désactivé</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="etat"
                                                class="custom-control-input" value="true"
                                                <?php if($_Theme_['All']['Ads']['etat'] == "true") { echo ' checked=""'; }?>>
                                            <label class="custom-control-label" for="customRadio2">Activé</label>
                                        </div>
                                    </div>
                                    <label class="control-label">ID de l'Editeur (AdSense)</label>
                                    <input type="text" class="form-control" name="client"
                                        value="<?php echo $_Theme_['All']['Ads']['client']; ?>">
                                    <label class="control-label">ID du bloc d'annonce (AdSense)</label>
                                    <input type="text" class="form-control" name="slot"
                                        value="<?php echo $_Theme_['All']['Ads']['slot']; ?>">
                                </div>

                            </div>
                        </div>
                    </div>
                
                </div>
                
                <br/>

                <div class="panel panel-default cmw-panel">
                    
                    <a role="button" data-toggle="collapse" href="#cc" aria-exepanded="false">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title">Cookies consent</h3>
                        </div>
                    </a>
                    <div class="collapse" id="cc">
                        <div class="panel-body">
                            <div class="container-fluid">

                                <div class="row">
                                    <label class="control-label">Couleur de fond:</label>
                                    <input type="text" class="form-control jscolor" name="cookie_color"
                                        value="<?php echo $_Theme_['cookies']['bg']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Message de consentement:</label>
                                    <input type="text" class="form-control" name="cookie_message"
                                        value="<?php echo $_Theme_['cookies']['message']; ?>">
                                </div>

                            </div>
                        </div>
                    </div>
                
                </div>

                <br />

                <div class="panel panel-default cmw-panel">

                    <a role="button" data-toggle="collapse" href="#sn" aria-exepanded="false">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title">Social Networks</h3>
                        </div>
                    </a>
                    <div class="collapse" id="sn">
                        <div class="panel-body">
                            <div class="container-fluid">

                                <div class="row">
                                    <label class="control-label">Facebook (URL de votre page Facebook)</label>
                                    <input type="text" class="form-control" name="facebook"
                                        value="<?php echo $_Theme_['Pied']['facebook']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Twitter (URL de votre compte Twitter)</label>
                                    <input type="text" class="form-control" name="twitter"
                                        value="<?php echo $_Theme_['Pied']['twitter']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Youtube (URL de votre page Youtube)</label>
                                    <input type="text" class="form-control" name="youtube"
                                        value="<?php echo $_Theme_['Pied']['youtube']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Discord (URL de votre serveur Discord)</label>
                                    <input type="text" class="form-control" name="discord"
                                        value="<?php echo $_Theme_['Pied']['discord']; ?>">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <br/>

                <div class="panel panel-default cmw-panel">
                    
                    <a role="button" data-toggle="collapse" href="#hs" aria-exepanded="false">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title">Home settings</h3>
                        </div>
                    </a>
                    <div class="collapse" id="hs">
                        <div class="panel-body">
                            <div class="container-fluid">

                                <div class="panel border-1">

                                    <div class="row">

                                        <label class="control-label">Navigation 1</label>
                                        <input type="text" class="form-control" name="1img"
                                            value="<?php echo $_Theme_['Acceuil']['navslide']['1']['image']; ?>">
                                        <input type="text" class="form-control" name="1txt"
                                            value="<?php echo $_Theme_['Acceuil']['navslide']['1']['description'];  ?>">

                                        <label class="control-label">Navigation 2</label>
                                        <input type="text" class="form-control" name="2img"
                                            value="<?php echo $_Theme_['Acceuil']['navslide']['2']['image']; ?>">
                                        <input type="text" class="form-control" name="2txt"
                                            value="<?php echo $_Theme_['Acceuil']['navslide']['2']['description'];  ?>">

                                        <label class="control-label">Navigation 3</label>
                                        <input type="text" class="form-control" name="3img"
                                            value="<?php echo $_Theme_['Acceuil']['navslide']['3']['image']; ?>">
                                        <input type="text" class="form-control" name="3txt"
                                            value="<?php echo $_Theme_['Acceuil']['navslide']['3']['description'];  ?>">

                                    </div>

                                </div>

                                <div class="panel border-1">

                                    <div class="row">

                                        <div class="form-group">
                                            <label class="control-label customelement">Parallax (Images de fond sur
                                                l'Acceuil)</label>
                                            <input type="text" class="form-control" name="parallax1" value="<?php echo $_Theme_['Acceuil']['parallax']['1']; ?>">
                                            <input type="text" class="form-control" name="parallax2" value="<?php echo $_Theme_['Acceuil']['parallax']['2']; ?>">
                                            <input type="text" class="form-control" name="parallax3" value="<?php echo $_Theme_['Acceuil']['parallax']['3']; ?>">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group">
                                            <label class="control-label customelement">Textes défillants</label>

                                            <input type="text" class="form-control" name="txtd1" value="<?php echo $_Theme_['Acceuil']['textdefilant']['1']; ?>">
                                            <input type="text" class="form-control" name="txtd2" value="<?php echo $_Theme_['Acceuil']['textdefilant']['2']; ?>">
                                            <input type="text" class="form-control" name="txtd3" value="<?php echo $_Theme_['Acceuil']['textdefilant']['3']; ?>">
                                            <input type="text" class="form-control" name="txtd4" value="<?php echo $_Theme_['Acceuil']['textdefilant']['4']; ?>">
                                            
                                            
                                        </div>

                                    </div>
                                
                                </div>

                            </div>
                        </div>
                    </div>
                
                </div>

                <br/>

                <div class="panel panel-default cmw-panel">
                    
                    <a role="button" data-toggle="collapse" href="#ogs" aria-exepanded="false">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title">Open Graph Settings</h3>
                        </div>
                    </a>
                    <div class="collapse" id="ogs">
                        <div class="panel-body" style="background-color: #32363C;">
                            <div class="container-fluid">

                                <div class="row">
                                    <input type="text" class="form-control" name="seoname"
                                        value="<?php echo $_Theme_['All']['Seo']['name']; ?>"
                                        style="border: none !important;background-color: rgba(255, 255, 255, 0);color: #0993CF;">
                                    <br />
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="seodescription"
                                            value="<?php echo $_Theme_['All']['Seo']['description']; ?>"
                                            style="border: none !important;background-color: rgba(255, 255, 255, 0);color: #ABADAF;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="<?php echo $_Theme_['All']['Seo']['image']; ?>"
                                            style="max-width: 82px;">
                                        <br />
                                        <input type="text" class="form-control-file" name="seoimage"
                                            value="<?php echo $_Theme_['All']['Seo']['image']; ?>"
                                            style="border: none !important;background-color: rgba(255, 255, 255, 0);color: #f4f4f4;">
                                    </div>
                                </div>

                            </div>
                            <input name="seocolor" class="jscolor w-100" value="<?php echo $_Theme_['All']['Seo']['color']; ?>" style="width: 100%">
                        </div>
                    </div>
                
                </div>






                </div>

                <div class="form-group text-center">
                    <input type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>