<?php $langCode = Configure::read('Config.langCode');  ?>  
  <link href="/validation-engine/css/template.css" rel="stylesheet" type="text/css" />
   <link href="/validation-engine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" language="javascript" src="/validation-engine/js/languages/jquery.validationEngine-<?php echo $langCode ; ?>.js"></script>
  <script type="text/javascript" language="javascript" src="/validation-engine/js/jquery.validationEngine.js"></script>
        <script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#changerMotPassForm").validationEngine() ;
            });
             
        </script>
		<br/>

   <?php if ($langCode == 'fr') {?>
   <div class="product_page">
	<span class="product_page_span">Réinitialisation du mot de passe :</span>
</div>
<div class="frame_900_rec">
	<form id="changerMotPassForm" action="/users/changerPass" method="Post">
	<input type="hidden" name="data[user_id]"   value="<?php echo $user_id ; ?>" />
	<input type="hidden" name="data[recover_code]"  value="<?php echo $recover_code ; ?>" />
   <table>
      <tr>
	    <td>Nouveau mot de passe :  </td>
		<td> <input type="password" id="password" name="data[User][password]" class="validate[required]"  />		</td>
	  </tr>
	  <tr>
	    <td>Confirmer le nouveau mot de passe :  </td>
		<td> <input type="password" id="repassword" name="data[User][repassword]" class="validate[required,equals[password]]"  />		</td>
	  </tr>
	  <tr>
		<td colspan="2" align="right" > <input type="submit" name="password"  value="Valider"/>		</td>
	  </tr>
	</table>
	<?php }else{?>
	<div class="product_page">
	<span class="product_page_span">Resetting the password:</span>
</div>
<div class="frame_900_rec">
	<form id="changerMotPassForm" action="/users/changerPass" method="Post" class="formToValidate" >
	<input type="hidden" name="data[user_id]"   value="<?php echo $user_id ; ?>" />
	<input type="hidden" name="data[recover_code]"  value="<?php echo $recover_code ; ?>" />
		<table>
      <tr>
	    <td>New password:  </td>
		<td> <input type="password" id="password" name="data[User][password]" class="validate[required]"  />		</td>
	  </tr>
	  <tr>
	    <td>Password confirmed:  </td>
		<td> <input type="password" id="repassword" name="data[User][repassword]" class="validate[required,equals[password]]"  />		</td>
	  </tr>
	  <tr>
		<td colspan="2" align="right" > <input type="submit" name="password"  value="Send"/>		</td>
	  </tr>
	</table>
	
	<?php }?>
	
	</form>
</div>
<div class="frame_900_rec_footer"></div>
<br/>
<br/>
