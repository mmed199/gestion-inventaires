<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Messages reçus</h2>
	</div>
	<div id='contenu-actions'>		
	</div>
</div>
<table border="1" width="100%" cellpadding="0" cellspacing="0" >
				<tr align="center">
					<th>De.</th>
					<th> Objet	</th>
					<th>Date</th>
					<th>lu</th>
					<th>Options</th>
				</tr>
                <?php foreach($messages as $m) : ?>
				<tr>
					<td><a href="/admin/messages/afficher/<?php echo $m['Message']['id'] ; ?>" ><?php echo $m['Message']['nom'] ; ?></a></td>
					<td><a href="/admin/messages/afficher/<?php echo $m['Message']['id'] ; ?>" ><?php echo $m['Message']['objet']  ; ?></a></td>
					<td><center><?php echo $m['Message']['date'] ; ?></center></td>
					<td><center>lu</center></td>
					<td>
						<a href="/admin/messages/repondre/<?php echo $m['Message']['id'] ; ?>" title="Répondre">
					     <img src="/img/admin/repondre.png"  width="20"/>
						</a>
						<a href="/admin/messages/delete/<?php echo $m['Message']['id'] ; ?>" title="Supprimer">
					     <img src="/img/admin/delete.png" />
						</a>
					</td>
				</tr>
		        <?php endforeach ; ?>		
				
				</table>

<?php echo $paginator->numbers(array('separator' => '--')); ?> 

