<?php 
	$site_url = Configure::read('site_url');
 ?>
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" rel="tooltip" title="" href="/" data-original-title="retour à Accueil">
		<i class="icon-home"></i>
		</a>
		<span class="navigation-pipe">></span>
		<span class="navigation_page">Mon compte</span>
	</div>
</div>	
<br>	 
<!-- Menu member -->
<?php echo $this->element('members/nav-member') ; ?>
<!-- /Menu member -->
<?php echo $session->flash() ; ?>
<h1>
	<span><h6>Mes favoris</h6></span>
</h1>
<div id="center_column" class="center_column span8 clearfix">
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<div class="row" style ="margin-left: 12px;">
			<?php if(!empty($mes_favoris) ) : ?>
			<?php foreach ($mes_favoris as $f) : ?>
				<a class="pull-left" href="<?php echo $site_url ; ?>/favoris/<?php echo $f['MemberFavori']['id'];?>.html" >
			      <i class="icon-stare"></i>
			 	</a>
			<?php endforeach ; ?>
			<?php else: ?>
			<p>Aucun élément trouvé </p> 
			<?php endif; ?>
		</div>
	</div>
</div>