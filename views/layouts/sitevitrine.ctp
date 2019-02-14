<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	
	<head>
		
		<title><?php echo $title_for_layout; ?></title>
		<link rel="shortcut icon" href="/images/site/favicon.ico" type="image/x-icon">
	
		<?php echo $html->charset(); ?> 
		<?php echo $html->css('zoombox'); ?>
		<?php echo $html->css('jgrowl'); ?>
		
		<?php echo $html->script('jquery'); ?>
		<?php echo $html->script('zoombox'); ?>
		<?php echo $html->script('jquery.jgrowl'); ?>
		<?php echo $html->css('uniform'); ?>
		<?php echo $html->script('jquery.uniform'); ?>

		<?php //echo $html->script('ckeditor/ckeditor'); ?>
		<?php //echo $html->script('ckfinder/ckfinder'); ?>
		<?php 
		//la feuille css du minisite
		echo $scripts_for_layout;
		echo $this->element('sites/css');
		
		?>
		
	<script language="JavaScript">
	
	<!-- 	
		function switchField(id, text) {
			if (id.value == text) {
				id.value = "";
			}
			else if (id.value=="") {
				id.value=text;
			}
		}
		
		champ="";
		formulaire="";

		

	  $(function(){
		$("input[type=file]").uniform();
	  });


	-->
	</script>
	</head>
	
<body>
<div class="bg_top">
	<div class="top">
		Bonjour <?php echo $this->Session->read('Auth.User.username');?> <span>|</span> 
		<?php //echo '<a href="http://site.service-conseil-entreprise.fr/'.$info_site['Site']['nom_site'].'">'.$info_site['Site']['nom_site'].'</a>';
			echo $html->link($info_site['Site']['nom_site'], array('controller' => 'sites', 'action' => 'voir', $info_site['Site']['nom_site']), array('escape' => false));
		?> <span>|</span> 
		<?php echo $html->link('Administration', array('action' => 'home'));?>
	</div>
</div>

<div class="bg_header">

	<div class="header">
			<?php if(!empty($info_site['SiteCoordonnee']['societe'])) 
				//echo '<a href="http://site.service-conseil-entreprise.fr/'.$info_site['Site']['nom_site'].'"><h1 class="titre">'.$info_site['SiteCoordonnee']['societe'].' <span> '.$info_site['SiteCoordonnee']['code_postal'].' '.$info_site['SiteCoordonnee']['ville'].'</span></h1></a>';
				echo $html->link('<h1 class="titre">'.$info_site['SiteCoordonnee']['societe'].' <span> '.$info_site['SiteCoordonnee']['code_postal'].' '.$info_site['SiteCoordonnee']['ville'].'</span></h1>', array('controller' => 'sites', 'action' => 'voir', $info_site['Site']['nom_site']), array('escape' => false));
			?>
		<div class="bg_menu_principal">
			<div class="menu_principal">
				<ul class="nav">

					<li <?php if(isset($active) AND $active == 'home') echo 'class="hover"'; else echo 'class="normal"';?>><?php echo $html->link('Général', array('controller' => 'sites', 'action' => 'home'));?></li>
					<li <?php if(isset($active) AND $active == 'coordonnees') echo 'class="hover"'; else echo 'class="normal"';?>><?php echo $html->link('Coordonnées', array('controller' => 'sites', 'action' => 'coordonnees'));?></li>
					<li <?php if(isset($active) AND $active == 'horaires') echo 'class="hover"'; else echo 'class="normal"';?>><?php echo $html->link('Horaires', array('controller' => 'sites', 'action' => 'horaires'));?></li>
					<li <?php if(isset($active) AND $active == 'description') echo 'class="hover"'; else echo 'class="normal"';?>><?php echo $html->link('Produits & Service', array('controller' => 'sites', 'action' => 'description'));?></li>
					<li <?php if(isset($active)AND $active == 'contact') echo 'class="hover"'; else echo 'class="normal"';?>><?php echo $html->link('Contact', array('controller' => 'sites', 'action' => 'contact'));?></li>
					<li <?php if(isset($active)AND $active == 'partenaire') echo 'class="hover"'; else echo 'class="normal"';?>><?php echo $html->link('Partenaires', array('controller' => 'sites', 'action' => 'partenaires'));?></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<!--body-->
<div class="bg_body">
	<div class="body">
		
		<div class="contenu">
			<?php echo $session->flash();?>
			<?php echo $content_for_layout; ?>
		</div>
	</div>
</div>

<div class="bottom">
	<div class="bg_bottom">
		<a href="/">Service-conseil-entreprise.fr</a>
		
	</div>
</div>
</body>
	
<html>
