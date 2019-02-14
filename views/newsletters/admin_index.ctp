<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Liste des newsletter envoyées</h2>
	</div>
	<div id='contenu-actions'>		
		<a href="/admin/newsletters/new" class="bt_green"><img src="/_admin/img/add.png" width="22px" height="22px"/></a>
	</div>
</div>
<?php 
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
?>
     
	         
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded">Titre</th>
			<th scope="col" class="rounded">Nbr Msgs envoyés</th>
			<th scope="col" class="rounded">Nombre d'echecs</th>
            <th scope="col" class="rounded">Date</th>
			<th scope="col" class="rounded">Pour</th>
			<th scope="col" class="rounded"> </th>
            <th scope="col" class="rounded">&nbsp;</th>
			<th scope="col" class="rounded">&nbsp;</th>
            <th scope="col" class="rounded-q4"></th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="9" class="rounded-foot-left"></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
	   <?php foreach($newsletters as $a ) : ?>
    	<tr>
        	<td>
			<?php if($a['Newsletter']['statut'] == 1 ) : ?>
			<a href="#" title="En cours d'envoie" > <img style="width: 30px;" src="/_admin/img/icons/loading.gif" /></a>
			<?php endif; ?>
			</td>
            <td><?php echo $a['Newsletter']['title'] ; ?></td>
			<td><?php echo $a['Newsletter']['envoyes'] ; ?></td>
			<td><?php echo $a['Newsletter']['fails'] ; ?></td>
            <td><?php echo strftime( "%d/%m/%Y" , strtotime($a['Newsletter']['date'])) ; ?></td>
			<td><?php echo $a['Newsletter']['pour']==0 ? "Tous" : ( $a['Newsletter']['pour']==1 ? "Professionnels":"Clients" )  ; ?></td>

            <td>
			<?php if( $a['Newsletter']['statut'] == 1) : ?>
			<a href="/admin/newsletters/pause/<?php echo $a['Newsletter']['id'] ; ?>" ><img src="/_admin/img/icons/pause.png"></a>
			<?php elseif( $a['Newsletter']['statut'] == 0 ) : ?>
			<a href="/admin/newsletters/play/<?php echo $a['Newsletter']['id'] ; ?>" ><img src="/_admin/img/icons/play.png"></a>
			<?php else: ?>
			Envoi terminé
			<?php endif; ?>
			</td>
			<td><a href="/admin/newsletters/envoyer_admin/<?php echo $a['Newsletter']['id'] ; ?>" title="Envoyer un test au admin">Tester</a></td>
            <td><a href="/admin/newsletters/modifier/<?php echo $a['Newsletter']['id'] ; ?>"><img src="/_admin/img/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="/admin/newsletters/delete/<?php echo $a['Newsletter']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
       <?php endforeach ; ?>
    </tbody>
</table>
<br/>
