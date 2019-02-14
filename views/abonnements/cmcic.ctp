<?php
// TPE Settings
// Warning !! CMCIC_Config contains the key, you have to protect this file with all the mechanism available in your development environment.
// You may for instance put this file in another directory and/or change its name. If so, don't forget to adapt the include path below.
App::import('Vendor','CMCIC_Config',array('file'=>'tpe/CMCIC_Config.php'));

// PHP implementation of RFC2104 hmac sha1 ---
App::import('Vendor','CMCIC_Tpe',array('file'=>'tpe/CMCIC_Tpe.inc.php'));
$sOptions = "";

// ----------------------------------------------------------------------------
//  CheckOut Stub setting fictious Merchant and Order datas.
//  That's your job to set actual order fields. Here is a stub.
// -----------------------------------------------------------------------------



$sReference = "ref" . date("His");

// Amount : format  "xxxxx.yy" (no spaces)
$sMontant = '349.00';
// Currency : ISO 4217 compliant
$sDevise  = "EUR";

// free texte : a bigger reference, session context for the return on the merchant website
$sTexteLibre = "Texte Libre";

// transaction date : format d/m/y:h:m:s
$sDate = date("d/m/Y:H:i:s");

// Language of the company code
$sLangue = "FR";

// customer email
$sEmail = $session->read('User.email');

// ----------------------------------------------------------------------------

// between 2 and 4
//$sNbrEch = "4";
$sNbrEch = "";

// date echeance 1 - format dd/mm/yyyy
//$sDateEcheance1 = date("d/m/Y");
$sDateEcheance1 = "";

// montant échéance 1 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance1 = "0.26" . $sDevise;
$sMontantEcheance1 = "";

// date echeance 2 - format dd/mm/yyyy
//$sDateEcheance2 = date("d/m/Y", mktime(0, 0, 0, date("m") +1 , date("d"), date("Y")));
$sDateEcheance2 = "";

// montant échéance 2 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance2 = "0.25" . $sDevise;
$sMontantEcheance2 = "";

// date echeance 3 - format dd/mm/yyyy
//$sDateEcheance3 = date("d/m/Y", mktime(0, 0, 0, date("m") +2 , date("d"), date("Y")));
$sDateEcheance3 = "";

// montant échéance 3 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance3 = "0.25" . $sDevise;
$sMontantEcheance3 = "";

// date echeance 4 - format dd/mm/yyyy
//$sDateEcheance4 = date("d/m/Y", mktime(0, 0, 0, date("m") +3 , date("d"), date("Y")));
$sDateEcheance4 = "";

// montant échéance 4 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance4 = "0.25" . $sDevise;
$sMontantEcheance4 = "";

// ----------------------------------------------------------------------------

$oTpe = new CMCIC_Tpe($sLangue);     		
$oHmac = new CMCIC_Hmac($oTpe);      	        

// Control String for support
$CtlHmac = sprintf(CMCIC_CTLHMAC, $oTpe->sVersion, $oTpe->sNumero, $oHmac->computeHmac(sprintf(CMCIC_CTLHMACSTR, $oTpe->sVersion, $oTpe->sNumero)));

// Data to certify
$PHP1_FIELDS = sprintf(CMCIC_CGI1_FIELDS,     $oTpe->sNumero,
                                              $sDate,
                                              $sMontant,
                                              $sDevise,
                                              $sReference,
                                              $sTexteLibre,
                                              $oTpe->sVersion,
                                              $oTpe->sLangue,
                                              $oTpe->sCodeSociete, 
                                              $sEmail,
                                              $sNbrEch,
                                              $sDateEcheance1,
                                              $sMontantEcheance1,
                                              $sDateEcheance2,
                                              $sMontantEcheance2,
                                              $sDateEcheance3,
                                              $sMontantEcheance3,
                                              $sDateEcheance4,
                                              $sMontantEcheance4,
                                              $sOptions);

// MAC computation
$sMAC = $oHmac->computeHmac($PHP1_FIELDS);



?>		

		

<div id="frm">

	<form action="<?php echo $oTpe->sUrlPaiement;?>" method="post" id="PaymentRequest">
<p>
	<input type="hidden" name="version"             id="version"        value="<?php echo $oTpe->sVersion;?>" />
	<input type="hidden" name="TPE"                 id="TPE"            value="<?php echo $oTpe->sNumero;?>" />
	<input type="hidden" name="date"                id="date"           value="<?php echo $sDate;?>" />
	<input type="hidden" name="montant"             id="montant"        value="<?php echo $sMontant . $sDevise;?>" />
	<input type="hidden" name="reference"           id="reference"      value="<?php echo $sReference;?>" />
	<input type="hidden" name="MAC"                 id="MAC"            value="<?php echo $sMAC;?>" />
	<input type="hidden" name="url_retour"          id="url_retour"     value="<?php echo $oTpe->sUrlKO;?>" />
	<input type="hidden" name="url_retour_ok"       id="url_retour_ok"  value="<?php echo $oTpe->sUrlOK;?>" />
	<input type="hidden" name="url_retour_err"      id="url_retour_err" value="<?php echo $oTpe->sUrlKO;?>" />
	<input type="hidden" name="lgue"                id="lgue"           value="<?php echo $oTpe->sLangue;?>" />
	<input type="hidden" name="societe"             id="societe"        value="<?php echo $oTpe->sCodeSociete;?>" />
	<input type="hidden" name="texte-libre"         id="texte-libre"    value="<?php echo HtmlEncode($sTexteLibre);?>" />
	<input type="hidden" name="mail"                id="mail"           value="<?php echo $sEmail;?>" />
	<!-- Uniquement pour le Paiement fractionné -->
	<input type="hidden" name="nbrech"              id="nbrech"         value="<?php echo $sNbrEch;?>" />
	<input type="hidden" name="dateech1"            id="dateech1"       value="<?php echo $sDateEcheance1;?>" />
	<input type="hidden" name="montantech1"         id="montantech1"    value="<?php echo $sMontantEcheance1;?>" />
	<input type="hidden" name="dateech2"            id="dateech2"       value="<?php echo $sDateEcheance2;?>" />
	<input type="hidden" name="montantech2"         id="montantech2"    value="<?php echo $sMontantEcheance2;?>" />
	<input type="hidden" name="dateech3"            id="dateech3"       value="<?php echo $sDateEcheance3;?>" />
	<input type="hidden" name="montantech3"         id="montantech3"    value="<?php echo $sMontantEcheance3;?>" />
	<input type="hidden" name="dateech4"            id="dateech4"       value="<?php echo $sDateEcheance4;?>" />
	<input type="hidden" name="montantech4"         id="montantech4"    value="<?php echo $sMontantEcheance4;?>" />
	<!-- -->
	<input type="submit" name="bouton"              id="bouton"         value="Procéder au paiement en ligne" />
</p>
</form>
	</div>	