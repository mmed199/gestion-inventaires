<?php 
	//$paginator->options(array('url' => $this->passedArgs)); 

	$site_url = Configure::read('site_url');
?>
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page">
			<?php if (!isset($is_search_page)){?>
				<a href="/vacances" title="Toutes les vacances" rel="tooltip">Vacances</a>
				<span class="navigation-pipe" >&gt;</span>
				<span class="navigation_page">Rechercher</span>
			<?php } else{ ?>
				Vacances
			<?php } ?>
		</span>
	</div>
</div>
<!-- /Breadcrumb -->
<section>
	<h1>
		<span><?php echo $balise_h1 ; ?></span><?php echo $form->hidden('Vacance.id') ; ?>	
	</h1>
	<div class="sortPagiBar shop_box_row shop_box_row_other clearfix">
		<?php echo $this->element('search_form_vacances'); ?>
	</div>
	<?php 
	if(empty($vacances)) echo '<p class="warning"><span><i class="icon-exclamation-sign"></i></span> Votre recherche n\'a donné aucun résultat</p>';
	else { ; ?>		
		
		<div class="row" style ="margin-left: 12px;">
			<?php foreach ($vacances as $v) : ?>
			<div class="clearfix back-divcontent"> 
				<div class="div-transparent date">
					<span>
						<i class="icon-calendar"></i> <?php 

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
					<span class="small-menu">  <?php if(!empty($v['City']['nom']) ) : ?>Vacance /  <i class="icon-map-marker"></i> <?php echo $v['City']['nom']; ?><?php endif; ?>
					</span>
				</div>
				<br>
				<div class="div-badge">
					<?php if ($v['Vacance']['vue'] > 1){ ?>
						<span class="badge"> <?php echo $v['Vacance']['vue']; ?> Vues</span>
					<?php }elseif ($v['Vacance']['vue'] == 1){ ?>
						<span class="badge"><?php echo $v['Vacance']['vue']; ?> Vue</span>
					<?php }; ?>
				</div>
				<div class="pull-left">		
					<a href="<?php echo $site_url."/vacances/".$v['Vacance']['slug']."-".$v['Vacance']['id'].".html";?>" title="Voir détails" rel="tooltip" data-placement="bottom" data-original-title="<?php echo $v['Vacance']['titre']; ?>" ><img  src="<?php echo "/uploads/vacances/".$v['Vacance']['image'];?>" alt="<?php echo  $v['Vacance']['titre'];?>" class="img-polaroid cadre_img" /></a>
				</div>
				<div> 
					<div>
						<h3><span><a href="<?php echo $site_url."/vacances/".$v['Vacance']['slug']."-".$v['Vacance']['id'].".html";?>" title="" ><?php echo $v['Vacance']['titre']; ?></a></span></h3>		    
					    <!-- <span class="price"><img src="/img_all/icon/icon-price.png" alt="" /><?php echo number_format($v['Vacance']['budget'] , 0, '.', ' ');?>Dhs</span>	 -->
						<div class="div-content-service">
					    	<?php 
								if(strlen($v['Vacance']['description'] ) < 150) 
									echo $v['Vacance']['description'] ;
								else echo substr($v['Vacance']['description'] , 0, 150).' [...]';
							?>
						</div>
						<div>
							<div class="small-menu small-place">
								<a href="<?php echo $site_url."/vacances/".$v['Vacance']['slug']."-".$v['Vacance']['id'].".html";?>" title="Répondre à cette demande" rel="tooltip" data-placement="bottom">
									<span class="icon"><i class="icon-share-alt"></i> Répondre</span>
								</a>	
								<a href="#" title="Ajouter à ma liste favori" rel="tooltip" data-placement="bottom">
									<span class="icon small-menu"><i class="icon-star"></i> Favori</span>
								</a>
								<!-- <span style ="margin-left: 260px;">&nbsp;</span> -->
								<a href="http://www.facebook.com/sharer.php?u=<?php echo $site_url."/vacances/".$v['Vacance']['id'].".html";?>&amp;t=<?php echo $v['Vacance']['titre']; ?>" target="_blank">
									<span class="icon small-menu"><i class="icon-white icon-facebook"></i> Partager</span>	
								</a>	
								<!-- <a href="#" onclick="window.open('http://twitter.com/share?text=<?php echo $site_url;?>&url=<?php echo $v['Vacance']['titre']; ?>', 'Partager en Twitter'); return false;">
												<span class="icon small-menu"><i class="icon-white icon-twitter"></i> Twitter</span>	
											</a> -->			
							</div>				
							<p>	
								<a href="<?php echo $site_url."/vacances/".$v['Vacance']['slug']."-".$v['Vacance']['id'].".html";?>" style ="float: right;">Voir détails &raquo;</a>
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