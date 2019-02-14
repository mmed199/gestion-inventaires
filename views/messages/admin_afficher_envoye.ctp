<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Détail du message</h2>
	</div>
	<div id='contenu-actions'>
		<a href="/admin/messages/delete/<?php echo  $message['Message']['id']  ; ?>" title="Supprimer"><img src="/_admin/img/delete.png" alt="Supprimer"></a>
		<a href="#"><img src="/_admin/img/excel.png" alt="Exporter"></a>
		<a href="#"><img src="/_admin/img/print.png" alt="Imprimer"></a>
	</div>
</div>
<div id="entete-member">
	<div id="entete-member-col-2">
		<span class="dlabel">Envoyé à :</span>
		<span class="dvaleur"><?php echo $message['Message']['nom'] ; ?></span>
		<div style="clear:both;"></div>
		<span class="dlabel">Email :</span>
		<span class="dvaleur"><?php echo $message['Message']['email'] ; ?></span>
		<div style="clear:both;"></div>
		<span class="dlabel">Le :</span>
		<span class="dvaleur"><?php echo date("d/m/y h\Hi",strtotime( $message['Message']['date'] )); ?></span>
		<div style="clear:both;"></div>
		<span class="dlabel">Objet :</span>
		<span class="dvaleur"><?php echo $message['Message']['objet'] ; ?></span>
		<div style="clear:both;"></div>
	</div>
</div>
<div id="entete-member">
	<div id="entete-message-col-3">
		<span class="dlabel">Message :</span><br>
		<p><span><?php echo $message['Message']['message'] ; ?></span></p>
		<div style="clear:both;"></div>
	</div>
</div>