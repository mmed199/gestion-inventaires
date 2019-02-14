<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Liste des articles</h2>     
	</div>
</div>                   
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">Id</th>
            <th scope="col" class="rounded">Titre</th>
            <th scope="col" class="rounded">slug</th>
            <th scope="col" class="rounded">Date de création</th>
			<th scope="col" class="rounded">Section</th>
            <th scope="col" class="rounded-q4">
				<a href="/admin/articles/ajouter" ><img src="/_admin/img/add.png" width="22px" height="22px"/></a>
			</th>
        </tr>
    </thead>
        <tfoot>
    	
    </tfoot>
    <tbody>
	   <?php foreach($articles as $a ) : ?>
    	<tr>
        	<td><?php echo $a['Article']['id'] ; ?></td>
            <td><?php echo $a['Article']['title'] ; ?></td>
            <td><?php echo $a['Article']['slug'] ; ?></td>
            <td><?php echo strftime( "%d/%m/%Y" , strtotime($a['Article']['date'])) ; ?></td>
			<td><?php echo $a['Asection']['title'] ; ?></td>
           <td class="rounded-right" style="width:100px;" > 
				<a href="/admin/articles/afficher/<?php echo $a['Article']['id'] ; ?>"><img src="/_admin/img/more.png" alt="afficher" title="" border="0" /></a>			
				<a href="/admin/articles/modifier/<?php echo $a['Article']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="" title="Modifier" border="0" /></a>&nbsp;&nbsp;&nbsp;
				<a href="/admin/articles/delete/<?php echo $a['Article']['id'] ; ?>" class="ask"><img src="/_admin/img/delete.png" alt="" title="Supprimer" border="0" /></a>
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
