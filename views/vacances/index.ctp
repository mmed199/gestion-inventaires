
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page">Vacances</span>
	</div>
</div>
<!-- /Breadcrumb -->
<section>
	<h1>
		<span><?php __d('demandes',"Toutes les annonces vacances") ; ?></span>
	</h1>
	<div class="sortPagiBar shop_box_row shop_box_row_other clearfix">
		<?php echo $this->element('search_form_vacances'); ?>
	</div>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<div class="tab-content">
			<div class="tab-pane active" id="tab_tous_services">
				<div class="row" style ="margin-left: 12px;">
					<?php foreach ($vacances as $v) : ?>

						<?php
							$site_url = Configure::read('site_url');
							$id_vacance = $v['Vacance']['id'];
							$vacance_nom = $v['Vacance']['titre'];
							$vue = $v['Vacance']['vue'];
							$vacance_slug = $v['Vacance']['slug'];
							$vacance_ville = $v['City']['nom'];

							$vacance_url = $site_url."/vacances/".$vacance_slug."-".$id_vacance.".html";
							$budget = number_format($v['Vacance']['budget'] , 0, '.', ' ');
							$cheminPhoto = "";
							$cheminPhoto = "/uploads/vacances/".$v['Vacance']['image'];	

							$titre_vacance = $v['Vacance']['titre'] ;

							$altImage = $vacance_ville."-". $titre_vacance;		

							$description = $v['Vacance']['description'] ;
								  
						?>	

					<div class="clearfix back-divcontent">  
						<div class="div-transparent date">
							<span>
								<i class="icon-calendar" style="margin-left:18px;"></i> <?php 

								$date = str_replace("/","-",$v['Vacance']['created'] );
								
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
						</div>
						<div class="div-transparent">
							<span class="small-menu">  <?php if(!empty($vacance_ville) ) : ?>Vacance /  <i class="icon-map-marker"></i> <?php echo $vacance_ville; ?><?php endif; ?>
							</span>
						</div>
						<br>
						<div class="div-badge">
							<?php if ($vue > 1){ ?>
								<span class="badge"> <?php echo $vue; ?> Vues</span>
							<?php }elseif ($vue == 1){ ?>
								<span class="badge"><?php echo $vue; ?> Vue</span>
							<?php }; ?>
						</div>
						<div class="pull-left">		
							<a href="<?php echo $site_url."/vacances/";?>
									<?php if(!empty($v['Vacance']['slug'])) { ?>
									<?php echo $v['Vacance']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $v['Vacance']['id'].".html";?>" ><img title="Voir détails" rel="tooltip" data-placement="bottom" data-original-title="<?php echo $titre_vacance; ?>"  src="<?php echo $cheminPhoto;?>" alt="<?php echo $altImage;?>" class="img-polaroid cadre_img" /></a>
						</div>
						<div> 
							<div>
								<h3><span><a href="<?php echo $site_url."/vacances/";?>
									<?php if(!empty($v['Vacance']['slug'])) { ?>
									<?php echo $v['Vacance']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $v['Vacance']['id'].".html";?>" title="" ><?php echo $titre_vacance; ?></a></span></h3>		    
							    <!-- <span class="price"><img src="/img_all/icon/icon-price.png" alt="" /><?php echo $budget;?>Dhs</span>	 -->	
								<div class="div-content-service">
							    	<?php 
										if(strlen($description) < 150) 
											echo $description;
										else echo substr($description, 0, 150).' [...]';
									?>
								</div>
								<div>
									<div class="small-menu small-place">										
										<a href="<?php echo $site_url."/vacances/";?>
									<?php if(!empty($v['Vacance']['slug'])) { ?>
									<?php echo $v['Vacance']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $v['Vacance']['id'].".html";?>" title="Déposer une réservation à cette offre" rel="tooltip" data-placement="bottom">
											<span class="icon"><i class="icon-share-alt"></i> Réserver</span>
										</a>										
										<a href="#" title="Ajouter à ma liste favori" rel="tooltip" data-placement="bottom">
											<span class="icon small-menu"><i class="icon-star"></i> Favori</span>
										</a>
										<!-- <span style ="margin-left: 260px;">&nbsp;</span> -->
										<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $site_url;?>&t=<?php echo $titre_vacance; ?>', 'Partager en Facebook'); return false;">
											<span class="icon small-menu"><i class="icon-white icon-facebook"></i> Partager</span>	
										</a>	
										<!-- <a href="#" onclick="window.open('http://twitter.com/share?text=<?php echo $site_url;?>&url=<?php echo $titre_vacance; ?>', 'Partager en Twitter'); return false;">
														<span class="icon small-menu"><i class="icon-white icon-twitter"></i> Twitter</span>	
													</a> -->			
									</div>				
									<p>	
										<a href="<?php echo $site_url."/vacances/";?>
									<?php if(!empty($v['Vacance']['slug'])) { ?>
									<?php echo $v['Vacance']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $v['Vacance']['id'].".html";?>" style ="float: right;">Voir détails &raquo;</a>
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