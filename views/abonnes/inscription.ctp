<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" rel="tooltip" title="retour à Accueil" href="/">
			<i class="icon-home"></i>
		</a>
		<span class="navigation-pipe">></span>
		<span class="navigation_page">Newsletter</span>
	</div>
</div>
<h1>
	<span>Abonnement</span>
</h1>
<div class="comment-field">
	<?php echo $form->create('Abonne',array('id'=>'newsletter_form','class'=>'form-horizontal',
										'url'=>array('controller'=>'abonnes','action'=>'inscription'))); ?>
		<div class="control-group span6">				
			<div class="controls">
				<label class="checkbox" for="offres_newsletters" style = "display: block; margin-top: 20px; margin-left: -20px; width: 470px;">
					<?php echo $form->input('Abonne.offres_newsletters',array(
													'label' =>false,
													'div' =>false,
													'style' => 'margin-right: 22px;',
													'type' => 'checkbox',
													));?>
					Je souhaite recevoir les newsletters et les offres services Services4all
				</label>
				<label class="checkbox" for="offres_partenaires" style = "display: block; margin-top: 40px; margin-bottom: 30px; margin-left: -20px;">
					<?php echo $form->input('Abonne.offres_partenaires',array(
													'label' =>false,
													'div' =>false,
													'style' => 'margin-right: 22px;',
													'type' => 'checkbox',
													));?>
					Je souhaite recevoir les offres partenaires Services4all
				</label>
			</div>
		</div>
		<div class="control-group span6">
			<label class="control-label" for="nom">Nom<sup> *</sup></label>
			<div class="controls">
				<?php echo $form->input('nom',array(
													'label' =>false,
													'type' => 'text',
													'size' => '40',
													'class'=>'input-xxlarge',
													));?>
			</div>
		</div>
		<div class="control-group span6">
			<label class="control-label" for="email">Votre e-mail<sup> *</sup></label>
			<div class="controls">
				<?php echo $form->input('email',array(
													'label' =>false,
													'type' => 'text',
													'size' => '40',
													'class'=>'input-xxlarge',
													));?>
			</div>
		</div>
		<p class="cart_navigation required submit">
			<input id="submitNewsletter" class="exclusive" type="submit" onclick="$('#newsletter_form').submit();" value="Valider" name="submitAccount">
		</p>
		<p class="error"></p>
	</form>
	<p>
		Vous êtes sûrs d’être informés des nouveautés Services4all qui pourraient faire de beaux cadeaux à offrir. Par ailleurs, une surprise vous attend lors de l’inscription. L’inscription à notre newsletter nécessite très peu d’informations obligatoires... Votre adresse email, avec votre nom, si vous le souhaitez, il est plus facile de communiquer avec vous !
	</p>
	<p>
		Vous disposez d'un droit d'accès et de rectification aux données vous concernant.  Pour l'exercer, il vous suffit d'envoyer un mail à contact@Services4all.fr. Services4all s'engage à ne céder ou louer ces informations à aucune organisation ou entreprise extérieure sans consentement de votre part.
	</p>
</div>