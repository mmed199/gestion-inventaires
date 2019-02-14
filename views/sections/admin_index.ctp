<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead> 
    	<tr>
        	<th scope="col" class="rounded-company" width="5px"></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Identifiant', 'Marque.id'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Marque', 'Marque.nom'); ?></th>
           	<th scope="col" class="rounded"><?php echo $this->Paginator->sort('URL', 'Marque.slug'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Prods Vente', 'Marque.slug'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Prods vendus', 'Marque.slug'); ?></th>
            <th scope="col" class="rounded-q4"><a href="/admin/marques/ajouter" class="bt_green"><img src="/_admin/img/add.png" width="22px" height="22px"/></a></th>
        </tr>
    </thead>
    <tbody id="test-list">
	   <?php foreach($marques as $c ) : ?>
    	<tr id="listItem_<?php echo $c['Marque']['id'] ; ?>" >
        	<td></td>
			<td><?php echo $c['Marque']['id'] ; ?></td>
			<td><?php echo $c['Marque']['nom'] ; ?></td>
			<td><?php echo $c['Marque']['slug'] ; ?></td>
			<td>XX</td>
			<td>YY</td>
			<td class="rounded-right">
				<a href="/admin/marques/afficher/<?php echo $c['Marque']['id'] ; ?>"><img src="/_admin/img/more.png" alt="Afficher" title="" border="0" /></a>
				<a href="/admin/marques/modifier/<?php echo $c['Marque']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="Modifier" title="" border="0" /></a>
				<a href="/admin/marques/delete/<?php echo $c['Marque']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="" border="0" /></a>
			</td>
			
	  </tr>
       <?php endforeach ; ?>
    </tbody> 
</table>
<div class="pagination">
	<center>
		Page : 
		<?php echo $this->Paginator->counter(array( 'format' =>'<strong> %page% </strong> / %pages% ')) ; ?>
		<?php echo $paginator->numbers(array('separator' => ' - ')); ?> 
	</center>
</div>