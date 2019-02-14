<?php 
	$this->set ('page_title', "Modifier l'annonce ~ Services4all");
	$this->set ('meta_robots',"noindex,follow");
?>
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<a class="breadcrumb-home" href="/mon-compte.html" title="Mon compte" rel="tooltip"><span class="navigation_page">Mon compte</span></a>
		<span class="navigation-pipe">&gt;</span>
		<a class="breadcrumb-home" href="/mes-annonces.html" title="Mes annonces" rel="tooltip"><span class="navigation_page">Mes annonces</span></a>
		<span class="navigation-pipe">&gt;</span>
		<span class="navigation_page">Modifier l'annonce</span>
	</div>
</div>
<!-- /Breadcrumb -->
<br>	
<!-- Menu member -->
<?php echo $this->element('members/nav-member') ; ?>
<h1>
	<span>Modifier l'annonce</span>
</h1>
<?php echo $session->flash() ; ?>
<div class="comment-field">
	<?php echo $form->create('Vacance',array('id'=>'edit_vacance','class'=>'form-horizontal','type'=>'file','action'=>'modifier')); ?>
		<?php echo $form->hidden('Vacance.id') ;?>
		<?php echo $form->hidden('Vacance.valide') ;?>
		
		<div class="control-group span6">
			<label class="control-label" for="nom">Ville<sup> *</sup></label>
			<div class="controls input-min-large">
				<?php echo $form->input('Vacance.city_id',array('type' => 'select','options' =>array('escape' => "Toutes les villes",$villes),'label' =>false,'div' =>false));?>
			</div>
		</div>	
		<div class="control-group span6">
			<label class="control-label" for="nom">Titre du service<sup> *</sup></label>
			<div class="controls">
				<?php e($form->input('Vacance.titre',array('label' =>false,'div' =>false)));?>
			</div>
		</div>		
		<div class="control-group span6">
			<label class="control-label" for="nom">Description : </label>
			<div class="controls input-min-large">
				<?php e($form->input('Vacance.description',array('rows' => '5', 'cols' => '5','label' =>false,'div' =>false)));?>
			</div>
		</div>			
		<div class="control-group span6">
			<label class="control-label" for="nom">Budget : </label>
			<div class="controls input-min-large">
				<?php echo $form->input("Vacance.budget", array("class"=>" validate[required] newfleurinput ","label"=>false,'div' =>false)); ?>DH<span>   <i class="icon-exclamation-sign"></i>   Indiquez un prix juste</span>
			</div>
		</div>						
		<div class="control-group span6">
			<label class="control-label" for="nom"></label>
			<div class="controls input-min-large">
				<img alt="" style="width:200px;" class="img-polaroid" title="" src="<?php echo '/uploads/vacances/'.$this->data['Vacance']['image'] ; ?>" >
			</div>
		</div>						
		<div class="control-group span6">
			<label class="control-label" for="nom">Photo : </label>
			<div class="controls input-min-large">
				<?php echo $form->input('Vacance.imagePre',array('type' => 'file', 'label' =>false,'div' =>false));?>
			</div>
		</div>			
		<p class="cart_navigation clearfix inner-top">
			<a class="exclusive standard-checkout" title="Modifier" href="#" type="submit" onclick="$('#edit_vacance').submit();">Modifier</a>
		</p>
	</form>	
</div>