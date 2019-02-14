<?php $site_name = Configure::read('site_name'); ?>
Bonjour,<br>
<br>
Un message vous a été envoyé sur le site <?php echo $site_name;?>.<br>
<br>
<b>Détail du message :</b> <br>
<b>Envoyé par : </b> <?php echo $message['Message']['nom'] ; ?> <br/> 
<b>Adresse mail :</b> <?php echo $message['Message']['email'] ; ?> <br/>
<b>Contenu du message :</b><br>
Objet : <?php echo $message['Message']['objet'] ; ?><br/>
<?php echo $message['Message']['message'] ; ?>