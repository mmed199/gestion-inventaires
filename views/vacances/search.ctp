<?php 
	$site_url = Configure::read('site_url');
	unset($this->params['url']['url'] ) ;
$this->Paginator->options['url']['?'] = $this->params['url'];

?>
<?php //echo $this->element('header_top-marques') ; 
if (isset($balise_h1)) :?>
<h1 class="pagetitle"><?php echo $balise_h1 ; ?> </h1>
<?php endif;?>
 
<div id="main">			
	<div id="large-block-rechercher">
		<div id="logo-marque">
			
		</div>
		<?php echo $this->element('search_form'); ?>
	</div>
		<div class="large-block-search">
			<?php if(!empty( $produits ) ) : ?>
				<div id="list-prod">
					<div id="list-prod-header">
						<div id="list-prod-header-texte">
							<p>
								<?php if (isset($texte)) :
									echo $texte .'<br>';									
								endif;?>
							<?php __d('produits',"Nous vous proposons") ; ?> <?php echo $this->Paginator->counter(array('format' => '%count%' ));?> <?php __d('produits',"bijoux") ; ?>. <br>
							</p>
						</div>
						<div id="list-prod-header-tri">
							<?php __d('produits',"Trier par :") ; ?>  <b><?php echo $paginator->sort(__d('produits','Nouveauté',true),'Produit.date') ; ?> - <?php echo $paginator->sort(__d('produits','Prix',true),'Produit.prix') ; ?> </b>  
						</div>
						
					</div>
					<?php echo $this->element('liste_produits') ; ?>
				</div> 
			<?php else: ?>
			<?php __d('produits',"Aucun  article trouvé.") ; ?> 
			<?php endif; ?>
		</div>
		
	</div>