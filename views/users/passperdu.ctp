<div class="titre_violet">
	Vous avez oublié votre mot de passe
</div>

<br/>
<div class="form">

	<?php echo $this->Form->create('User', array('action'=>'passperdu'));?>
	
	<table>
		<tr>
			<td><?php echo $this->Form->input('email', array('label' => 'Votre adresse email<br/>', 'size' => 48));?></td>
		</tr>
		<tr>
			<td align="right"><?php echo $form->end('Envoyer');?></td>
		</tr>
	</table>
	
	
	

</div>