<div id="contenu-entete">
	<div id="contenu-titre">
		<h2><?php echo $balise_h1;?></h2>
	</div>
</div>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead> 
    	<tr>
        	<th scope="col" class="rounded-company"><?php echo $this->Paginator->sort('Id', 'Message.id'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Objet', 'Message.objet'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Date', 'Message.date'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Envoyé par', 'Message.nom'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Email', 'Message.email'); ?></th>
			<th scope="col" class="rounded-q4">&nbsp;</th>
        </tr>
    </thead> 
        <tfoot>
    	<tr>
        	<td colspan="7" class="rounded-foot-left">				
			</td>
        	<td class="rounded-foot-right">&nbsp;</td>		
        </tr>
    </tfoot>
    <tbody id="test-list">
	   <?php foreach($messages as $m ) : ?>
    	<tr id="listItem_<?php echo $m['Message']['id'] ; ?>" >
        	<td><a href="/admin/messages/afficher/<?php echo $m['Message']['id'] ; ?>"><?php echo $m['Message']['id'] ; ?></a></td>
			<td><?php echo $m['Message']['objet'] ; ?></td>
			<td><?php echo date("d/m/y h\Hi",strtotime($m['Message']['date'])) ; ?></td>
			<td><?php echo $m['Message']['nom'] ; ?></td>
			<td><?php echo $m['Message']['email'] ; ?></td>
			<td class="rounded-right">
				<a href="/admin/messages/afficher/<?php echo $m['Message']['id'] ; ?>"><img src="/_admin/img/more.png" alt="Afficher" title="" border="0" /></a>
				<a href="/admin/messages/repondre/<?php echo $m['Message']['id'] ; ?>"><img src="/_admin/img/mail_reply.png" alt="Répondre" title="" border="0" /></a>
				<a href="/admin/messages/delete/<?php echo $m['Message']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="" border="0" /></a>
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