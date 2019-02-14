<div class="titre_violet">
	Changer mon adresse e-mail
</div>
<?php echo $session->flash();?>


<?php echo $this->Form->create('User');?>
<?php echo $this->Form->input('id', array('type' => 'hidden'));?>

<div class="form">
	<table>
		<tr>
			<td align="right">Mot de passe actuel</td>
			<td><?php echo $this->Form->input('old_pass', array('type' => 'password', 'label' => false, 'size' => 32));?></td>
		</tr>
		<tr>
			<td align="right">Nouvelle adresse email</td>
			<td><?php echo $this->Form->input('new_email', array('label' => false, 'size' => 32));?></td>
		</tr>
		<tr>
			<td align="right">Confirmer adresse email</td>
			<td><?php echo $this->Form->input('confirm_email', array('label' => false, 'size' => 32));?></td>
		</tr>

	</table>

	<center><?php echo $this->Form->end('Mettre à jour');?></center>
</div>