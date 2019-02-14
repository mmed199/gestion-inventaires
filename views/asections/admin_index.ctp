<?php 
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
?>
<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Liste des séctions</h2>      
	</div>
</div>                   
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">Id</th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Titre', 'title'); ?></th>
			<th scope="col" class="rounded">Nbr d'articles</th>
			<th scope="col" class="rounded">Date de création</th>
            <th scope="col" class="rounded-q4">
				<a href="/admin/asections/ajouter" ><img src="/_admin/img/add.png" width="22px" height="22px"/></a>
			</th>
        </tr>
    </thead>
        <tfoot>
    	
    </tfoot>
    <tbody>
	   <?php foreach($asections as $a ) : ?>
    	<tr>
        	<td><?php echo $a['Asection']['id'] ; ?></td>
            <td><?php echo  $a['Asection']['title'] ; ?></td>
			<td><?php echo $a['Asection']['article_count'] ; ?>
			<?php if( $a['Asection']['article_count'] > 0 )  : ?>
			<a href="/admin/articles/asection/<?php echo $a['Asection']['id'] ; ?>" >Afficher </a>
			<?php endif; ?>
			</td>
            <td><?php echo strftime( "%d/%m/%Y" , strtotime( $a['Asection']['created_date'] ) );  ?></td>
            <td class="rounded-right" style="width:100px;" > 
				<a href="/admin/asections/modifier/<?php echo $a['Asection']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="" title="Modifier" border="0" /></a>&nbsp;&nbsp;&nbsp;
				<a href="/admin/asections/delete/<?php echo $a['Asection']['id'] ; ?>" class="ask"><img src="/_admin/img/delete.png" alt="" title="Supprimer" border="0" /></a>
			</td>
        </tr>
       <?php endforeach ; ?>
     </tbody>
</table>
<center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page : 
<?php echo $this->Paginator->counter(array( 'format' =>'<strong> %page% </strong> / %pages%')) ; ?>&nbsp;&nbsp;
<?php echo $paginator->numbers(array('separator' => ' - ')); ?> 
</center>