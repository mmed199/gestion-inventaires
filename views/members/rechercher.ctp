<?php 
	$site_url = Configure::read('site_url');
?>
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page"><a href="/annuaire-des-professionnels" title="Annuaire des professionnels" rel="tooltip">Annuaire des professionnels</a></span>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page">Rechercher</span>
	</div>
</div> 
<!-- /Breadcrumb -->
<section>
	<h1>
		<span>Rechercher</span>
	</h1>
	<div class="sortPagiBar shop_box_row shop_box_row_other clearfix">
		<?php echo $this->element('search_form_pro'); ?>
	</div>
	<?php 
	if(empty($professionnels)) echo '<p class="warning"><span><i class="icon-exclamation-sign"></i></span> Votre recherche n\'a donné aucun résultat</p>';
	else { ; ?>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<div class="tab-content">
			<div class="tab-pane active" id="tab_tous_services">
				<div class="row" style ="margin-left: 12px;">
					<?php foreach ($professionnels as $p) : ?>
					<div class="clearfix back-divcontent">  
						<!-- <div class="div-transparent date">
							<span>
								<i class="icon-calendar"></i> <?php 
						
								$date = str_replace("/","-",$d['Demande']['created'] );
								
								$datefr_j_mois = date("d/m/Y",strtotime($date)) ; 
																		
								$date_annonce = date('Y-m-d',strtotime($date));
						
								$date_aujourdhui = date('Y-m-d');
						
								$date_hier = date('Y-m-d', strtotime(date('Y-m-d').' - 1 DAY'));
						
								if ( $date_annonce  == $date_aujourdhui )
									echo "Aujourd'hui à ". date('H\hi', strtotime($date));
								else
								if ( $date_annonce  >= $date_hier)
									echo "Hier à ". date('H\hi', strtotime($date));
								else
									echo "Le $datefr_j_mois";?> 
							</span>
						</div> -->
						<div class="div-transparent type-pro">
							<span class="small-menu"><?php echo $p['Ptype']['nom']; ?>  <?php if(!empty($p['City']['nom']) ) : ?>/  <i class="icon-map-marker"></i> <?php echo $p['City']['nom']; ?><?php endif; ?>
							</span>
						</div>
						<br>
						<div class="div-badge">
							<?php if ($p['Member']['annonce_count'] > 1){ ?>
						  	 		<span class="badge badge-info"><?php echo $p['Member']['annonce_count']; ?> Annonces</span>
						  	<?php }elseif ($p['Member']['annonce_count'] == 1){ ?>
						  	 	  	<span class="badge badge-info">Une Annonce</span>
						  	<?php }; ?>

				           <?php if ($p['Member']['vue'] > 1){ ?>
						  	 		<span class="badge"><?php echo $p['Member']['vue']; ?> Vues</span>
						  	<?php }elseif ($p['Member']['vue'] == 1){ ?>
						  	 	  	<span class="badge"><?php echo $p['Member']['vue']; ?> Vue</span>
						  	<?php }; ?>

				           <?php if ($p['Member']['demande_devi'] > 1){ ?>
						  	 		<span class="badge badge-important"><?php echo $p['Member']['demande_devi']; ?> Demandes devis</span>
						  	<?php }elseif ($p['Member']['demande_devi'] == 1){ ?>
						  	 	  	<span class="badge badge-important"><?php echo $p['Member']['demande_devi']; ?> Demande devis</span>
						  	<?php }; ?>
						</div>
						<div class="pull-left">
							<?php if($p['Member']['verified']==1 ){ ?>
							<img src="/img/verified-pro.png" alt="Vérifié"  rel="tooltip" data-placement="bottom" data-original-title="Vérifié" class="icon-verified">
							<?php }; ?>
							<a href="/annuaire-des-professionnels/<?php echo $p['Pcategory']['slug'];?>/<?php echo $p['Ptype']['slug'];?>/<?php echo $p['Member']['id'];?>.html" >
								<img  src="/uploads/members/<?php echo $p['Member']['logo'];?>" alt="<?php echo $p['Member']['societe'];?>" class="img-polaroid cadre_img" rel="tooltip" data-placement="bottom" data-original-title="Voir détails" />
							</a>
						</div>
						<div> 
							<div>
								<h3><span><a href="/annuaire-des-professionnels/<?php echo $p['Pcategory']['slug'];?>/<?php echo $p['Ptype']['slug'];?>/<?php echo $p['Member']['id'];?>.html" title="" ><?php echo $p['Member']['societe']; ?></a></span></h3>
								<?php if(!empty($p['Member']['titre_annuaire'])){ ?>
									<span class="titre_annuaire"><?php echo $p['Member']['titre_annuaire'];?></span>
								<?php }; ?>
								<div class="div-content-service">
							    	<?php 
										if(strlen($p['Member']['description']) < 150) 
											echo $p['Member']['description'];
										else echo substr($p['Member']['description'], 0, 150).' [...]';
									?>
								</div>
								<div>			
									<p>	
										<a href="/annuaire-des-professionnels/<?php echo $p['Pcategory']['slug'];?>/<?php echo $p['Ptype']['slug'];?>/<?php echo $p['Member']['id'];?>.html" style ="float: right;">Voir détails &raquo;</a>
									</p>
									<!-- <p><a class="button" href="#">View détails &raquo;</a></p> -->
									<!-- <a class="button " href="#"  rel="tooltip" data-placement="bottom" style ="margin-left: 520px;">Voir</a>  -->				
								</div>	
							</div>
						</div>
					</div>
					<hr class="featurette-divider">
					<?php endforeach; ?>					
				</div>
			</div>
		</div>
	</div>
	<ul class="pager">
		<li><?php echo $paginator->prev('<< '.__('Précédent', true));?></li>
		<li><?php echo $paginator->numbers();?></li>
		<li><?php echo $paginator->next(__('Suivant', true).' >>');?></li>
	</ul>
	<?php } ?> 
</section>
<script>
		$(document).ready(function() {
			$(this).find(".addhomefeatured ul li .main-img").mouseover(function () { 
			$(this).next(".addhomefeatured ul li .next-img").stop(true, true).fadeIn(600, 'linear'); 
	  });  
	  $(".addhomefeatured ul li .next-img").mouseleave(function () { 
		  $(".addhomefeatured ul li .next-img").stop(true, true).fadeOut(600, 'linear');
	  });
	});
</script>