<?php
$langCode = Configure::read('Config.langCode');
$this->set ("page_title",__("Avantages pour abonnés newsletter Services4all",true));		
?>
<?php $langCode = Configure::read('Config.langCode');  ?>  
  <link href="/validation-engine/css/template.css" rel="stylesheet" type="text/css" />
   <link href="/validation-engine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" language="javascript" src="/validation-engine/js/languages/jquery.validationEngine-<?php echo $langCode ; ?>.js"></script>
  <script type="text/javascript" language="javascript" src="/validation-engine/js/jquery.validationEngine.js"></script>
        <script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#abonneForm").validationEngine() ;
            });
             
        </script>
<h1><?php __("Newsletter Services4all");?></h1>

<div class="descrip">

		<div id="panel-tem" style="margin-top:0px;">
					<div class="p-titre"><?php echo __("S'inscrire");?></div>
					<div class="p-texte">
						<?php echo $form->create('Abonne',array('id'=>'abonneForm')); ?>
							<?php
								$langCode = Configure::read('Config.langCode');					
							?>
							<input type="hidden" name="lang" value="<?php echo $langCode ; ?>" />
															

								<?php echo $form->input("nom", array('class'=>'validate[required,custom[onlyLetterSp]] court-input',"value"=>"","label"=>__("Nom :")." ")); ?>
								<br/>
								  <?php echo $form->input("prenom", array( 'class'=>'validate[required,custom[onlyLetterSp]] court-input',"value"=>"","label"=>__("Prénom :")." ")); ?>
								  <br/>
								  <?php echo $form->input("ville", array( 'class'=>'validate[required,custom[onlyLetterSp]] court-input',"value"=>"","label"=>__("Ville :")."  ")); ?>
								 <br/>
								 <?php echo $form->input("email", array("class"=>" validate[required] ","label"=>"Email :")); ?> 
							<div id="submitins"  >
							   <?php 
								$langCode = Configure::read('Config.langCode');
								if ($langCode=="fr")
									echo $form->end("Valider"); 
								else
									echo $form->end("Submit"); 
							   ?>
							   
							   
							</div>
							
					</div>
					
		</div>
		
</div>

<?php 
	if ($langCode=="fr"){
		$this->set ("page_description","En vous inscrivant à la newsletter, vous êtes sûrs d’être informés des nouveautés Elwards qui pourraient faire de beaux cadeaux à offrir. Par ailleurs, une surprise vous attend lors de l’inscription. L’inscription à notre newsletter nécessite très peu d’informations obligatoires…. Votre adresse email, avec votre nom, si vous le souhaitez, il est plus facile de communiquer avec vous !");
?>
Services4all est un des rares sites à vous proposer un service de livraison de Bijoux et de cadeaux. <?php
	}?>
	
	
<?php 
	if ($langCode=="en"){
		$this->set ("page_description","By subscribing to the newsletter, you are sure to be advised of new Elwards that could make great gifts to offer. In addition, a surprise awaits you at registration. The newsletter subscription requires minimal information required .... Your email address, your name, if desired, it is easier to communicate with you!");
?>
Services4all is one of the few sites to offer a delivery service of Jewelry and gifts <?php
	}?>
	

<br/>
