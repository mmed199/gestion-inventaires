
<div class="titre_violet">Mes messages reçus</div>


<div class="tab2">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th colspan="2">Objet</th>
			<th>De</th>
			<th>Date</th>
		</tr>
		<?php if(empty($messages)) echo '<tr><td colspan="4" align="center">Vous n\'avez pas de message actuellement</td></tr>';
		
		else {
		foreach($messages as $message): ?>
		<tr>
			<?php if(!empty($message['Message']['lu'])){?>
			<td class="cell_img" width="55px">
				<?php  echo $html->image("/img/user/image/thumb.small.nophoto.gif", array(
												"alt" => $message['User1']['image'],
												"width" => 40
						)); ?>
			</td>
			<td width="60%" class="cell_produit"><?php echo $this->Html->link($message['Message']['objet'], array('controller'=>'messages', 'action'=>'lire', $message['Message']['id']), array('escape' => false) );?></td>
			<td width="20%" class="cell_simple"><?php echo $this->Html->link($message['User1']['username'], array('controller'=>'users', 'action'=>'voir', $message['User1']['id']), array('escape' => false) );?></td>
			<td width="15%" class="cell_simple"><?php echo $message['Message']['created']; ?></td>
			<?php
			}
			else{ ?>
			<td class="cell_img" width="55px">
				<?php  echo $html->image("/img/user/image/thumb.small.nophoto.gif", array(
												"alt" => $message['User1']['image'],
												"width" => 40
						)); ?>
			</td>
			<td width="60%" class="cell_produit"><b><?php echo $this->Html->link($message['Message']['objet'], array('controller'=>'messages', 'action'=>'lire', $message['Message']['id']), array('escape' => false) );?></b></td>
			<td width="20%" class="cell_simple"><b><?php echo $this->Html->link($message['User1']['username'], array('controller'=>'users', 'action'=>'voir', $message['User1']['id']), array('escape' => false) );?></b></td>
			<td width="15%" class="cell_simple"><b><?php echo $message['Message']['created']; ?></b></td>
			
			<?php } ?>
		</tr>
		<?php endforeach;
		}
		?>
	
	</table>
</div>	


<div class="bouton_violet">
	<?php echo $this->Html->link('Ecrire un message', array('controller' => 'messages', 'action' => 'ecrire'));?>
</div>
