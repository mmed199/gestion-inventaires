<?php 
	$paginator->options(array('url' => $this->passedArgs)); 
	$site_url = Configure::read('site_url');		  
?>	
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page">Recherche</span>
	</div>
</div>
<!-- /Breadcrumb -->
<section> 
	<h1><?php echo $balise_h1 ; ?></h1>
	<div class="sortPagiBar shop_box_row shop_box_row_other clearfix">
		<?php echo $this->element('search_form'); ?>
	</div>
	<?php 
	if(empty($data)) echo '<p class="warning"><span><i class="icon-exclamation-sign"></i></span> Votre recherche n\'a donné aucun résultat</p>';
	else { 

	$tab_demande = array();
	$tab_job = array();
	$i = 0;
		foreach($data as $row):
            $model_name = key($row);
         
            switch($model_name)
            {
            	case 'Demande':		           
					$tab_demande[$i]['demande_url'] = $row['Demande']['id'];
					$tab_demande[$i]['id'] = $row['Demande']['id'];
		            $tab_demande[$i]['nom'] = $row['Demande']['nom'];
		            $tab_demande[$i]['reponse'] = $row['Demande']['reponse'];
		            $tab_demande[$i]['created'] = $row['Demande']['created'];
		            $tab_demande[$i]['ville'] = $row['City']['nom'];
					$tab_demande[$i]['image'] = $row['Demande']['image'];
		            $tab_demande[$i]['description'] = $row['Demande']['descDemande'];
		            $tab_demande[$i]['Demande_slug'] = $row['Demande']['slug'];
		            $tab_demande[$i]['Dcategory_slug'] = $row['Dcategory']['slug'];
		            $tab_demande[$i]['Dtype_slug'] = $row['Dtype']['slug'];
		            $tab_demande[$i]['Dtype_nom'] = $row['Dtype']['nom'];
		            
		            break;

		         /*case 'Job':
		            $tab_demande[$i]['link'] = $html->link($row['Job']['titre'], array(
		            	'plugin' => null,
		                'controller' => 'jobs',
		                'action' => 'voir',
		                $row['Job']['id']
		            ));
					$tab_job[$i]['id'] = $row['Job']['id'];
		            $tab_job[$i]['titre'] = $row['Job']['titre'];
					$tab_job[$i]['image'] = $row['Job']['image'];
		            $tab_job[$i]['description'] = $row['Job']['descJob'];
		            break;*/

           

            }  $i++; ?>

	<?php endforeach; ?> 

		<div class="row" style ="margin-left: 12px;">
			<?php 
			if(!empty($tab_demande)):
			foreach($tab_demande as $demande):?>

				<div class="clearfix back-divcontent">  
					<div class="div-transparent date">
						<span>
							<i class="icon-calendar"></i> <?php 

							$date = str_replace("/","-",$demande['created'] );

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
						<a href="<?php echo $site_url."/demandes/".$demande['Dcategory_slug']."/".$demande['Dtype_slug'] ; ?>.html" title="" >
							<span><?php echo $demande["Dtype_nom"]; ?> </span>
						</a>
					</div>
					<div class="div-transparent ville">
						<span class="small-menu">  <?php if(!empty($demande['ville']) ) : ?>/  <i class="icon-map-marker"></i> <?php echo $demande['ville']; ?><?php endif; ?>
						</span>
					</div>
					<br>
					<div class="div-badge">
						<?php if ($demande['reponse'] > 1){ ?>
					  	 		<span class="badge badge-info"><?php echo $demande['reponse']; ?> Réponses</span>
					  	<?php }elseif ($demande['reponse'] == 1){ ?>
					  	 	  	<span class="badge badge-info">Une Réponse</span>
					  	<?php }; ?>
					</div>
					<div class="pull-left">		
						<a href="<?php echo $site_url."/demandes/".$demande['Dcategory_slug']."/".$demande['Dtype_slug']."/".$demande['Demande_slug']."-".$demande['id'].".html";?>" title="Voir détails" rel="tooltip" data-placement="bottom" data-original-title="<?php echo $demande['nom']; ?>" ><img  src="/uploads/demandes/<?php echo $demande['image'];?>" alt="<?php echo $demande['nom'];?>" class="img-polaroid cadre_img" /></a>
					</div>
					<div> 
						<div>
							<h3><span><a href="<?php echo $site_url."/demandes/".$demande['Dcategory_slug']."/".$demande['Dtype_slug']."/".$demande['Demande_slug']."-".$demande['id'].".html" ; ?>" title="" ><?php echo $demande['nom']; ?></a></span></h3>		    
						    <!-- <span class="price"><img src="/img_all/icon/icon-price.png" alt="" /><?php echo $budget;?>Dhs</span>	 -->
						    <div class="div-content-service">
						    	<?php 
									if(strlen($demande['description']) < 150) 
										echo $demande['description'];
									else echo substr($demande['description'], 0, 150).' [...]';
								?>
							</div>
						</div>
						<div>
							<div class="small-menu">
								<a href="<?php echo $site_url."/demandes/".$demande['Dcategory_slug']."/".$demande['Dtype_slug']."/".$demande['Demande_slug']."-".$demande['id'].".html";?>" title="Répondre à cette demande" rel="tooltip" data-placement="bottom">
									<span class="icon"><i class="icon-share-alt"></i> Répondre</span>
								</a>	
								<a href="#" title="Ajouter à ma liste favori" rel="tooltip" data-placement="bottom">
									<span class="icon small-menu"><i class="icon-star"></i> Favori</span>
								</a>
								<!-- <span style ="margin-left: 260px;">&nbsp;</span> -->
								<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $site_url;?>&t=<?php echo $demande['nom']; ?>', 'Partager en Facebook'); return false;">
									<span class="icon small-menu"><i class="icon-white icon-facebook"></i> Partager</span>	
								</a>	
								<!-- <a href="#" onclick="window.open('http://twitter.com/share?text=<?php echo $site_url;?>&url=<?php echo $demande['nom']; ?>', 'Partager en Twitter'); return false;">
												<span class="icon small-menu"><i class="icon-white icon-twitter"></i> Twitter</span>	
											</a> -->			
							</div>				
							<p style ="float: right;">	
								<a href="<?php echo $site_url."/demandes/".$demande['Dcategory_slug']."/".$demande['Dtype_slug']."/".$demande['Demande_slug']."-".$demande['id'].".html"; ?>" style ="float: right;">Voir détails &raquo;</a>
							</p>
							<!-- <p><a class="button" href="#">View détails &raquo;</a></p> -->
							<!-- <a class="button " href="#"  rel="tooltip" data-placement="bottom" style ="margin-left: 520px;">Voir</a>  -->				
						</div>
					</div>
				</div>
				<hr class="featurette-divider">				
			<?php endforeach; ?>	
			<?php endif; ?>
		</div>
	<ul class="pager">
	  <li><?php echo $paginator->prev('<< '.__('Précédent', true));?></li>
	  <li><?php echo $paginator->numbers();?></li>
	  <li><?php echo $paginator->next(__('Suivant', true).' >>');?></li>
	</ul>
	<?php } ?> 
</section>