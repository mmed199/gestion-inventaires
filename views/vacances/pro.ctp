<?php 

$site_url = Configure::read('site_url');

?>

<div id="main">			
	<h1 class="title_search"><?php echo $boutique['Boutique']['nom'] ; ?>  : vêtement enfant</h1>
	<div id="entete-boutique" style="height:auto;">
        <div id="pagevendeur-col-1">
			<?php if (file_exists ("uploads/boutiques/" . $boutique['Boutique']['image']) ) :?>
					<img src="/uploads/boutiques/<?php echo $boutique['Boutique']['image'] ; ?>" alt="<?php echo $boutique['Boutique']['nom'] ; ?>" />
			<?php endif;?>
		</div>
		<div id="pagevendeur-col-2">
			<div><span class="blue">Vendeur :</span> <?php echo $boutique['Boutique']['nom'] ; ?> </div>
			<div><span class="blue">Type de vendeur :</span> Professionnel</div>
			<div><span class="blue">Ville :</span> <?php echo $boutique['Boutique']['ville'] ; ?> </div>
			<div><span class="blue">Membre depuis le : </span><?php echo date('d/m/Y', strtotime( $boutique['Seller']['created'])) ; ?></div>
		</div>
		<div id="pagevendeur-col-3">
                <!--<p><span class="blue">Marques préférées :</span> Particulier</p>-->
                <div><span class="blue">Blog / Site :</span> 
					<?php if ($boutique['Boutique']['site_url'] != "") : ?>
						<a target="_black" href="http://<?php echo $boutique['Boutique']['site_url'];?>" alt="<?php echo $boutique['Boutique']['nom'];?>"><?php echo $boutique['Boutique']['site_url'];?></a>
					<?php endif;?>
				<!--<p><span class="blue">Intérêts :</span> </p>-->
            </div>
			<div class="clear0"></div>
		</div>
        <?php
		$current_page = $paginator->counter(array('format' => '%page%'));
		if ($current_page == 1 or $current_page == "") {	
		?>
			<div id="description">
					<div class="justify"><p><?php echo $boutique['Boutique']['description'] ; ?></p></div>
			</div>
			
		<?php
			}
		?>  
    </div>
	
	
	
	<div class="large-block-search">
			<div id="list-prod">
				<div id="list-prod-header">
					<div id="list-prod-header-texte">
						<p>
						Nous vous proposons <?php echo $this->Paginator->counter(array('format' => '%count%' ));?> articles de la boutique <b><?php echo $boutique['Boutique']['nom'] ; ?></b> de la mode enfant. <br>
						</p>
					</div>
					<div id="list-prod-header-tri">
						Trier par :  <b><?php echo $paginator->sort('Nouveauté','Produit.date') ; ?> - <?php echo $paginator->sort('Prix','Produit.prix') ; ?> </b>  
					</div>
					
				</div>
				<?php echo $this->element('liste_produits') ; ?>
			</div>
	</div>
	
	</div>
</div>