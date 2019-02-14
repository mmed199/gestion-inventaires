<h2>Détails</h2>
<div class="sidebar_search">
<?php echo $form->create('User',array('action'=>'rechercher') ) ; ?>
<?php echo $form->input('query',array('class'=>'search_input','value'=>"Rechercher ..." ,'onclick'=>"this.value=''",'label'=>false) ) ; ?>
<input type="image" class="search_submit" src="/_admin/images/search.png" />
<?php echo $form->end() ; ?>
</div>
<a href="/admin/users/profil" class="bt_green"><span class="bt_green_lft"></span><strong>Informations</strong><span class="bt_green_r"></span></a><br> 
<a href="/admin/users/horaires" class="bt_green"><span class="bt_green_lft"></span><strong>Horaires</strong><span class="bt_green_r"></span></a> <br>
<a href="/admin/users/activites" class="bt_green"><span class="bt_green_lft"></span><strong>Activités</strong><span class="bt_green_r"></span></a> 


CEtte va contenir une page a onglet:

informations sur l'utilisateur (nom, prenom, derniere connexion  ...)
<br>
liste des annonces consultées, validées, refusées ....

<br>
activités : horaires ....