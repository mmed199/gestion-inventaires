<div class="titre_violet">
	Ecrire un message
</div>

<?php echo $session->flash();?>

<div class="message">	
	<div class="form">	
			<?php echo $this->Form->create('Message', array('action'=>'ecrire'));?>	
			<table width="100%">
				<tr>
					<td valign="top" align="left">
						<?php echo $this->Form->input('objet', array('label' => 'Objet du message<br/>', 'size' => 40));?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
						Sélectionnez le destinataire<br/>
						<?php echo $this->Form->select('membre', $liste_membre);?>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						Votre message<br/>
						<?php echo $this->Form->textarea('message', array('rows' => '7', 'cols' => '90'));?>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<div class="form"><?php echo $form->end('Envoyer');?></div>
					</td>
				</tr>
			</table>

	</div>
</div>

