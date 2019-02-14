<div id="contenu-entete">
	<div id="contenu-titre">
		<h2><a href="/articles/afficher/<?php echo $article['Article']['id'] ; ?>" target="_blank" ><?php echo $article['Article']['title'] ; ?></a></h2>
	</div>
	<div id='contenu-actions'>
		<a href="/admin/articles/modifier/<?php echo $article['Article']['id'] ; ?>"><img src="/_admin/img/user_edit.png" alt="Modifier" title="" border="0" /></a>
		<a href="/admin/articles/delete/<?php echo $article['Article']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="" border="0" /></a>
	</div>
</div>
<div id="entete-member"  style="height:auto;">
	<div id="entete-message-col-3">
		<span class="dlabel">Résumé :</span><br>
		<p><span><?php echo $article['Article']['scontent'] ; ?></span></p>
		<div style="clear:both;"></div>
	</div>
</div>
<div id="entete-member"  style="height:auto;">
	<div id="entete-message-col-3">
		<span class="dlabel">Contenu :</span><br>
		<p><span><?php echo $article['Article']['content'] ; ?></span></p>
		<div style="clear:both;"></div>
	</div>
</div>