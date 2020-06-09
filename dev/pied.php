<footer class="page-footer <?=$couleur;?>">
    <div class="container">
      <div class="row">
        <div class="col s12 center">
        <?php if(isset($_Theme_['All']['Ads']['client']) AND isset($_Theme_['All']['Ads']['slot']) AND $_Theme_['All']['Ads']['etat'] == "true"){ ?>
          <center>
          <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="<?=$_Theme_['All']['Ads']['client'];?>" data-ad-slot="<?=$_Theme_['All']['Ads']['slot'];?>"></ins>
          <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
          </center>
          <br/>
        <?php } ?>
          <?php if(isset($_Theme_['Pied']['discord']) AND $_Theme_['Pied']['discord'] != "#"){?>
              <a class="waves-effect waves-<?=$couleur;?> btn-flat btn-large btn-social wow pulse" wow-data-delay="0.5s" href="<?=$_Theme_['Pied']['discord'];?>" target="_blank"><i class="fab fa-discord"></i> Notre serveur Discord</a>
          <?php }if(isset($_Theme_['Pied']['facebook']) AND $_Theme_['Pied']['facebook'] != "#"){?>
              <a class="waves-effect waves-<?=$couleur;?> btn-flat btn-large btn-social wow pulse" wow-data-delay="1s" href="<?=$_Theme_['Pied']['facebook'];?>" target="_blank"><i class="fab fa-facebook-square"></i> Notre page Facebook</a>
          <?php }if(isset($_Theme_['Pied']['twitter']) AND $_Theme_['Pied']['twitter'] != "#"){?>              
              <a class="waves-effect waves-<?=$couleur;?> btn-flat btn-large btn-social wow pulse" wow-data-delay="1.5s" href="<?=$_Theme_['Pied']['twitter'];?>" target="_blank"><i class="fab fa-twitter"></i> Notre compte Twitter</a>
          <?php }if(isset($_Theme_['Pied']['youtube']) AND $_Theme_['Pied']['youtube'] != "#"){?>           
              <a class="waves-effect waves-<?=$couleur;?> btn-flat btn-large btn-social wow pulse" wow-data-delay="2s" href="<?=$_Theme_['Pied']['youtube'];?>" target="_blank"><i class="fab fa-youtube"></i> Notre chaine YouTube</a>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        &copy; <?=$_Serveur_['General']['name'];?> avec <a class="white-text text-darken-3" target="_blank" href="https://craftmywebsite.fr/">CraftMyWebsite.fr #<?php echo $versioncms; ?></a> et le theme <a class="white-text text-darken-3" href="https://theme-pour-votre.site/dl/material/craft" target="_blank">MaterialCraft</a>
      </div>
    </div>
  </footer>