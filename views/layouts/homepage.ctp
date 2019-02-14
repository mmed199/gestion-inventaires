<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	
	<head>
		<title><?php echo $title_for_layout; ?></title>
		<link rel="shortcut icon" href="/images/site/favicon.ico" type="image/x-icon">
	
		<?php echo $html->charset(); ?> 
		<?php echo $html->css('header2'); ?>
		<?php echo $html->css('main'); ?>
		<?php echo $html->css('produits'); ?>
		<?php echo $html->css('carrousel'); ?>
		
		
		<?php echo $html->script('scriptaculous/prototype');?>
		<?php echo $html->script('scriptaculous/scriptaculous');?>
		<?php echo $html->script('jquery'); ?>
		<?php echo $html->script('carrousel'); ?>
		
		
		<script language="Javascript">
		<!--
		function switchField(id, text) {
			if (id.value == text) {
				id.value = "";
			}
			else if (id.value=="") {
				id.value=text;
			}
		}
		-->
		</script>
	</head>
	
<body>
	<div class="bg_top">
		<div class="top">
			<a href="#">Qui sommes-nous</a> | 
			<?php echo $html->link('Contact', array('controller' => 'contacts', 'action' => 'index'));?> | 
			<a href="#">Devenir fan Facebook</a>
		</div>
	</div>
	<div class="bg_header">
	
		<div class="header">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td valign="top" width="230px">
							<a href="/"><img src="/images/site/sce3.jpg" alt="logo sce"/></a>
						</td>
						<td>
							<?php echo $this->element('moteur_recherche');?>
						</td>
						
						<td valign="top" width="360px">
							<?php echo $this->element('login');?>
						</td>
					</tr>
				</table>
				
				<div class="menu_principal">
					<ul>
						<li class="<?php if((isset($onglet_active) AND $onglet_active == 'violet') OR empty($onglet_active)) echo 'violet_active'; else echo 'violet';?>"><a href="/">Accueil</a></li>
						<li class="<?php if(isset($onglet_active) AND $onglet_active == 'vert') echo 'vert_active'; else echo 'vert';?>"><?php echo $html->link('Place de marché', array('plugin' => null, 'controller' => 'produits', 'action' => 'index'));?></li>
						<li class="<?php if(isset($onglet_active) AND $onglet_active == 'bleu') echo 'bleu_active'; else echo 'bleu';?>"><?php echo $html->link('Trouver son commerçant', array('plugin' => null, 'controller' => 'prestataires', 'action' => 'index'));?></li>
					</ul>
				</div>
			
		</div>
	</div>
	
	<?php 
	//recherche le sous-menu
	if(isset($menu_vert)) 
		echo $this->element('sous_menu/place_marche');
	elseif(isset($menu_bleu))
		echo $this->element('sous_menu/trouver_commercant');
	else
		echo $this->element('sous_menu/accueil');
	
	?>


	<?php //echo $session->flash('auth');?>
	<?php //echo $session->flash();?>
	<?php //echo $session->flash('email'); ?>
	<?php echo $content_for_layout; ?>

	
	
	<div class="bottom">
		<div class="bg_bottom">
			<?php echo $html->link('Mentions légales', array('controller' => 'pages', 'action' => 'mentions'));?>
		</div>
	</div>
	
</body>
	
<html>
