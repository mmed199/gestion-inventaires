<?php 

$site_url = Configure::read('site_url');

?>

<div id="main">			
	<h1 class="title_search"><?php echo $balise_h1; ?></h1>
	<div id="entete-boutique" style="height:auto;">
        <div id="pagevendeur-col-1">
			<?php if (file_exists ("uploads/members/" . $member['Seller']['logo']) ) :?>
					<img src="/uploads/members/<?php echo $member['Seller']['logo'] ; ?>" alt="<?php echo $member['Seller']['nom'] ; ?>" />
			<?php endif;?>
		</div>
		<div id="pagevendeur-col-2">
			<div><span class="blue">Vendeur :</span> <?php echo $member['Seller']['pseudo'] ; ?> </div>
			<div><span class="blue">Type de vendeur :</span> Particulier</div>
			<div><span class="blue">Ville :</span> <?php echo $member['Seller']['ville'] ; ?> </div>
			<div><span class="blue">Membre depuis le : </span><?php echo date('d/m/Y', strtotime( $member['Seller']['created'])) ; ?></div>
		</div>
		
        <?php
		$current_page = $paginator->counter(array('format' => '%page%'));
		if ($current_page == 1 or $current_page == "") {	
		?>
			
			
		<?php
			}
		?>  
    </div>
	
	
	
	<div class="large-block-search">
			<div id="list-prod">
				<div id="list-prod-header">
					<div id="list-prod-header-texte">
						<p>
						Nous vous proposons <?php echo $this->Paginator->counter(array('format' => '%count%' ));?> articles du vendeur <b><?php echo $member['Seller']['pseudo'] ; ?></b> de la mode enfant. <br>
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