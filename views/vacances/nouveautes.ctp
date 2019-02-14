<?php $site_url = Configure::read('site_url');

?>
<?php echo $this->element('header_top-marques') ; ?>
<h1 class="pagetitle"><?php echo $balise_h1 ; ?> </h1> 
<div id="main">			
	<div id="large-block-rechercher">
		<div id="logo-marque"> 
			
		</div>
		<?php echo $this->element('search_form'); ?>
	</div>
	<?php if(!empty( $produits ) ) : ?>
		 
			<div id="list-prod-header-tri">
				Trier par :  <b><?php echo $paginator->sort('Nouveauté','Produit.date') ; ?> - <?php echo $paginator->sort('Prix','Produit.prix') ; ?> </b>  
			</div>
			<div id="list-prod">
				<p>
					Nous vous proposons une liste de <?php echo $this->Paginator->counter(array('format' => '%count%' ));?> articles sélectionnés par Stéphanie. Les meilleurs articles de <?php echo isset($categorie_nom) ? $categorie_nom : "vêtements" ;?> de nos créateurs de mode enfantine et nos magasins de  <?php echo isset($categorie_nom) ? $categorie_nom : "vêtements" ;?>  de marques pour enfants ont été sélectionnés. Venez vite les découvrir et profiter des prix soldés !!
				</p>
			<?php echo $this->element('liste_produits') ; ?>
			</div>
		 
	<?php else: ?>
	Aucune  article trouvée. 
	<?php endif; ?>
</div>


