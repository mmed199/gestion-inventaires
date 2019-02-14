<?php 
$site_name = Configure::read('site_name');
$this->set('page_title',$article['Article']['title']." ~ " . $site_name ) ;
?>
<!-- Breadcrumb -->
<div class="breadcrumb">
<div class="breadcrumb_inset">
	<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
	<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page"><?php echo $article['Article']['title'] ; ?></span>
	</div>
</div>
<!-- /Breadcrumb -->
<h1>
	<span><?php echo $article['Article']['title'] ; ?></span>
</h1>
<div class="row-fluid">	
	<?php if($article['Article']['id'] == 44){ ?>
		<div class="alert alert-info">
			<p>
				Si vous êtes un professionnel et que vous souhaitez créer un partenariat avec Services4all, écrivez-nous à : <a href="mailto:contact@services4all.fr">contact@services4all.ma</a>.
			</p>
		</div>
		<h2>Liste de nos partenaire : </h2>
		<hr>
	<?php }; ?>
	<?php echo $article['Article']['content'] ; ?>
</div>