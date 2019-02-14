<div class="titre_violet">
	Message
</div>
	
<div class="tab2">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th colspan="2">Objet : <?php echo $message['Message']['objet'];?> </th> 
		</tr>
		<tr>
			<td class="cell_img" width="55px">
				<?php  echo $html->image("/img/user/image/thumb.small.nophoto.gif", array(
												"alt" => 'image',
												"width" => 40
				)); ?>
			</td>
			<td class="cell_produit">
				<?php echo $message['Message']['message']; ?>
			</td>
		</tr>
	</table>
</div>

<div class="bouton_violet">
	<?php echo $this->Html->link('Répondre', array('controller' => 'messages', 'action' => 'ecrire', $message['Message']['expediteur_id']));?>
</div>
