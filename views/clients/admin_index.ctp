<h2>Clients</h2>                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"><?php echo $this->Paginator->sort('Nom & Prénom', 'Client.prenom'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Ville', 'Client.ville'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Email', 'Client.email'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Con.', 'Client.nbSessCli'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Com.', 'Client.nbSessCli'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Prod', 'Client.nbSessCli'); ?></th>          
			<th scope="col" class="rounded-q4"></th>
        </tr>
    </thead>
        <tfoot>
    	</tfoot>
    <tbody>
	   <?php foreach($clients as $c ) : ?>
    	<tr>
        	<td><?php echo $c['Client']['nom'] ; ?>&nbsp;&nbsp;<?php echo $c['Client']['prenom'] ; ?></a></td>
			 <td><?php echo $c['Client']['ville'] ; ?></td>            
            <td><?php echo $c['Client']['email'] ; ?></td>
			<td><?php echo $c['Client']['nbSessCli'] ; ?></td> 
			<td>XX</td> 
			<td>XX</td> 
			<td>
				<a href="/admin/clients/afficher/<?php echo $c['Client']['id'] ; ?>"><img src="/_admin/images/more.png" alt="" title="" border="0" /></a>
				<a href="/admin/clients/modifier/<?php echo $c['Client']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="Modifier" title="" border="0" /></a>
				<a href="/admin/clients/delete/<?php echo $c['Client']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="" border="0" /></a>
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
