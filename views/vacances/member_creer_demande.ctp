<?php 
	$this->set ('page_title', 'Publier un service ~ Services4all');
	$this->set ('meta_robots',"noindex,follow");

	$attrs = $this->requestAction('/demandes/getCriteresRecherche') ;
	$categories = $attrs['categories'] ;
	$types = $attrs['types'] ;

	echo $html->script(array(
				'ajouter'
			))
	; 
?>
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page">Publier une demande</span>
	</div> 
</div>
<!-- /Breadcrumb -->
<section>
	<h1>
		<span>Publier une demande</span>
	</h1>
	<?php echo $session->flash() ; ?>
	<ul id="order_steps" class="step1">
		<li class="step_todo even">
			<span>
				<span>01</span> 
				Choisir le service
			</span>
		</li>
		<li class="step_current odd">
			<span>
				<span>02</span>
				Création
			</span>
		</li>
		<li class="step_todo even">
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
					<?php echo $form->create('Demande',array('id'=>'create_demande','class'=>"std",'type'=>'file','action'=>'creer_demande')); ?> 
						<?php echo $form->hidden('Demande.id') ;?>
						<fieldset id="compare_shipping">
							<h3>Créer une nouvelle demande</h3>	
							<p id="categorie">
								<label for="categorie">Catégorie : <sup>*</sup></label>
								<?php echo $form->input('Demande.dcategory_id',array('type' => 'select','options' =>array('escape' => "Choisir...",$categories),'onChange'=>'updateTypes(this.value);','name' => 'data[Demande][dcategory_id]', 'label' =>false,'div' =>false));?>
							</p>
							<p id="types">
								<label for="types">Type : <sup>*</sup></label>
								<?php echo $form->input('Demande.dtype_id',array('type' => 'select','options' =>array('escape' => "Choisir...",$types),'name' => 'data[Demande][dtype_id]','label' =>false,'div' =>false));?>
							</p>
							<p id="city">
								<label for="city">Ville : <sup>*</sup></label>
								<?php echo $form->input('Demande.city_id',array('type' => 'select','options' =>array('escape' => "Toutes les villes",$villes),'label' =>false,'div' =>false));?>
							</p>						
							<p id="nom">
								<label for="nom">Titre du service : <sup>*</sup></label>
								<?php e($form->input('Demande.nom',array('label' =>false,'div' =>false)));?>
							</p>					
							<p id="desc">
								<label for="desc">Description : </label>
								<?php e($form->input('Demande.descDemande',array('rows' => '5', 'cols' => '5','label' =>false,'div' =>false)));?>
							</p>		
							<p id="budget">
								<label for="budget">Budget : <sup>*</sup></label>
								<?php echo $form->input("Demande.budget", array("class"=>" validate[required] newfleurinput ","label"=>false,'div' =>false)); ?>DH<span>   <i class="icon-exclamation-sign"></i>   Indiquez un prix juste</span></div>
							</p>					
							<p id="image">
								<label for="imagePre">Photo : <sup>*</sup></label>
								<?php echo $form->input('Demande.imagePre',array('type' => 'file', 'label' =>false,'div' =>false));?>
							</p>
							<p class="cart_navigation clearfix inner-top">
								<a class="exclusive standard-checkout" title="Suivant" href="#" type="submit" onclick="$('#create_demande').submit();">Suivant »</a>
							</p>
						</fieldset>
					</form>		
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" language="javascript">
	function updateTypes(dcategory_id){
		$.ajax({
			url:'/demandes/getTypeByCategorieId/'+dcategory_id,
			dataType: "text" ,
			success: function(data) {
				$('#DemandeDtypeId').empty();
				$('#DemandeDtypeId').html(data);			
			}
		}) ;
	}
</script>