<?php
function afficher_date($ma_date ){
	$date_str_replace = str_replace("/","-",$ma_date );
	$liste_mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
    $datefr_j_mois = date("d",strtotime($date_str_replace))." ".$liste_mois[date("n",strtotime($date_str_replace))] ; 
											
	$date = date('Y-m-d',strtotime($date_str_replace));
	$date_aujourdhui = date('Y-m-d');
	$date_hier = date('Y-m-d', strtotime(date('Y-m-d').' - 1 DAY'));
	if ( $date  == $date_aujourdhui )
		echo  date("H\hi", strtotime($date_str_replace));//on met que heure et munite pour aujourd'hui
	else
		if ( $date  >= $date_hier)
			echo "Hier à " . date('H\hi', strtotime($date_str_replace ) );
		else
			echo date('d/m/Y',strtotime($date_str_replace));			
}
?>
<div id="contenu-entete">
	<div id="contenu-titre">
		<h2><?php echo $balise_h1;?></h2>
	</div>
	<div id='contenu-actions'>
		<a href="/admin/members/ajouter" title="Ajouter"><img src="/_admin/img/add.png" width="22px" height="22px"/></a>
		<a href="#"><img src="/_admin/img/print.png" alt="Imprimer"></a>
		<a href="#"><img src="/_admin/img/excel.png" alt="Exporter"></a>
	</div>
</div>
<div class="sidebar_search">
	<?php echo $form->create('Member',array('action'=>'rechercher') ) ; ?>
	<?php echo $form->input('query',array('class'=>'search_input','value'=>"Rechercher ..." ,'onclick'=>"this.value=''",'label'=>false) ) ; ?>
	<input type="image" class="search_submit" src="/_admin/images/search.png" />
	<?php echo $form->end() ; ?>
</div>  
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"><?php echo $this->Paginator->sort('Id', 'Member.id'); ?></th>
        	<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nom & Prénom', 'Member.nom'); ?></th>
			<th scope="col" class="rounded" width="100"><?php echo $this->Paginator->sort('Société', 'Member.societe'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort("Inscrit", 'Member.created'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Ville', 'City.nom'); ?></th>
            <th scope="col" class="rounded"><?php echo $this->Paginator->sort('Email', 'Member.email'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Nbr Annonce', 'Member.annonce_count'); ?></th>
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Active', 'Member.active'); ?></th>          
			<th scope="col" class="rounded"><?php echo $this->Paginator->sort('Vérifier', 'Member.verified'); ?></th>          
			<th scope="col" class="rounded-q4" width="100"></th>
        </tr>
    </thead>
        <tfoot>
    	</tfoot>
    <tbody>
	   <?php foreach($members as $m ) : ?>
    	<tr>
    		<td>
				<a href="/admin/members/afficher/<?php echo $m['Member']['id'] ; ?>">
					<img class="produit-vignette" style="max-width:60px;max-height:60px;" src="/uploads/members/<?php echo $m['Member']['logo'] ; ?>"/>
					<br>
					<?php echo $m['Member']['id'] ; ?>
				</a>
			</td>
        	<td><?php echo $m['Member']['nom'] ; ?>&nbsp;&nbsp;<?php echo $m['Member']['prenom'] ; ?></a></td>
			 <!-- <td><?php echo $m['Member']['type_compte'] == 0 ?'Client': 'Pro'; ?></td> -->
			 <?php if($m['Member']['type_compte']==0) {?>
			 <td>Client</td>
			 <?php } else{ ?> 
			 <td width="100"><?php echo $m['Member']['societe'] ; ?></td> 
			 <?php } ?> 
			<td><?php echo afficher_date($m['Member']['created']) ; ?></td>
			<td><?php echo $m['City']['nom'] ; ?></td>            
            <td><?php echo $m['Member']['email'] ; ?></td>
			<!-- <td><?php echo $m['Member']['telephone'] ; ?></td> -->
			<td><?php echo $m['Member']['annonce_count'] ; ?></td>			
			<td><a href="/admin/members/<?php echo ($m['Member']['active'] ==  1 ? 'desactiver':'activer');?>/<?php echo $m['Member']['id'] ; ?>"><?php echo ($m['Member']['active'] == 1 ?"<img src='/_admin/img/rond_v.png' title='Désactiver' />" : "<img src='/_admin/img/rond_r.png' title='Activer'/>" ); ?></a></td>

			<?php if ($m['Member']['type_compte']==1){ ?>

				<?php if($m['Member']['verified']==2) {?>
				<td><a href="/admin/members/verifier/<?php echo $m['Member']['id'] ; ?>"><img style='width:24px;' src='/_admin/img/instance.png' title='Vérifié'/></a></td>
				<?php }else if ($m['Member']['verified']==1) { ?>
				<td><a href="/admin/members/non_verifier/<?php echo $m['Member']['id'] ; ?>"><img style='width:24px;'src='/_admin/img/verifier.png' title="Annuler la vérification"/></a></td>
				<?php } else { ?>
				<td><img src='/_admin/img/not_validate.png' title="Pas de demande de vérification"/></td>

			<?php } } else { ?>		
				<td><img style='width:22px;' src='/_admin/img/interdit.png' title="Client"/></td>
			<?php } ?> 
			<td class="rounded-right" style="width:100px;">
				<a href="/admin/members/afficher/<?php echo $m['Member']['id'] ; ?>"><img src="/_admin/img/more.png" alt="Afficher" title="" border="0" /></a>
				<a href="/admin/members/modifier/<?php echo $m['Member']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="Modifier" title="" border="0" /></a>
				<a href="/admin/members/delete/<?php echo $m['Member']['id'] ; ?>" class="ask"><img src="/_admin/img/delete.png" alt="Supprimer" title="" border="0" /></a>
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
