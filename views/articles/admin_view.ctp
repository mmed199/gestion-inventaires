<a href="/articles/afficher/<?php echo $article['Article']['id'] ; ?>" target="_blank" ><?php echo $article['Article']['title'] ; ?></a>
<div class="stats" style="float:right" >
	<a href="/admin/articles/modifier/<?php echo $article['Article']['id'] ; ?>"><img src="/_admin/img/user_edit.png" alt="Modifier" title="" border="0" /></a>
    <a href="/admin/articles/delete/<?php echo $article['Article']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="" border="0" /></a>
     
</div>
<hr/>
<div class="article-scontent">
<br><br>
<b>Contenu : </b><br>
<?php echo $article['Article']['content'] ; ?>
</div>
<hr/>
<b>Résumé : </b><br>
<div class="article-content">
<?php echo $article['Article']['scontent'] ; ?>
</div>
<br/>