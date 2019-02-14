<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
	$site_url_courte = Configure::read('site_url_courte');
?>
<div style="width:800px;">
	<div style="display:block; width:600px; margin:30px auto; text-align:justify;">
		<p>
			Bonjour,<br>
			<br>
			Un message vous a été envoyé sur le site <?php echo $site_name;?><br>	
			<b>Détail du message :</b> <br>
			<b>Envoyé par : </b> <?php echo $message['Message']['nom'] ; ?> <br/> 
			<b>Adresse mail :</b> <?php echo $message['Message']['email'] ; ?> <br/>
			<b>Contenu du message :</b><br>
			Objet : <?php echo $message['Message']['objet'] ; ?><br/>
			<?php echo $message['Message']['message'] ; ?>
			<br>
			<a href="<?php echo $site_url;?>"><?php echo $site_url_courte;?></a>
		</p>
	</div>
</div>