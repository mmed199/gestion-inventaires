<?php
	$site_url = Configure::read('site_url');
	$titre_vacance = $vacance['Vacance']['titre'] ;
	$description = $vacance['Vacance']['description'] ;
	$budget = number_format($vacance['Vacance']['budget'] , 0, '.', ' ');
	$cheminPhoto = "";
	$cheminPhoto = "/uploads/vacances/".$vacance['Vacance']['image'];	
	$id_vacance = $vacance['Vacance']['id'];	
	$vacance_slug = $vacance['Vacance']['slug'];
	$vacance_ville = $vacance['City']['nom'];
	$vacance_url = $site_url."/vacances/".$vacance_slug."-".$id_vacance.".html";
?>	

<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page">Publier une offre vacance</span>
	</div> 
</div>
<!-- /Breadcrumb -->
<section>
	<h1>
		<span>Validation votre offre vacance</span>
	</h1>
	<?php echo $session->flash() ; ?>
	<ul id="order_steps" class="step1">
		<li class="step_todo even">
			<span>
				<span>01</span> 
				Choisir le service
			</span>
		</li>
		<li class="step_todo odd">
			<span>
				<span>02</span>
				Création
			</span>
		</li>
		<li class="step_current even">
			<span>
				<span>03</span>
				Validation
			</span>
		</li>
	</ul>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<div class="tab-content">
			<div class="tab-pane active" id="tab_tous_services">
				<div class="row" id="compare_shipping_form" style ="margin-left: 12px;">					
					<h3>Résumé de votre offre vacance</h3>
					<div class="row">
						<div id="pb-right-column" class="span2">									
							<div id="image-detail">					
								<span>
									<img alt="<?php echo $titre_vacance ; ?>" class="img-polaroid" title="<?php echo $titre_vacance ; ?>" src="<?php echo $cheminPhoto ; ?>" >
				             	</span>
							</div> 
						</div> 
						<div id="pb-left-column" class="span5">
							<div id="detail_block">           		       				
		            			<blockquote> 	
									<p>Titre : <em><?php echo $titre_vacance ; ?></em></p>  
								</blockquote>								
								<blockquote> 
									<p>Ville : <em><?php echo $vacance_ville ; ?></em></p> 
								</blockquote>
								<blockquote> 
									<p>Budget : <em><?php echo $budget ; ?></em> DH</p> 
								</blockquote>
								<blockquote> 
									<p>Description : <br>
										<em><?php echo $description ; ?></em>
									</p> 
								</blockquote>
								<p class="cart_navigation clearfix inner-top">
									<a class="exclusive standard-checkout" title="Valider" href="/member/vacances/valider_vacance/<?php echo $id_vacance; ?>" ><i class="icon-ok"></i>  Valider</a>
									<a class="exclusive standard-checkout espace" title="Modifier" href="/member/vacances/modifier/<?php echo $id_vacance; ?>" ><i class="icon-edit"></i>  Modifier</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>