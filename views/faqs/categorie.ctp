<div class="article">
	<div class="article-contenu">
		<?php echo $this->element('liste_faqs') ; ?>
		<br>
		<div class="faq-d">
			<h2><?php echo $cat['Cfaq']['titre'];?></h2>
			<br>
			<?php foreach($faqs as $f ) : ?>
			<h2><?php echo $f['Faq']['title_question'];?></h2>
			<?php echo $f['Faq']['reponse'];?>
			<br>
			<?php endforeach ; ?>
		</div>
	</div>
</div>
<div class="clear"></div>