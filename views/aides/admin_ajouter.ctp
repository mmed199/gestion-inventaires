<div id="content">
<?php echo $form->create('Aide') ; ?>
Question : <?php echo $form->input('question',array('label'=>false,'size'=>'130')) ; ?>
Réponse: <?php echo $cksource->ckeditor(
							'reponse',
										array(
											'label' => false
										)) ; ?>
Catégorie: <?php echo $form->input('caide_id',array('label'=>false)) ; ?>
<?php echo $form->submit("Ajouter") ; ?>
<?php echo $form->end(); ?>
</div> 