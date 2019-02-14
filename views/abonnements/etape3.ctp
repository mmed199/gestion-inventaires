<div class="inscription">
	<div class="titre_violet">Abonnement</div>
	<div class="liste_etape">
		<ul>
			<li>Etape 1 : Mes identifiants |</li>
			<li>Etape 2 : Ma société |</li>
			<li class="hover">Etape 3 : Paiement</li>
		</ul>
	</div>
	<div class="boite_recap">
		<?php echo $session->read('User.prenom').' '.$session->read('User.nom');?><br/>
		<?php echo $session->read('User.adresse');?><br/>
		<?php echo $session->read('User.code_postal').' '.$session->read('User.ville');?><br/>
		<?php if($session->read('User.email') != '') echo 'E-mail : '.$session->read('User.email').'<br/>';?>
		<?php if($session->read('User.telephone') != '') echo 'Téléphone : '.$session->read('User.telephone').'<br/>';?>
		<?php if($session->read('User.portable') != '') echo 'Mobile : '.$session->read('User.portable').'<br/>';?>
		<?php if($session->read('User.societe') != '') echo 'Société : '.$session->read('User.societe').'<br/>';?>
		<?php if($session->read('User.siteweb') != '') echo 'Site internet : '.$session->read('User.siteweb').'<br/>';?>
	</div>
	
	<br/>
	
	<div class="form">
		<fieldset>
			<legend>Votre choix de règlement - cliquez sur le logo correspondant</legend>
			<div class="liste_verticale">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="140" align="center">
							
							<?php echo $html->image('/images/site/carteinscription.png', array(
																								'width' => 100,
																								'alt' => 'carte sce',
																								'title' => 'Utiliser la carte sce',
																								'url' => array('action' => 'carte_sce')
																								));
							?>
						</td>
						<td >
							<div class="titre">Carte SCE</div>
							Vous disposez d'une carte SCE fournie par l'un de nos distributeurs SCE
						</td>
					</tr>
					<!--<tr>
						<td width="140" align="center">
							<?php echo $html->image('/images/site/logo_paypal.jpg', array(
																								'width' => 100,
																								'alt' => 'paypal',
																								'title' => 'Payer avec Paypal',
																								'url' => array('action' => 'paypal')
																								));
							?>
						</td>
						<td>
							<div class="titre">Paiement en ligne</div>
							Réglez votre abonnement en ligne via le système de paiement sécurisé Paypal
						</td>
					</tr>-->
					<?php /*<tr>
						<td align="center"><img src="/images/site/logo_cm-paiement.jpg" title="Paiement en ligne Crédit Mutuel" alt="Paiement en ligne avec le crédit mutuel" id="content_2"/></td>
						<td>
							<div class="titre">Paiement en ligne</div>
							Le système de paiement en ligne sécurisé du Crédit Mutuel
						</td>
					</tr>
					*/?>
				</table>
			</div>
		</fieldset>
	</div>
	
	<div id="content">
		<div id="_content_1" style="display: none;">
			<div class="titre_violet">Indiquez le numéro de votre Carte</div>
			<div class="form">
				<?php echo $this->Form->create('Abonnement', array('action'=>'abonnement_carte'));?>
				
					<p>Indiquez le code figurant au dos de votre carte et confirmer votre abonnement sur Service-Conseil-Entreprise.fr</p> 
					<table>
						<tr>
							<td align="right">Code d'abonnement</td>
							<td><?php echo $this->Form->input('code', array('label' => false, 'size' => 40));?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td align="left"><?php echo $form->end("Confirmer");?></td>
						</tr>
					</table>
				
			</div>
		</div>
		
		<?php /*
		<div id="_content_2" style="display: none;">
			<div class="titre_violet">Paiement sécurisé avec Le Crédit Mutuel</div>
			
				// TPE Settings
				// Warning !! CMCIC_Config contains the key, you have to protect this file with all the mechanism available in your development environment.
				// You may for instance put this file in another directory and/or change its name. If so, don't forget to adapt the include path below.
				//App::import('Vendor', 'CMCIC_Config' , array('file'=>'tpe'.DS.'cmcic_config.php'));
				require('/homez.387/servicec/www/vendors/tpe/cmcic_config.php');
				
				// PHP implementation of RFC2104 hmac sha1 ---
				//App::import('Vendor', 'CMCIC_Tpe' , array('file' => 'tpe'.DS.'cmcic_tpe.inc.php'));
				require('/homez.387/servicec/www/vendors/tpe/cmcic_tpe.inc.php');
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
					<!--
					<input type="hidden" name="nbrech"              id="nbrech"         value="<?php echo $sNbrEch;?>" />
					<input type="hidden" name="dateech1"            id="dateech1"       value="<?php echo $sDateEcheance1;?>" />
					<input type="hidden" name="montantech1"         id="montantech1"    value="<?php echo $sMontantEcheance1;?>" />
					<input type="hidden" name="dateech2"            id="dateech2"       value="<?php echo $sDateEcheance2;?>" />
					<input type="hidden" name="montantech2"         id="montantech2"    value="<?php echo $sMontantEcheance2;?>" />
					<input type="hidden" name="dateech3"            id="dateech3"       value="<?php echo $sDateEcheance3;?>" />
					<input type="hidden" name="montantech3"         id="montantech3"    value="<?php echo $sMontantEcheance3;?>" />
					<input type="hidden" name="dateech4"            id="dateech4"       value="<?php echo $sDateEcheance4;?>" />
					<input type="hidden" name="montantech4"         id="montantech4"    value="<?php echo $sMontantEcheance4;?>" />
					-->
					<!-- -->
					<center>
						<input type="submit" name="bouton"              id="bouton"         value="Procéder au paiement en ligne" />
					</center>
				</p>
					</form>
				</div>	
				*/ ?>
		</div>
	
	</div>
	
	
</div>