<?php
	$site_url = Configure::read("site_url");
	$site_url_courte = Configure::read("site_url_courte");
	$site_name =Configure::read("site_name");
	$this->set ('page_title','Réinitialisation du mot de passe ~ ' . $site_name );
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
		<span class="navigation_page">Réinitialisation du mot de passe</span>
	</div>
</div>
<!-- /Breadcrumb -->
<h1>
	<span>Réinitialisation du mot de passe</span>
</h1>
<?php echo $session->flash() ; ?>
<div class="comment-field">
	<?php echo $form->create('Member',array('enctype'=>'multipart/form-data',
											'id'=>"infosperso_password",
											'class'=>'form-horizontal',
											'url'=>array('action'=>'reset_mot_passe')
											)
							) ; ?>
		<input type="hidden" name="data[member_id]"   value="<?php echo $member_id ; ?>" />
		<input type="hidden" name="data[recover_code]"  value="<?php echo $recover_code ; ?>" />
		<div class="control-group span6">
			<label class="span3" for="email">Nouveau mot de passe<sup> * </sup>:</label>
			<div class="controls input-min-large">
				<input type="password" id="password" name="data[Member][password]" class="validate[required] inputm account_input"  />
			</div>
			<label class="span3" for="email">Confirmer le nouveau mot de passe<sup> * </sup>:</label>
			<div class="controls input-min-large">
				<input type="password" id="repassword" name="data[Member][repassword]" class="validate[required,equals[password]] inputm account_input"  />
			</div>
			<p class="cart_navigation required submit">
				<input id="submitAccount" class="exclusive" type="submit" onclick="$('#infosperso_password').submit();" value=" Valider " name="submitAccount">
				<span>
					<sup>*</sup>
					Champs obligatoires
				</span>
			</p>		
		</div>
	</form>
</div>
<br>