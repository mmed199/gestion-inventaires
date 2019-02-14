<?php $site_url = Configure::read('site_url');	?>
<!-- MODULE Home Featured Annonce -->
<section>
	<h4><span><?php __d('demandes',"Dernières demandes de nos clients") ; ?></span></h4> 
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_tous_services" data-toggle="tab">Tous les services</a></li>
			<li><a href="#tab_services_pro" data-toggle="tab">Services professionnels</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_tous_services">
				<div class="row" style ="margin-left: 12px;">
					<?php 
						$i = 1;
						foreach ($demandes['Tous'] as $d) :
									$this->set ('d',$d);
									?>
							<?php 
								$this->set('num_slide',$i);
								echo $this->element('demandes') ; 				
								$i++; ?>
						
					<?php endforeach; ?>
				</div>								
				<div style="padding: 20px;">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- services -->
						<ins class="adsbygoogle"
						     style="display:inline-block;width:728px;height:90px"
						     data-ad-client="ca-pub-3687705350117181"
						     data-ad-slot="4057931151"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>	 
				<?php if(!empty($demandes['Tous']) ) : ?>
				<section class="page_product_box toggle_frame more_info_inner">
					<a href="<?php echo $site_url; ?>/demandes"><h3 class="toggle">Voir toutes les demandes &raquo;</h3></a>
				</section>
				<?php else: ?>
				<p>Aucune demande trouvée </p> 
				<?php endif; ?>
			</div>

			<div class="tab-pane" id="tab_services_pro">
				<div class="row" style ="margin-left: 12px;">
					<?php 
						$i = 1;
						foreach ($demandes['Pro'] as $d) :
									$this->set ('d',$d);
									?>
							<?php 
								$this->set('num_slide',$i);
								echo $this->element('demandes') ; 				
								$i++; ?>
						
					<?php endforeach; ?>
				</div> 			
				<?php if(!empty($demandes['Pro']) ) : ?>
				<section class="page_product_box toggle_frame more_info_inner">
					<a href="<?php echo $site_url; ?>/demandes"><h3 class="toggle">Voir toutes les demandes &raquo;</h3></a>
				</section>
				<?php else: ?>
				<p>Aucune demande professionnelle trouvée </p> 
				<?php endif; ?>
			</div>
		</div>
	</div>	 
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