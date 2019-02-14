	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Liste des questions aide </h1>
		<a href="/admin/aides/ajouter">Ajouter une question </a>
	</div>
	<!-- end page-heading -->
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-repeat line-left white">Question</th>
					<th class="table-header-repeat line-left white"> Catégorie	</th>
					<th class="table-header-options line-left  white">Options</th>
				</tr>
                <?php foreach($aides as $a) : ?>
				<tr>
					<td><a href=""><?php echo $a["Aide"]["question"];?></a></td>
					<td><?php echo $a['Caide']['title'] ;?></td>
                    <td>
					<a href="/admin/aides/delete/<?php echo $a['Aide']['id'] ; ?>" title="Suprimer" class="icon-2 info-tooltip"></a>
					<?php echo $html->link('Modifier' , array('action'=>'edit',$a['Aide']['id'] ) ) ; ?>
					</td>
				</tr>
		        <?php endforeach ; ?>		
				
	</table> 

<div class="pagination">
	<center>
		Page : 
		<?php echo $this->Paginator->counter(array( 'format' =>'<strong> %page% </strong> / %pages% ')) ; ?>
		<?php echo $paginator->numbers(array('separator' => ' ')); ?> 
	</center>
</div>