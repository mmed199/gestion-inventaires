<h1>Gestion des types de produit</h1>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead> 
    	<tr>
        	<th scope="col" class="rounded-company" width="25px"<?php echo $this->Paginator->sort('Id', 'Type.id'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Préfixe', 'Type.prefixe_nom'); ?></th>
           	<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Type', 'Type.nom'); ?></th>
           	<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nom pluriel', 'Type.nom_p'); ?></th>
			<th scope="col" class="rounded">Catégorie</th>
			<th scope="col" class="rounded">Catégorie google</th>
			<th scope="col" class="rounded">Famille</th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('URL', 'Type.slug'); ?></th>
            <th scope="col" class="rounded-q4"><a href="/admin/types/ajouter" class="bt_green"><img src="/_admin/img/add.png" width="22px" height="22px"/></a></th>
        </tr>
    </thead>
    <tbody id="test-list">
	   <?php foreach($types as $c ) : ?>
    	<tr id="listItem_<?php echo $c['Type']['id'] ; ?>" >
        	<td><?php echo $c['Type']['id'] ; ?></td>
			<td><?php echo $c['Type']['prefixe'] ; ?></td>
			<td><?php echo $c['Type']['nom'] ; ?></td>
			<td><?php echo $c['Type']['nom_p'] ; ?></td>
			<td><?php echo $c['Category']['title'] ; ?></td>
			<td><?php echo $c['Type']['google_product_category'] ; ?></td>
			<td><?php echo $c['Pfamille']['titre'] ; ?></td>
			<td><?php echo $c['Type']['slug'] ; ?></td>
			<td class="rounded-right" style="width:100px;">
				<a href="/admin/types/modifier/<?php echo $c['Type']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="Modifier" title="" border="0" /></a>
				<a href="/admin/types/delete/<?php echo $c['Type']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="" border="0" /></a>
			</td>
		</tr>
       <?php endforeach ; ?>
    </tbody>
</table>
<div class="pagination">
	<center>
		Page : 
		<?php echo $this->Paginator->counter(array( 'format' =>'<strong> %page% </strong> / %pages% ')) ; ?>
		<?php echo $paginator->numbers(array('separator' => ' ')); ?> 
	</center>
</div>