<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
?>

Bonjour <?php echo $abonne['Abonne']['nom'] ; ?>,<br/>
  
Nous vous remercions de votre inscription à notre newsletter. Nous ne manquerons pas de vous tenir informé de nos opérations de promotion. 
<a href="<?php echo $site_url;?>"><?php echo $site_url;?></a>. <br>
<br>
A très bientôt sur <?php echo $site_name;?>! 

<br><br>
L'équipe <?php echo $site_name;?>
<hr>
Pour vous désinscrire, cliquez sur le lien : <a href="<?php echo $site_url;?>/abonnes/desinscription/<?php echo $abonne['Abonne']['id'] ; ?>/<?php echo $abonne['Abonne']['activation_code'] ; ?>" >
   <?php echo $site_url;?>/abonnes/desinscription/<?php echo $abonne['Abonne']['id'] ; ?>/<?php echo $abonne['Abonne']['activation_code'] ; ?>
</a>