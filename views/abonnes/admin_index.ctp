<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Liste des abonnés à la newsletter: </h2>
	</div>
	<div id='contenu-actions'>		
		<a href="/admin/abonnes/ajouter" class="bt_green"><img src="/_admin/img/add.png" width="22px" height="22px"/></a>	
	</div>
</div>
<div class="sidebar_search">
	<?php echo $form->create('Abonne',array('action'=>'rechercher') ) ; ?>
	<?php echo $form->input('query',array('class'=>'search_input','value'=>"Rechercher ..." ,'onclick'=>"this.value=''",'label'=>false) ) ; ?>
	<input type="image" class="search_submit" src="/_admin/images/search.png" />
	<?php echo $form->end() ; ?>
</div> 
<?php echo $form->create('Abonne',array('action'=>'rechercher') ) ; ?>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nom', 'nom'); ?></th>
			<th scope="col" class="rounded">Email</th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Date inscription', 'date_inscription'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Adresse IP', 'ip'); ?></th>
			<th scope="col" class="rounded"></th>
            <th scope="col" class="rounded-q4">
			
			</th>
        </tr>
    </thead>
        <tfoot>
		</tfoot>
    <tbody>
	   <?php foreach($abonnes as $a ) : ?>
    	<tr>
        	<td></td>
            <td><?php echo $a['Abonne']['nom'] ; ?></td>
			<td><?php echo $a['Abonne']['email'] ; ?></td>
            <td><?php echo date( "d/m/y h:i" , strtotime( $a['Abonne']['date_inscription'] ) );  ?></td>
			<td><?php echo $a['Abonne']['ip'] ; ?></td>
            <td><a href="/admin/abonnes/<?php echo ($a['Abonne']['statut']== 0?"inscrire":"desinscrire")."/". $a['Abonne']['id'] ; ?>"><img src="/images/<?php echo ($a['Abonne']['statut']== 0?"rond_r.png":"rond_v.png");?>" alt="" title="" border="0" /></a></td>
            <td>
				<a href="/admin/abonnes/modifier/<?php echo $a['Abonne']['id'] ; ?>"><img src="/_admin/img/user_edit.png" alt="" title="" border="0" /></a>
				<a href="/admin/abonnes/delete/<?php echo $a['Abonne']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="" title="" border="0" /></a>
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