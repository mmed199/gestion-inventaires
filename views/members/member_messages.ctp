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
	<span><h6>Mes messages</h6></span>
</h1>
<div id="center_column" class="center_column span8 clearfix">
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_messages-recus" data-toggle="tab">Messages envoyés</a></li>
			<li><a href="#tab_messages-envoyes" data-toggle="tab">Messages reçus</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_messages-recus">
				<div class="row" style ="margin-left: 12px;">
					<?php if(!empty($messages_envoyes) ) : ?>
					<?php foreach ($messages_envoyes as $m) : ?>
						 <a class="pull-left" href="<?php echo $site_url ; ?>/messages/<?php echo $m['Message']['id'];?>.html" >
						      <i class="icon-envolppe">Objet de message</i>
						   </a>
					<?php endforeach ; ?>
					<?php else: ?>
					<p>Aucun message trouvé </p> 
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>