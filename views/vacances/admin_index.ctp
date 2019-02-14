<div id="contenu-entete">
	<div id="contenu-titre">
		<h2><?php echo $balise_h1;?></h2>
	</div>
	<div id='contenu-actions'>
		<a href="/admin/vacances/ajouter" title="Ajouter"><img src="/_admin/img/add.png" width="22px" height="22px"/></a>
		<!--<a href="#"><img src="/_admin/img/print.png" alt="Imprimer"></a>
		<a href="#"><img src="/_admin/img/excel.png" alt="Exporter"></a>-->
	</div>
</div>
<table class="table_search"><tr>
	<?php echo $form->create('Vacance',array('action'=>'rechercher') ) ; ?>
	<td>Chercher : &nbsp;</td>
	<td>
		<div class="sidebar_search">
			
			<?php echo $form->input('query',array('class'=>'search_input','label'=>false) ) ; ?>
			
		</div>
	</td>
	<td>
		<input type="image" class="search_submit" src="/_admin/images/search.png" />
	</td>
	<?php echo $form->end() ; ?> 
	<tr>
</table>
<br>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"><?php echo $this->Paginator->sort('Id', 'Vacance.id'); ?></th>
		    <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nom', 'Vacance.titre'); ?></th>
			<th scope="col" class="rounded" width="35px"><?php echo $this->Paginator->sort('Prix', 'Vacance.budget'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Annonceur', 'Annonceur.nom'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Date', 'Vacance.created'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Consulté', 'Vacance.nbr_consultation'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Favoris', 'Vacance.nbr_ajout_favoris'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Publier', 'Vacance.publier'); ?></th>
			<th scope="col" class="rounded-q4">
			</th>
        </tr>
    </thead>
        <tfoot>
    	</tfoot>
    <tbody id="test-list">
	   <?php foreach($vacances as $v ) : ?>
    	<tr>        	
			<td>
				<a href="/admin/vacances/afficher/<?php echo $v['Vacance']['id'] ; ?>">
					<img class="produit-vignette" style="max-width:60px;max-height:60px;" src="/uploads/vacances/<?php echo $v['Vacance']['image'] ; ?>"/>
					<br>
					<?php echo $v['Vacance']['id'] ; ?>
				</a>
			</td>
			<td><?php echo $v['Vacance']['titre'] ;?></td>
			<td><?php echo str_replace(".00","",$v['Vacance']['budget']) ; ?><span class="mnt"> €</span></td>
			<td><?php echo $v['Annonceur']['prenom']. '. ' . $v['Annonceur']['nom'].' (' . $v['Annonceur']['username'].')'; ?></td>
			<td><?php echo date("d/m/Y h\Hi",strtotime( $v['Vacance']['created'] )); ?></td>
			<td><?php echo $v['Vacance']['nbr_consultation'] ; ?></td>
			<td><?php echo $v['Vacance']['nbr_ajout_favoris'] ; ?></td>
			<?php if($v['Vacance']['valide']==1) {?>
			<td><a href="/admin/vacances/<?php echo ($v['Vacance']['publier'] ==  2 ? 'depublier':'publier');?>/<?php echo $v['Vacance']['id'] ; ?>"><?php echo ($v['Vacance']['publier'] == 1 ?"<img src='/_admin/img/rond_v.png' title='Annuler la publication' />" : "<img src='/_admin/img/rond_r.png' title='publier'/>" ); ?></a></td>
			<?php }else{ ?>
			<td><img src='/_admin/img/not_validate.png' title="Pas encore validée par le membre" /></td>
			<?php } ?>
			<td class="rounded-right" style="width:100px;">
				<a href="/admin/vacances/tag/<?php echo $v['Vacance']['id'] ; ?>" class="ajax"><img src="/_admin/img/tag.png" alt="Tag" title="Tag" border="0" width="20px" /></a>
				<a href="/admin/vacances/afficher/<?php echo $v['Vacance']['id'] ; ?>"><img src="/_admin/img/more.png" alt="Afficher" title="Afficher" border="0" /></a>
				<a href="/admin/vacances/modifier/<?php echo $v['Vacance']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="Modifier" title="Modifier" border="0" /></a>
				<?php if($v['Vacance']['deleted']==0) {?>
					<a href="/admin/vacances/delete/<?php echo $v['Vacance']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="Supprimer" border="0" /></a>
				<?php }elseif($v['Vacance']['deleted']==1) {?>
					<a href="/admin/vacances/permanently_delete/<?php echo $v['Vacance']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer définitivement" title="Supprimer définitivement" border="0" /></a>
					<a href="/admin/vacances/restore/<?php echo $v['Vacance']['id'] ; ?>" ><img src="/_admin/img/restore.jpg" alt="Restaurer " title="Restaurer " border="0" /></a>
				<?php } ?>
			</td> 
            
        </tr>
       <?php endforeach ; ?>
    </tbody>
</table>
<div class="pagination">
				<?php echo $this->Paginator->prev('<< Précédent', null, null, array('title'=>"Précédent" , 'class' => 'disabled')); ?>
				<?php echo $this->Paginator->numbers(array('class'=>'number')); ?>
				<?php echo $this->Paginator->next(' Suivant >>', null, null, array('title'=>"Suivant" ,'class' => 'disabled')); ?> 
</div> <!-- End .pagination -->
