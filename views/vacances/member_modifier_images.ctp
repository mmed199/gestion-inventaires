<?php $this->set ('page_title', "Modifier les images | kidsdressing");?>
<h3>Modifier les images</h3><div class="error"></div>
<?php echo $form->create('Produit',array('type'=>'file'));?>
<?php echo $form->hidden('id') ;?>
<p><label for "image1Prod" >Image 1 : </label>
	<?php echo $form->file("image1Prod"); ?>
</p>
<p><label for "image2Prod" >Image 2 : </label>
	<?php echo $form->file("image2Prod"); ?>
</p>
<p><label for "image3Prod" >Image 3 : </label>
	<?php echo $form->file("image3Prod"); ?>
</p>
<div id="valider">
	<?php echo $form->submit(" Valider ") ; ?> 
</div>
<div class="clear"></div>
<?php echo $form->end() ; ?>
<div class="clear"></div>
	