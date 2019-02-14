<?php
	$this->set('page_title',__('Connexion',true) .' | ' . __('Espace client',true));
	$langCode = Configure::read('Config.langCode');  
	$this->set ('page_noindex','<META NAME="robots" CONTENT="noindex,nofollow">');
?>

	<link href="/validation-engine/css/template.css" rel="stylesheet" type="text/css" />
   <link href="/validation-engine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" language="javascript" src="/validation-engine/js/languages/jquery.validationEngine-<?php echo $langCode ; ?>.js"></script>
  <script type="text/javascript" language="javascript" src="/validation-engine/js/jquery.validationEngine.js"></script>
 
 <script>
 function motPasse(titre_fenetre) {
	        email = $("#compte_oublie_email_input");
			$("#dialog").dialog({ 
										autoOpen: false ,
										title: titre_fenetre,
										height: 200,
										width: 350,
										modal: true,
										buttons: {
											<?php __("Envoyer") ; ?>: function() {
											var bValid = true;
											// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
											bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );

											if ( bValid ) {
											    email = $("#compte_oublie_email_input").val() ;
												envoyerMotPasse(email) ;
												$( this ).dialog( "close" );
											}
											},
											<?php __("Annuler") ; ?>: function() {
												$( this ).dialog( "close" );
											}
										},
										close: function() {
										}
								}) ;
		$("#dialog").dialog('open');
	}
 </script>
  <script type="text/javascript" language="javascript" src="/js/login.js"></script>
  
<style>
#login{padding-top:20px;padding-left:30px;}
#login form label {display: inline-block;
    height: 25px;
    padding-right: 10px;
    text-align: right;
    width: 217px;}
#login form select {margin-left: -5px;}
#login form input[type="submit"] {margin-left: 230px;}
.email{width: 250px;}

</style>

<div id="login">
	<?php echo $form->create('Client',array('id'=>'orderForm')) ;  ?>
	                    <a href="#"><?php echo __("Vous êtes client ? Identifiez vous !",true);?></a>
						<br>
						<form name="form1" method="post" action="connexion.html">
                            <label><?php echo __("Votre Email",true);?> :</label>
                                     <input class="txtfield email" size="20" name="data[Client][email]" /><br>
                            <label><?php echo __("Mot de passe",true);?> :</label>
                                    <input size="20" class="txtfield" type="password" name="data[Client][password]" />
                                    

                                    	<div class="buttonsubmit">
                                                <br /><input type="submit" name="Action" id="Action" value="<?php echo __("Valider",true);?>" />
                                        </div>
                                    
                        </form>
                        <div class="ac"><br /><br />
							<p><a href="javascript:motPasse('Mot de passe oublié');" id="dialog_link" class="ui-state-default ui-corner-all"><span class=""></span>Vous avez oublié votre Mot de Passe?</a></p>
							<div id="dialog" title="<?php echo __("Mot de passe oublié",true);?>" style="display:none">
								<p>
									<form><?php echo __("Veuillez, saisir votre adresse email afin de recevoir le lien de recupération de votre mot de passe.",true);?><br/>
									<input value="" id="compte_oublie_email_input" name="compte_oublie_email_input" style="width:250px;margin-left:10px;" ><br>
									</form>
								</p>	
							</div>		
						</div>
						<br><br>
						
				<span class="titre_2"><B><?php echo __("Espace client : de quoi s'agit-il ?",true);?></B> <br /></span>
              <br /><?php echo __("Renseignez vos informations de connexion et accèdez ainsi à votre espace pour suivre vos commandes, 
                        bénéficiez de nos offres spéciales et être informé de tous nos nouveaux services.",true);?><BR> <br />
            
                   
 </div>      