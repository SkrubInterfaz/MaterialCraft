<div id="connexion" class="modal">
    <div class="modal-content">
        <h4 class="center-align">Connexion</h4>
        <div class="row">
            <div class="col s12">
                <form role="form" method="post" action="?&action=connection">
                    <div class="row">
                        <?php if(isset($_COOKIE['pseudo'])) 
                            echo '<div class="input-field col s12 center">
                                    <center><img style="border-radius: 9px;" class="center" src="https://cravatar.eu/avatar/'.$_COOKIE['pseudo'].'/128" alt="Cookie de connexion illisible" /></center>
                                </div>';
                            ?>
                        <div class="input-field col s12">
                            <input id="pseudo-login" name="pseudo" type="text" class="validate" autocomplete="username" required>
                            <label for="pseudo-login">Pseudo</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="motdepasse-login" name="mdp" type="password" class="validate" autocomplete="current-password" required>
                            <label for="motdepasse-login">Mot de passe</label>
                            <a href="#passRecover" class="modal-trigger">Mot de passe oublié ?</a>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-light red btn-flat">Annuler</a>
        <button type="submit" class="waves-effect waves-light green btn-flat">Connexion</button>
    </div>
    <div class="col s12 m2">
        <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
    </div>
 </form>
</div>

<div class="modal" id="passRecover">
    <form role="form" method="post" action="?&action=passRecover">
        <div class="modal-content">
            <h4 class="center-align">Mot de passe oublié</h4>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <p class="center">Merci d'indiquer votre email utilisé à l'inscription, vous recevrez un lien
                            pour recevoir un mot de passe temporaire.</p>
                        <div class="input-field col s12">
                            <input id="passrecoveremail" name="email" type="email" class="validate"
                                autocomplete="username" required>
                            <label for="passrecoveremail">Adresse Email</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light red btn-flat">Annuler</a>
            <button type="submit" class="waves-effect waves-light green btn-flat">Connexion</button>
        </div>
        <div class="col s12 m2">
            <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
        </div>
    </form>
</div>
<!-- < Connexion > 
     < Inscription > -->
<div class="modal modal-lg" id="inscription">
    <form role="form" method="post" action="?&action=inscription">
        <div class="modal-content">
            <h4 class="center-align">Inscription</h4>

            <div class="row">
                
                <div class="input-field col s12">
                    <input id="inscription-pseudo" name="pseudo" type="text" class="validate" autocomplete="username" required>
                    <label for="inscription-pseudo">Votre pseudo</label>
                </div>

                <div class="input-field col s12">
                    <input id="inscription-email" placeholder="Ex: martin.dupon@hotmail.com" name="email" type="email" class="validate" autocomplete="email" required>
                    <label for="inscription-email">Adresse email</label>
                </div>

                <div class="input-field col s6">
                    <input id="MdpInscriptionForm" name="mdp" onKeyUp="securPass();" type="password" class="validate" autocomplete="current-password" required>
                    <label for="MdpInscriptionForm">Mot de passe</label>
                </div>

                <div class="input-field col s6">
                    <input id="MdpConfirmInscriptionForm" name="mdpConfirm" onKeyUp="securPass();" type="password" class="validate" autocomplete="off" required>
                    <label for="MdpConfirmInscriptionForm">Confirmer votre mot de passe</label>
                    <span class="helper-text" id="correspondancecouleur"><p id="correspondance"></p></span>
                </div>

                <div class="input-field col s12">
                    <div class="progress" id="progress">
                        <div class="determinate progressbar" id="progressbar" style="width: 70%"></div>
                    </div>
                </div>

                <div class="input-filed col s6">
                    <label for="inscription-age">Âge</label>
                    <input type="number" name="age" id="inscription-age" value="1" min="1" max="135" autocomplete="off">
                </div>

                <div class="col s6">
                </div>

                <div class="input-filed">
                    <div class="col s6">
                        <label>Captcha:</label>
                        <input type='text' name='CAPTCHA' placeholder='captcha' class="form-control"/>
                    </div>
                    <div class="col s6">
                        <img id='captcha' src='include/purecaptcha/purecaptcha_img.php?t=login_form' style="width: 100%;height: 100px;"/>
                        <br/>
                        <button type="button" onclick='var t=document.getElementById("captcha"); t.src=t.src+"&amp;"+Math.random();' class="btn btn-info"><i class="fa fa-refresh"></i> Recharger le captcha</button>
                        <br/>
                    </div>
                </div>
                        
                <div class="input-field col s6 m6">
                    <label for="show_email">
                        <input type="checkbox" id="show_email" name="show_email" class="filled-in" checked value="true" />
                        <span>Afficher votre adresse email sur votre profil</span>
                    </label>
                </div>
                <div class="input-field col s6 m6">
                    <label for="newsletter">
                        <input type="checkbox" id="newsletter" name="newsletter" class="filled-in" checked disabled/>
                        <span>S'inscrire à la newsletter</span>
                    </label>
                </div>


            </div>

        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light red btn-flat">Annuler</a>
            <button type="submit" class="waves-effect waves-light green btn-flat" id="InscriptionBtn" disabled>S'inscrire</button>
        </div>

        <div class="col s12 m2">
            <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
        </div>

    </form>
</div>
        