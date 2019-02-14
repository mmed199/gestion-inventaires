<?php
	$this->set('page_title',$newsletter['Newsletter']['title'] .' - Newsletter - Elwards ');
	$this->set('page_keywords',$newsletter['Newsletter']['title'] .__('delivery, flowers, bouquet, morocco, algeria, tunisia, order',true));
?>
<h1><?php echo $newsletter['Newsletter']['title'] ; ?></h1>
<div class="descrip" style="width:800px;">
	<p style="padding-left:600px;">Date : <?php echo strftime( "%d/%m/%Y" , strtotime($newsletter['Newsletter']['date']));?><br/>
		</p>
		<?php echo $newsletter['Newsletter']['content'] ; ?>
		<br/>
		<a href="/<?php echo Configure::read('Config.langCode');?>/newsletters"><?php echo __("Liste des newsletters",true);?></a>
		<br/><br/>
	
</div>