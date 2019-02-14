<?php
	$site_url = Configure::read("site_url");
	$site_url_courte = Configure::read("site_url_courte");
	$site_name =Configure::read("site_name");
	$this->set ('page_title','Mot de passe oublié ~ ' . $site_name );
	$this->set('current_menu',"mon-espace");
	$this->set('current_page',"connexion");
?>
<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" rel="tooltip" title="retour à Accueil" href="/">
			<i class="icon-home"></i>
		</a>
		<span class="navigation-pipe">></span>
		<span class="navigation_page">Mot de passe oublié</span>
	</div>
</div>
<!-- /Breadcrumb -->
<h1>
	<span>Mot de passe oublié</span>
</h1>
<?php echo $session->flash() ; ?>
<div class="comment-field">
	<?php echo $form->create('Member',array ('class'=>'form-horizontal','id'=>'MemberConnexionForm')); ?>	
		<div class="control-group span6">
			<label class="control-label" for="email">Adresse e-mail<sup> * </sup>:</label>
			<div class="controls input-min-large">
				<?php echo $form->input('email',array(
													'label' =>false,
													'type' => 'text',
													'class'=>'account_input',
													));?>
			</div>
			<p class="cart_navigation required submit">
				<input id="submitAccount" class="exclusive" type="submit" onclick="$('#MemberConnexionForm').submit();" value=" Valider " name="submitAccount">
				<span>
					<sup>*</sup>
					Champs obligatoires
				</span>
			</p>		
		</div>
	</form>
</div>
<br>