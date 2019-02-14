<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
?>
Bonjour,<br/>
 <br/>
Vous avez demandé la réinitialisation de votre mot de passe <?php echo $site_name;?>. Pour finaliser votre demande, veuillez cliquer sur ce lien :<br/>
 <br/>
<a href="<?php echo $site_url;?>/members/vfRecoverLink/<?php echo $member['Member']['id'] ; ?>/<?php echo $member['Member']['recover_code'] ; ?>" >
<?php echo $site_url;?>/members/vfRecoverLink/<?php echo $member['Member']['id'] ; ?>/<?php echo $member['Member']['recover_code'] ; ?>
</a>
<br />
<br />
<br />
Cordialement,<br />
<br>
L'équipe <?php echo $site_name;?>.<br /> 
<a href="<?php echo $site_url;?>"><?php echo $site_name;?></a>