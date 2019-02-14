<div id="main">
<img src="/img/newsletter-title.png" alt="Newsletter" />
<div id="main-block">
	<div id="newsletter">
		<form method="post" action="/newsletter.html" id="newsletter_form">
		<?php echo $form->create('Abonne',array('id'=>'formID','url'=>array('controller'=>'abonnes','action'=>'inscription'))); ?>
		<img src="/img/newsletter-abonnement-title.png" alt="Abonnement" />
		<div class="error center"></div>
		<div class="formulaire">
			<p class="checkbox pink"><label for="checkbox_1">Je souhaite recevoir les newsletters et les offres de Kids Dressing<br />
				(Bons Plans, Concours, Soldes...)</label>
				<input type="checkbox" name="newsletters" id="checkbox_1" />
			</p>
			<p class="checkbox"><label for="checkbox_2">Je souhaite recevoir les offres partenaires de Kids Dressing</label>
				<input type="checkbox" name="offres_partenaires" id="checkbox_2" />
			</p>
			<p><label for="email">Votre e-mail : <span class="red">*</span></label>
				 <?php echo $form->input("email", array("class"=>" validate[required] inputl","label"=>false)); ?> 
			</p>
			<p><label for="nom">Votre nom : </label>
				<?php echo $form->input("nom", array('class'=>'validate[required,custom[onlyLetterSp]] imputm',"value"=>"","label"=> false)); ?>
			</p>
			<input type="hidden" name="source" id="source" value="form news" />
		</div>
		<div id="buttons">
			<div id="retour">
				<a href="/">Retour</a>
			</div>
			<div id="envoyer">
				<?php echo $form->end("Valider"); ?>
			</div>
		</div>
		</form>
	</div>
</div>
<p class="texte" style="font-size:11px;">
En vous inscrivant à notre newsletter, vous êtes sûrs d’être informés des nouveautés Kidsdressing qui pourraient faire de beaux cadeaux à offrir. Par ailleurs, une surprise vous attend lors de l’inscription. L’inscription à notre newsletter nécessite très peu d’informations obligatoires…. 
Votre adresse email, avec votre nom, si vous le souhaitez, il est plus facile de communiquer avec vous !
<br><br>
Conformément à la loi informatique et libertés du 6 janvier 1978, vous disposez d'un droit d'accès et de rectification aux données vous concernant.
Pour l'exercer, il vous suffit d'envoyer un mail contact@kidsdressing.com. Kidsdressing s'engage à ne céder ou louer ces informations à aucune organisation ou entreprise extérieure sans consentement de votre part. 
</p>
