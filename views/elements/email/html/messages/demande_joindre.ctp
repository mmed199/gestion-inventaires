<?php $site_url = Configure::read('site_url');?>
Bonjour,<br>
<br>
Vous avez reçu un nouveau message sur le site.<br>
<br>
<b>Demande de rejoindre envoyé par :</b> <?php echo  $message['nom'] . ' ' . $message['prenom'];?> <br>
<b>Email :</b> <?php echo  $message['email'];?><br>
<b>Contenu :</b> <br>  
<?php echo $message['message'];?>
<br><br>
<br>

<?php if(!empty($message['document'] ) ) : ?> 
	Pièce-jointe au message :<br/> 
<a href="<?php echo $site_url;?>/uploads/messages/<?php echo $message['document'] ; ?>" > Télécharger </a>

<?php endif; ?>