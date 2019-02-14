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
<div class="product_page">
	<span class="product_page_span">Réinitialisation du mot de passe :</span>
</div>
<div class="frame_900_rec">
	<form id="changerMotPassForm" action="/members/changercode" method="Post"><!-- normalement l'action concerné c'est "vfRecoverLink", je met "changercode" just devant le client -->
    <table>
      <tr>
	    <td>Nouveau mot de passe :  </td>
		<td> <input type="password" id="new_pass" name="data[Member][new_pass]" class="validate[required]"  />		</td>
	  </tr>
	  <tr>
	    <td>Confirmer le nouveau mot de passe :  </td>
		<td> <input type="password" id="renew_pass" name="data[Member][renew_pass]" class="validate[required,equals[new_pass]]"  />		</td>
	  </tr>
	  <tr>
		<td colspan="2" align="right" > <input type="submit" name="password"  value="Valider"/></td>
	  </tr>
	</table>
</div>