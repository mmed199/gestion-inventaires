<h3><span class="lbl_bleu"><?php __d('members',"Messages reçus") ;?></span><span style="color:black;"> | </span><a href="/member/members/messages_envoyes"><?php __d('members',"Messages enoyés") ;?></a></h3> 

<!-- <a href="/member/messages/creer"><img src="/img/add.png"><span class="lbl_bleu"><?php __d('members',"Créer un message</span></a> -->

<center>
	<?php if(!empty($messages) ) : ?>
	<table class="liste-cmd">
		<thead> 
			<tr>
				<th class="col_21"><span class="lbl_bleu"><?php __d('members',"Envoyé par") ;?></span></th>
				<th class="col_21"><span class="lbl_bleu"><?php __d('members',"Date") ;?></span></th>
				<th class="col_21"><span class="lbl_bleu"><?php __d('members',"Objet") ;?></span></th>
				<th></th>
			</tr>
		</thead> 
			<tfoot>
			<tr>
				<td colspan="6" class="rounded-foot-left"></td>
				<td class="rounded-foot-right">&nbsp;</td>		
			</tr>
		</tfoot>
		<tbody id="test-list">
		   <?php foreach($messages as $m ) : ?> 
			<tr id="listItem_<?php echo $m['Message']['id'] ; ?>" >
				<td><?php echo $m['Receiver']['email'] ; ?></td>
				<td><?php echo date("d/m/y h\Hi",strtotime($m['Message']['date'])) ; ?></td>
				<td><?php echo $m['Message']['objet'] ; ?></td>
				<td>
					<a href="/member/messages/afficher_recu/<?php echo $m['Message']['id'] ; ?>"><img src="/_admin/img/more.png" alt="<?php __d('members',"Afficher") ;?>" border="0" width="18px" /></a>
					&nbsp;<a href="/member/messages/repondre/<?php echo $m['Message']['id'] ; ?>"><img src="/_admin/img/mail_reply.png" alt="<?php __d('members',"Répondre") ;?>" title="" border="0" width="18px" /></a>
					&nbsp;<a href="/member/messages/delete/<?php echo $m['Message']['id'] ; ?>" class="ask"><img src="/_admin/img/delete.png" alt="<?php __d('members',"Supprimer") ;?>" title="" border="0" width="18px" /></a>
				</td>
		  </tr>
		   <?php endforeach ; ?>
		</tbody>
	</table>
   <?php else : ?>
		<span style="color:red;"><?php __d('members',"Aucun message reçu.") ;?></span><br/>
	<?php endif ; ?>
</center>
