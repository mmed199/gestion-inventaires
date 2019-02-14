<?php $site_url = Configure::read('site_url');
$this->set('page_title', "Mes bijoux préférés | Services4all.fr" ) ; 
?>
<?php //echo $this->element('header_top-marques') ; ?>
<h1 class="pagetitle">Mes bijoux préférés </h1> 
<br/>
<p>
Grâce à "Mes bijoux préférés" vous pourrez: <br/>
<ul>
	<li>- Garder en mémoire vos idées cadeaux pour un achat futur. </li>
	<li>- Envoyer à quelqu'un une sélection pour lui demander son avis. </li>
	<li>- Envoyer une sélection à la personne à qui vous souhaitez faire un cadeau pour qu'elle choisisse directement le bijou qui lui plaît.</li>
</ul>	
</p>
<br/>

<div id="main">			
	<div id="large-block-rechercher">
		<div id="logo-marque"> 
			
		</div>
		<?php // echo $this->element('search_form'); ?>
	</div>
	<?php if(!empty( $produits ) ) : ?>
		 
			<div id="list-prod-header-tri">
				Trier par :  <b><?php echo $paginator->sort('Nouveauté','Produit.date') ; ?> - <?php echo $paginator->sort('Prix','Produit.prix') ; ?> </b>  
			</div>
			<div id="list-prod">
				<p>
				</p>
				<?php $hasPages = ($paginator->counter(array('format' => '%count%' )) >20)? true:false;?>
				<div id="pagination">
					<center>
						<?php if ($hasPages ) echo $paginator->prev('<< Précédent', array('escape' => false, 'class' => 'prev'), null, array('class'=>'disabled'));?>
						<?php echo $paginator->numbers(array('separator' => '  ')); ?> 
						<?php if ($hasPages ) echo $paginator->next('Suivant >>', array('escape' => false, 'class' => 'next'), null, array('class'=>'disabled'));?>	
					</center>
				</div>

				<?php foreach ($produits as $p) {
					$this->set ('p',$p);
					?>
					<?php echo $this->element('sproduit-prefere') ; ?>
					<div class="sparator-prod"></div>
				<?php } ?>

				<div id="pagination">
					<center>
						<?php if ($hasPages ) echo $paginator->prev('<< Précédent', array('escape' => false, 'class' => 'prev'), null, array('class'=>'disabled'));?>
						<?php echo $paginator->numbers(array('separator' => '  ')); ?> 
						<?php if ($hasPages ) echo $paginator->next('Suivant >>', array('escape' => false, 'class' => 'next'), null, array('class'=>'disabled'));?>	
					</center>
				</div>
			</div>
		<a href="/preferes/envoyer" style="display:inline-block;float:right;">Envoyer mes bijoux préférés</a>		 
	<?php else: ?>
	<div style="background-color:#cccccc;padding:10px;" ><br/>
	<b>Vous n'avez pas de bijoux sauvegardé.</b><br/>
	Lors de vos recherches, si vous trouvez un bijoux qui vous interpelle, il vous est possible de la sauvegarder en cliquant sur l'onglet "<b>Ajouter à mes bijoux préférés</b>".
	</div>
	<?php endif; ?>
</div>