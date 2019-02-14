<h2>Envoyer un message </h2>
<?php echo $form->create('Message',array('id'=>'formID')); ?>
<br/>
<label for="nom">Nom :</label>

<?php echo $form->input('nom',array('label'=>false)) ; ?>
<label for="email">Email :</label>
<?php echo $form->input("Message.email", array("class"=>"validate[required,custom[email]] inputlong","label"=>false)); ?>
<br/>
<label for="email">Objet : </label>
<?php echo $form->input("Message.objet", array("class"=>"validate[required] inputlong","label"=>false)); ?>

<br/>
<label for="email">Message : </label>
<?php echo $cksource->ckeditor('Message.message',array('cols'=>'1000'));  ?>
<br/>
<?php echo $form->end("Envoyer"); ?>