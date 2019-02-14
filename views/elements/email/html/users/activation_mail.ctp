<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
?>
<div style="width:800px;">
	<div style="display:block; width:600px; margin:30px auto; text-align:justify;">
		<p>Cher <?php echo $user['User']['nom'] ; ?>,</p>
		<p class="justify">C'est avec un grand plaisir que nous vous souhaitons la bienvenue sur l'application <?php echo $site_name;?>, c'est un outil qui dispose de nombreux avantages. </p>
		<p>Il permet d’apporter un meilleur service aux utilisateurs. Il accompagne toute la gestion d’un service en réduisant les tâches administratives. Il facilite la communication interne et l‘adoption d’un langage commun.
		</p>
		<br>
		<br>
		<p class="justify">
			Afin de confirmer votre inscription, veuillez cliquer sur le lien suivant :
			<br />
		<a href="<?php echo $site_url;?>/users/confirmer/<?php echo $user['User']['id'] ; ?>/<?php echo $user['User']['activation_code'] ; ?>" target="_blank" onclick="onClickUnsafeLink(event);"><?php echo $site_url;?>/users/confirmer/<?php echo $user['User']['id'] ; ?>/<?php echo $user['User']['activation_code'] ; ?></a>
		<br />
		Merci pour votre inscription<br /><br />
		<a href='<?php echo $site_url;?>'><?php echo $site_name;?></a>
</div>