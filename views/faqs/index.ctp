<?php $site_name = Configure::read('site_name');?>
<?php $this->set ('page_title',"Foire aux questions | ".$site_name);?>
<div class="article">
	<h1>Foire aux questionns</h1>
	<div class="article-contenu">
		<?php foreach($cfaqs as $f ) : ?>
			<div class="faq-g">
				<ul>
					<li><a href="/faq/<?php echo $f['Cfaq']['slug'];?>.html"><?php echo $f['Cfaq']['titre'];?></a></li>
				</ul>
			</div>
		<?php endforeach ; ?>
	</div>
</div>
<div class="clear"></div>