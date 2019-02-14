<h2>Envoyer un message</h2>
<?php echo $form->create('Message',array('id'=>'formID','url'=>array('action'=>'creer'))); ?>
<br/>

<label for="email">Destinataire :</label>
<?php echo $form->input("Receiver.email", array("class"=>"validate[required,custom[email]] inputlong","label"=>false,'class'=>'inputl')); ?>
<br/>
<label for="email">Objet : </label>
<?php echo $form->input("objet", array("class"=>"validate[required] inputlong","label"=>false,'class'=>'inputl')); ?>

<br/>
<label for="email">Message : </label>
<?php echo $form->input('message',array('cols'=>'80',"label"=>false));  ?>
<br/>
<?php echo $form->end("Envoyer"); ?>