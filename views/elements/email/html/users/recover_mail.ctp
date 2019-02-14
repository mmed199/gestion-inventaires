Bonjour <?php echo $user['User']['prenom'] ; ?>,<br/>
 <br/>
Vous avez demandé la réinitialisation de votre mot de passe. Pour finaliser votre demande, veuillez cliquer sur ce lien :<br/>
 <br/>
<a href="http://www.leflair.fr/users/vfRecoverLink/<?php echo $user['User']['id'] ; ?>/<?php echo $user['User']['recover_code'] ; ?>" >
http://www.leflair.fr/users/vfRecoverLink/<?php echo $user['User']['id'] ; ?>/<?php echo $user['User']['recover_code'] ; ?>
</a>
<br />
<br>
L'équipe Leflair<br />
<a href="http://www.leflair.fr">www.leflair.fr</a>

