<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
?>
Bonjour <?php echo $abonne['Abonne']['nom'] ; ?>,<br>
  
Merci de votre intérêt pour notre newsletter.<br>
Validez votre demande d’inscription en cliquant sur le lien: <a href="<?php echo $site_url;?>/abonnes/activer/<?php echo $abonne['Abonne']['id'] ; ?>/<?php echo $abonne['Abonne']['activation_code'] ; ?>" >
   <?php echo $site_url;?>/abonnes/activer/<?php echo $abonne['Abonne']['id'] ; ?>/<?php echo $abonne['Abonne']['activation_code'] ; ?>
</a>
<br>
Merci. 

<br><br>
L'équipe <?php echo $site_name;?>
<hr>
Pour vous désinscrire, cliquez sur le lien : <a href="<?php echo $site_url;?>/abonnes/desinscription/<?php echo $abonne['Abonne']['id'] ; ?>/<?php echo $abonne['Abonne']['activation_code'] ; ?>" >
   <?php echo $site_url;?>/abonnes/desinscription/<?php echo $abonne['Abonne']['id'] ; ?>/<?php echo $abonne['Abonne']['activation_code'] ; ?>
</a>