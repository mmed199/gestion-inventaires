<h2>Modifier</h2>
<?php echo $form->create('Newsletter',array('id'=>'formID','url'=>array('action'=>'modifier'))); ?>
<?php echo $form->hidden('Newsletter.id') ; ?>
<label for="email">Le Titre : </label></dt>
<?php echo $cksource->input("title", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"54")); ?>
<br/>
	<br/>
	<label for="pour">Pour :</label>
	<?php 
		$options=array('0'=>"Tous",'1'=>'Professionnels','2'=>'Clients');
		echo $form->select("Newsletter.pour",$options ); 
	?>
	<br/>   
<label>Contenu : </label>
	<?php e($cksource->ckeditor('Newsletter.content.',array('label' => false))) ; ?>
<dl class="submit">
  <?php echo $cksource->end("Valider"); ?>
</dl>
