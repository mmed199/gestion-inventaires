<h2>Envoyer un message </h2>
<?php echo $form->create('Message',array('id'=>'formID','url'=>array('action'=>'repondre_valider'))); ?>
<br/>
<?php echo $form->hidden('nom',array('value'=>$message['Message']['nom'] )) ; ?>
<label for="email">Destinataire :</label>
<?php echo $form->input("Message.email", array("class"=>"validate[required,custom[email]] inputlong","label"=>false,'value'=>$message['Message']['email'])); ?>
<br/>
<label for="email">Objet : </label>
<?php echo $form->input("Message.objet", array("class"=>"validate[required] inputlong","label"=>false,'value'=> "Re: " . $message['Message']['objet'])); ?>

<br/>
<label for="email">Message : </label>
<?php echo $cksource->ckeditor('Message.message',array('cols'=>'1000','value'=>"<br><br><hr/>".$message['Message']['message']));  ?>
<br/>
<?php echo $form->end("Envoyer"); ?>