<?php $site_url = Configure::read('site_url'); ?>	
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page"><a href="/offres" title="Toutes les offres" rel="tooltip">Offres</a></span>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page"><?php echo $dcategorie_nom ; ?></span>
	</div>
</div>
<!-- /Breadcrumb -->
<section>
	<h1>
		<span><?php echo $dcategorie_nom ; ?></span>
	</h1>
	<div class="sortPagiBar shop_box_row shop_box_row_other clearfix">
		<?php echo $this->element('affiner_recherche_offre'); ?>
	</div>
	<?php 
	if(empty($offres)) echo '<p class="warning"><span><i class="icon-exclamation-sign"></i></span> Votre recherche n\'a donné aucun résultat</p>';
	else { ; ?>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<div class="tab-content">
			<div class="tab-pane active" id="tab_tous_services">
				<div class="row" style ="margin-left: 12px;">
					<?php foreach ($offres as $o) : ?>
					<div class="clearfix back-divcontent"> 
						<div class="div-transparent date">
							<span>
								<i class="icon-calendar" style="padding:10px;"></i> <?php 

									$date = str_replace("/","-",$o['Demande']['created'] );

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
						<div class="div-transparent type">
							<a href="<?php echo $site_url."/demandes/".$o['Dcategory']['slug'] ."/".$o['Dtype']['slug']; ?>.html" title="">
								<span><?php echo $o['Dtype']['nom']; ?> </span>
							</a>
						</div>
						<div class="div-transparent ville">
							<span class="small-menu">  <?php if(!empty($o['City']['nom']) ) : ?>/  <i class="icon-map-marker"></i> <?php echo $o['City']['nom']; ?><?php endif; ?>
							</span>
						</div>
						<div style="float:right; padding:4px;">
							<?php if ($o['Demande']['reponse'] > 1){ ?>
						  	 		<span class="badge badge-info"><?php echo $o['Demande']['reponse']; ?> Réponses</span>
						  	<?php }elseif ($o['Demande']['reponse'] == 1){ ?>
						  	 	  	<span class="badge badge-info">Une Réponse</span>
						  	 <?php }; ?>
						</div>
						<div class="pull-left">		
							<a href="<?php echo $site_url."/demandes/".$o['Dcategory']['slug'] ."/".$o['Dtype']['slug'] ."/".$o['Demande']['slug']."-".$o['Demande']['id'].".html";?>" title="Voir détails" rel="tooltip" data-placement="bottom" data-original-title="<?php echo $o['Demande']['nom']; ?>" ><img  src="<?php echo "/uploads/demandes/".$o['Demande']['image'];?>" alt="<?php echo $o['Dtype']['nom'] . " ". $o['Demande']['nom'];?>" class="img-polaroid cadre_img" /></a>
						</div>
						<div> 
							<div>
								<h3><span><a href="<?php echo $site_url."/demandes/".$o['Dcategory']['slug'] ."/".$o['Dtype']['slug'] ."/".$o['Demande']['slug']."-".$o['Demande']['id'].".html";?>" title="" ><?php echo $o['Demande']['nom']; ?></a></span></h3>		    
							    <!-- <span class="price"><img src="/img_all/icon/icon-price.png" alt="" /><?php echo number_format($o['Demande']['budget'] , 0, '.', ' ');?>Dhs</span>	 -->	
								<p class="lnk">
									<?php echo $o['Demande']['descDemande'] ; ?>
								</p>
							</div>
							<div>
								<div class="small-menu">
									<a href="#" title="Répondre à cette demande" rel="tooltip" data-placement="bottom">
										<span class="icon"><i class="icon-share-alt"></i> Répondre</span>
									</a>	
									<a href="#" title="Ajouter à ma liste favori" rel="tooltip" data-placement="bottom">
										<span class="icon small-menu"><i class="icon-star"></i> Favori</span>
									</a>
									<!-- <span style ="margin-left: 260px;">&nbsp;</span> -->
									<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $site_url;?>&t=<?php echo $o['Demande']['nom']; ?>', 'Partager en Facebook'); return false;">
										<span class="icon small-menu"><i class="icon-white icon-facebook"></i> Facebook</span>	
									</a>	
									<!-- <a href="#" onclick="window.open('http://twitter.com/share?text=<?php echo $site_url;?>&url=<?php echo $o['Demande']['nom']; ?>', 'Partager en Twitter'); return false;">
													<span class="icon small-menu"><i class="icon-white icon-twitter"></i> Twitter</span>	
												</a> -->			
								</div>				
								<p>	
									<a href="<?php echo $site_url."/demandes/".$o['Dcategory']['slug'] ."/".$o['Dtype']['slug'] ."/".$o['Demande']['slug']."-".$o['Demande']['id'].".html";?>" style ="float: right;">Voir détails &raquo;</a>
								</p>
								<!-- <p><a class="button" href="#">View détails &raquo;</a></p> -->
								<!-- <a class="button " href="#"  rel="tooltip" data-placement="bottom" style ="margin-left: 520px;">Voir</a>  -->				
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