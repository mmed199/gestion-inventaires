<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
?>
<div style="width:800px;">
	<div style="display:block; width:600px; margin:30px auto; text-align:justify;">
		<p>Cher membre,</p>
		<p class="justify">C'est avec un grand plaisir que nous vous souhaitons la bienvenue sur <?php echo $site_name;?>, le portail spécialisé des offres et services professionnels ou particuliers en ligne!
		</p>
		<br>					
		<p class="justify">Etant désormais notre client, vous pouvez profiter de tous les services offerts par le site, vous pouvez publier une demande ou un projet gratuitemant.
		</p>
		<br>
		<p class="justify" style="padding-left:20px;">
			- Demande des services de votre besion en ligne.
			<br><br>
			- Obtenez des offres de nos clients en quelques minutes.
			<br><br>
			- Consultez les profils et commentaires de nos clients, et commencez à discuter avec eux !
			<br><br>
			- Informez et Parrainez vos amis via notre système de parrainage
		</p>
		Essayez-le dès aujourd'hui !  
		<p><br>
					<p class="justify">
				
		Afin de confirmer votre inscription, veuillez cliquer sur le lien suivant :<br />
		<a href="<?php echo $site_url;?>/members/confirmer/<?php echo $member['Member']['id'] ; ?>/<?php echo $member['Member']['activation_code'] ; ?>" target="_blank" onclick="onClickUnsafeLink(event);"><?php echo $site_url;?>/members/confirmer/<?php echo $member['Member']['id'] ; ?>/<?php echo $member['Member']['activation_code'] ; ?></a>
		<br />
		Merci pour votre inscription<br /><br />
		<a href='<?php echo $site_url;?>'><?php echo $site_name;?></a>
</div>