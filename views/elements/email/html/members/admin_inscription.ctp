<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
	$site_url_courte = Configure::read('site_url_courte');
?>
<div style="width:800px;">
	<div style="display:block; width:600px; margin:30px auto; text-align:justify;">
		<p>Bonjour,</p>
		<p>Une nouvelle inscription sur le site.</p>
		<br><br>
		<b>Copie du message envoyé au membre :</b>
		<p>Cher membre,</p>
		<p class="justify">C'est avec un grand plaisir que nous vous souhaitons la bienvenue sur <?php echo $site_url_courte;?>, le site de référence de la vente de Bijoux en ligne !
		</p>
		<br>					
		<p class="justify">Etant désormais notre client, vous pouvez profiter de tous les services offerts par le site :
		</p>
		<br>
		<p class="justify" style="padding-left:20px;">
			- Services4all Bijoux vous propose près de 1000 bijoux, bagues, bracelets, colliers...
			<br><br>
			- Bénéficiez des promotions envoyés à nos clients
			<br><br>
			- Parrainez vos amis et gagnez des bons d'achat via notre système de parrainage
		</p>
		
		<p><br>
	Vos identifiants sont les suivants :<br>
	Email : <b><?php echo $member['Member']['email'];?></b><br>
	Pseudo : <b><?php echo $member['Member']['pseudo'];?></b><br>
	<?php if (isset ($this->data['Member']['password'])) :?>
	<!--Mot de passe : <b><?php echo $this->data['Member']['password'];?></b><br>-->
	<?php endif; ?>
<br>
Dès aujourd'hui, bénéficiez pour votre 1ère commande de <b>5 euros offerts</b>, à partir de 40 euros d'achat, avec le code avantage : <b>KDNEW1</b>, valable 1 mois. Profitez-en vite !
<br><br>
Et, régulièrement, vous découvrirez dans notre newsletter, nos nouveautés et l'actualité des marques...
<br><br>
Bon shopping !
<br><br>
A très vite,
<br><br>
L'équipe <?php echo $site_name;?>
<br>
<a href="<?php echo $site_url;?>"><?php echo $site_url_courte;?></a>
</div>