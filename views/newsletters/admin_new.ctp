<h2>Nouvelle newsletter </h2>
    <?php echo $form->create('Newsletter',array('id'=>'formID','url'=>array('action'=>'new'))); ?>
    <label for="email">Le Titre : </label>
    <?php echo $cksource->input("title", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"54")); ?>
    <br/>
	<label for="ville">Pour :</label>
	<?php 
		$options=array('0'=>"Tous",'1'=>'Professionnels','2'=>'Clients');
		echo $form->select("Newsletter.pour",$options ); 
	?>
	<br/>                       
	<br/>
	<label>Contenu : </label>
    <?php e($cksource->ckeditor('Newsletter.content.',array('label' => false))) ; ?>
	<br/>
    <dl class="submit">
      <?php echo $cksource->end("Enregistrer"); ?>
    </dl>
<?php 
