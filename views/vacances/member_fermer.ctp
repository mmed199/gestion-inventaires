<?php 
	$site_url = Configure::read('site_url');
 ?>
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" rel="tooltip" title="" href="/" data-original-title="retour à Accueil">
			<i class="icon-home"></i>
		</a>
		<span class="navigation-pipe">></span>
		<a class="breadcrumb-home" href="/mon-compte.html" title="Mon compte" rel="tooltip"><span class="navigation_page">Mon compte</span></a>
		<span class="navigation-pipe">></span>
		<a class="breadcrumb-home" href="/mes-annonces.html" title="Mes annonces" rel="tooltip"><span class="navigation_page">Mes annonces</span></a>
		<span class="navigation-pipe">></span>
		<span class="navigation_page">Fermer annonce</span>
	</div>
</div>	 
<br>	
<!-- Menu member -->
<?php echo $this->element('members/nav-member') ; ?>
<!-- /Menu member -->
<h1> 
	<span><h6>Fermer annonce service</h6></span>
</h1>
<?php echo $session->flash() ; ?>
<div id="repondre_form">
	<?php echo $this->Form->create('Fermer', array('id'=>'submitFermer','url' => array('controller' => 'vacances', 'action' => 'member_fermer', $id_vacance)));?>
		<!-- hidden datas -->
		<p class="hidden">
			<?php echo $this->Form->input('Fermer.demande_id', array('type' => 'hidden', 'value' => $id_vacance));?>
		</p>  
        <div class="row-fluid">
            <div class="span6 titled_box">  
            	<span>Êtes-vous sûr(e) de vouloir fermer (Retirer) votre annonce <strong>"<?php echo $titre_vacance; ?>"</strong>?</span>             
                <div class="product_desc">
                   <p>
                   		Il est très important pour nous de savoir que notre site web est utile pour nos clients. <br>
						S'il vous plaît dites-nous pourquoi vous avez décidé de fermer (Retirer) votre annonce:
                   </p>
                </div>
			</div>
            <div class="span6">
				<div class="send_friend_form_content">
					<div id="form_error"></div>
					<div class="form_container titled_box">
						<p class="text">
							<label class="radio" for="motif_s4a">
								<input type="radio" name="data[Fermer][motif]" checked value="1" id="motif_s4a" class="radio-fermer" />
								Service rendu sur Service4all.ma
							</label>
							<label class="radio" for="motif_ailleurs">
								<input type="radio" name="data[Fermer][motif]" value="2" id="motif_ailleurs" class="radio-fermer"/>
								Service rendu ailleurs
							</label>
							<label class="radio" for="motif_autre">
								<input type="radio" name="data[Fermer][motif]" value="3" id="motif_autre" class="radio-fermer"/>
								Autres motifs
							</label>
						</p>
					</div>	
				</div>
            </div>
        </div>
        <div id="new_comment_form_footer" class=" sendfrend_footer" style="margin-top:15px;">
            <p class="fr ">
				<button id="submitFermer" class="btn btn-inverse" name="submitFermer" type="submit" onclick="$('#submitFermer').submit();" /><i class="icon-remove"></i> Fermer</button>
            </p>
            <div class="clearfix"></div>
        </div>
	</form> 
</div> 
<!-- end Reponse form-->