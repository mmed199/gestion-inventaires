<h2>Liste des questions réponses (FAQ)</h2>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead> 
    	<tr>
        	<th scope="col" class="rounded-company"><?php echo $this->Paginator->sort('Identifiant', 'Faq.id'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Question', 'Faq.title_question'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Langue', 'Faq.lang'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Position', 'Faq.position'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Catégorie', 'Cfaq.titre'); ?></th>
            <th scope="col" class="rounded" width="100px"></th>
			 <th scope="col" class="rounded-q4" width="15px"><a href="/admin/faqs/ajouter" class="bt_green"><img src="/_admin/img/add.png" width="22px" height="22px"/></a></th>
        </tr>
    </thead>
    <tbody id="test-list">
	   <?php foreach($faqs as $f ) : ?>
    	<tr id="listItem_<?php echo $f['Faq']['id'] ; ?>" >
        	<td><?php echo $f['Faq']['id'] ; ?></td>
			<td><?php echo $f['Faq']['title_question'] ; ?></td>
			<td><?php echo $f['Faq']['lang'] ; ?></td>
			<td><?php echo $f['Faq']['position'] ; ?></td>
			<td><?php echo $f['Cfaq']['titre'] ; ?></td>
			<td>
				<a href="/admin/faqs/afficher/<?php echo $f['Faq']['id'] ; ?>"><img src="/_admin/img/more.png" alt="afficher" title="" border="0" /></a>
				<a href="/admin/faqs/edit/<?php echo $f['Faq']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="Modifier" title="" border="0" /></a>
				<a href="/admin/faqs/delete/<?php echo $f['Faq']['id'] ; ?>" class="ask"><img src="/_admin/img/trash.png" alt="Supprimer" title="" border="0" /></a>
			</td>
			<td  class="rounded-right"></td>
			
	  </tr>
       <?php endforeach ; ?>
    </tbody> 
    <tfoot>
    	<tr>
        	<td colspan="6"></td>
        </tr>
    </tfoot>
</table>
<div class="pagination">
	<center>
		Page : 
		<?php echo $this->Paginator->counter(array( 'format' =>'<strong> %page% </strong> / %pages% ')) ; ?>
		<?php echo $paginator->numbers(array('separator' => ' ')); ?> 
	</center>
</div>