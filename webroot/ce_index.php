<!-- ------------------------------------------------- 
Exemple de code php - Formulaire de paiement unitaire
VERSION 1.0a - Lyra Network
------------------------------------------------------ -->

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Demo_Payment</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body >

<div id="container">
	<div id="Title_information">
		<img class="logo_PSP" src="./img/psp.png" alt="Logo PSP"/>
		<div class="header_title" >EXEMPLE D'IMPLEMENTATION DE LA SOLUTION DE PAIEMENT PAYZEN <br/><br/>FORMULAIRE DE PAIEMENT SIMPLE - LANGAGE PHP - HTML - Version du pack 1.0a</div>
	</div>
	
	<a href="index.php">Formulaire de paiement </a>|<a href="return.html"> Analyse du retour</a>
	<hr>		


	
	<div id="Info">
		<p><b><u>INFORMATION</u></b></p>
		<p>Le paiement s'appuie sur l'envoi d'un formulaire de paiement en https vers l'URL de la plateforme de paiement PAYZEN.
		Veuillez trouver ci-dessous un exemple des différents champs. Ce code "index.php" envoie l'ensemble des champs liés au paiement vers le fichier "form_payment.php" qui récupère l'ensemble des ces champs pour les transmettre à la plateforme de paiement.
		</p>Les champs sont renseignés à titre d'exemple, à votre charge de les valoriser en fonction de votre contexte. Assurez vous que les droits sur le fichier count.txt soient configurés en lecture et en écriture pour un bon fonctionnement du script.
		<p> Afin que le script fonctionne correctement merci de renseigner <b>le certificat de test ou de production </b>selon le mode <b>à la ligne 12</b> du fichier return_payment.php fourni dans ce pack.</p>
		<p><b>D'autres champs sont disponibles, le support Payzen vous invite à lire la documentation liée au formulaire de paiement</b> <a href="https://systempay.cyberpluspaiement.com/html/Doc/2.2_Guide_d_implementation_formulaire_Paiement_V2.pdf">Consulter la documentation</a></p>
	</div>	
		
	<hr>
		
		<p><b><u>CHAMPS DU FORMULAIRE DE PAIEMENT</u></b></p>
		<p style="float:"left"><b>Url de la plateforme de paiement: https://secure.payzen.eu/vads-payment/</b></p>
		<p style="color:red;"><b>En rouge les champs obligatoires</b></p>
		<form style="margin-top:10px;"method=POST action=ce_form_payment.php >
					
					<table cellspacing="1">

						
						
						<tr> 
						<td colspan="3" class="title_array"  >ACCES A LA PLATEFORME</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_site_id</td>
							<td><input type="text" name="vads_site_id" size=20></td>
							<td>Identifiant Boutique à récupérer dans le Back office Payzen</td>
						</tr>
						<tr>
							<td class="field_mandatory">Certificat</td>
							<td><input type="text" name="key" size=20></td>
							<td >Certificat à récupérer dans le Back office Payzen. Attention ce certificat est différent en fonction du mode TEST ou PRODUCTION. Le certificat n'est pas envoyé à la plateforme de paiement mais intervient dans le calcul de la signature.</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_ctx_mode</td>
							<td><input type="text" name="vads_ctx_mode" value="TEST" size=20></td>
							<td>Mode de fonctionnement. Valeur = TEST ou PRODUCTION</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_version</td>
							<td><input type="text" name="vads_version" value="V2" size=20></td>
							<td>Ce paramètre est obligatoire et doit être valorisé à V2.</td>
						</tr>
						
						<tr>
							<td >vads_language</td>
							<td ><input type="text" name="vads_language" value="fr"size=20></td>
							<td >Langue dans laquelle s'affiche la page de paiement.( fr pour Français , en pour Anglais . Plus d'info en consultant la <a href="https://systempay.cyberpluspaiement.com/html/Doc/2.2_Guide_d_implementation_formulaire_Paiement_V2.pdf">documentation</a></td>
						</tr>
						
						<td colspan="3" class="title_array">PARAMETRES DE LA TRANSACTION</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">signature</td>
							<td class="field_warning">WARNING</td>
							<td >La signature est un paramètre obligatoire. Elle est calculée par la fonction Get_signature du fichier function.php inclu dans ce pack.</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_trans_date</td>
							<td class="field_warning">WARNING</td>
							<td>Ce champ est obligatoire il correspond à la date de la transaction exprimée sous la forme AAAAMMJJHHMMSS sur le fuseau UTC=0. Cette valeur sera calculée par le fichier function.php.</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_trans_id</td>
							<td class="field_warning">WARNING</td>
							<td>Ce champ est obligatoire il correspond à l'idententifiant de la transaction. Cet identifiant doit être:
								<li> unique sur une même journée. </li>
								<li> sa longueur est obligatoirement de 6 caractères.</li>
								<li> Sa valeur est doit être comprise entre 000000 et 899999</li>
							DANS CET EXEMPLE LE CALCUL DE CE CHAMP EST FAIT PAR LE FICHIER "function.php" et s'appuie sur un compteur. VOUS POUVEZ CALCULER CE CHAMP A VOTRE CONVENANCE EN RESPECTANT LES REGLES DU CHAMP TRANS_ID.
							</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_currency</td>
							<td><input type="text" name="vads_currency" value="978"size=20></td>
							<td>Code devise 978 pour EURO.Plus d'info en consultant la <a href="https://systempay.cyberpluspaiement.com/html/Doc/2.2_Guide_d_implementation_formulaire_Paiement_V2.pdf">documentation</a> </td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_amount</td>
							<td><input type="text" name="vads_amount" value="1000"size=20></td>
							<td>Montant de la commande exprimé dans la plus petite unité de la devise. Centimes pour EURO Ex :1000 pour 10 euros</td>
						</tr>
						
						<tr>
							<td class="field_mandatory">vads_page_action</td>
							<td><input type="text" name="vads_page_action" value="PAYMENT" size=20></td>
							<td >Ce paramètre est obligatoire et doit être valorisé à PAYMENT. </td>
						</tr>
		
						<tr>
							<td class="field_mandatory">vads_action_mode</td>
							<td ><input type="text" name="vads_action_mode" value="INTERACTIVE"size=20></td>
							<td >Ce paramètre est valorisé à INTERACTIVE si la saisie de carte est réalisée sur la plateforme de paiement. Plus d'info en consultant la <a href="http://www.payzen.eu/integration/document/Guide_d_implementation_formulaire_paiement_V2_Payzen_V2.8.pdf">documentation</a></td>
						</tr>
						<tr>
							<td class="field_mandatory">vads_payment_config</td>
							<td><input type="text" name="vads_payment_config" value="SINGLE" size=20></td>
							<td>Ce paramètre est valorisé à SINGLE pour un paiement unitaire.</td>
						</tr>
						<tr>
							<td>vads_capture_delay</td>
							<td><input type="text" name="vads_capture_delay" value="" size=20></td>
							<td>Ce paramètre défini le délai de remise en banque en nombre de jour. Passé à vide la plateforme de paiement prend comme valeur par défaut la valeur défini dans le back office "outil de gestion de caisse.</td>
						</tr>
						<tr> 
						<td colspan="3" class="title_array">PARAMETRES CLIENT</td>
						</tr>
						
						<tr>
							<td>vads_order_id</td>
							<td><input type="text" name="vads_order_id" value="123456" size=20></td>
							<td>Numéro de commande. Paramètre facultatif. Longueur du champ 32 caractères maximum - Type Alpha numérique</td>
						</tr>
						
						<tr>
							<td>vads_cust_id</td>
							<td><input type="text" name="vads_cust_id" value="2380" size=20></td>
							<td>Numéro client. Paramètre facultatif. Longueur du champ 32 caractères maximum - Type Alpha numérique</td>
						</tr>
						<tr>
							<td>vads_cust_name</td>
							<td><input type="text" name="vads_cust_name" value="Henri Durand" size=20></td>
							<td>Nom du client. Paramètre facultatif. Longueur du champ 127 caractères maximum - Type Alpha numérique</td>
						</tr>
						<tr>
							<td>vads_cust_address</td>
							<td><input type="text" name="vads_cust_address" value="Bd Paul Picot" size=20></td>
							<td>Adresse du client. Paramètre facultatif. Longueur du champ 255 caractères maximum - Type Alpha numérique</td>
						</tr>
						<tr>
							<td>vads_cust_zip</td>
							<td><input type="text" name="vads_cust_zip" value="83200" size=20></td>
							<td>Code Postal du client. Paramètre facultatif. Longueur du champ 32 caractères maximum - Type Alpha numérique</td>
						</tr>
						<tr>
							<td>vads_cust_city</td>
							<td><input type="text" name="vads_cust_city" value="TOULON" size=20></td>
							<td>Ville du client. Paramètre facultatif. Longueur du champ 63 caractères maximum - Type Alpha numérique</td>
						</tr>
						<tr>
							<td>vads_cust_country</td>
							<td><input type="text" name="vads_cust_country" value="FR" size=20></td>
							<td>Pays du client. Code pays du client à la norme ISO 3166. Paramètre facultatif. Longueur du champ 2 caractères maximum - Type Alpha.</td>
						</tr>
						<tr>
							<td>vads_cust_phone</td>
							<td><input type="text" name="vads_cust_phone" value="06002822672" size=20></td>
							<td>Téléphone du client. Paramètre facultatif. Longueur du champ 32 caractères maximum - Type Alpha numérique</td>
						</tr>
						<tr>
							<td>vads_cust_email</td>
							<td><input type="text" name="vads_cust_email" value="test@test.fr" size=20></td>
							<td>Email du client. Paramètre facultatif.</td>
						</tr>
						
						<tr> 
						<td colspan="3" class="title_array">RETOUR A LA BOUTIQUE</td>
						</tr>
						
						<tr>
							<td>vads_url_return</td>
							<td><input type="text" name="vads_url_return" value="http://www.kidsdressing.com/payment_form/return_payment.php" size=20></td>
							<td>Url de retour à la boutique. Lorsque le client clique sur "retourner à la boutique". Cette url permet de faire un traitement affichage en indiquant l'état du paiement. Il est fortement conseillé de ne pas faire de traitement en base de données (mise à jour commande, enregistrement commande) suite à l'analyse du résultat du paiement.
							C'est l'appel de l'url serveur qui doit vous permettre de mettre à jour la base de données.
							 
							</td>
						</tr>


						<tr>
							<td>vads_return_mode</td>
							<td><input type="text" name="vads_return_mode" value="GET" size=20></td>
							<td>Ce paramètre définit dans quel mode seront renvoyés les paramètres lors du retour à la boutique (3 valeurs possibles GET / POST / NONE). Si ce champ n'est pas posté alors la plateforme ne renvoie aucun paramètre lors du retour à la boutique par l'internaute.</td>
						</tr>
						<tr>
							<td>vads_redirect_success_timeout</td>
							<td><input type="text" name="vads_redirect_success_timeout" value="5" size=20></td>
							<td>Ce paramètre définit la durée avant un retour automatique à la boutique pour un paiement accepté(valeur exprimée en seconde).</td>
						</tr>
						<tr>
							<td>vads_redirect_success_message</td>
							<td><input type="text" name="vads_redirect_success_message" value="Redirection vers la boutique dans quelques instants" size=20></td>
							<td>Ce paramètre définit un message sur la page de paiement avant le retour automatique à la boutique dans le cas d'un paiement accepté.</td>
						</tr>
						<tr>
							<td>vads_redirect_error_timeout</td>
							<td><input type="text" name="vads_redirect_error_timeout" value="5" size=20></td>
							<td>Ce paramètre définit la durée avant un retour automatique à la boutique pour un paiement échoué(valeur exprimée en seconde).</td>
						</tr>
						<tr>
							<td>vads_redirect_error_message</td>
							<td><input type="text" name="vads_redirect_error_message" value="Redirection vers la boutique dans quelques instants" size=20></td>
							<td>Ce paramètre définit un message sur la page de paiement avant le retour automatique à la boutique dans le cas d'un paiement échoué.</td>
						</tr>
						<tr> 
						<td colspan="3" class="title_array">URL SERVEUR => A PARAMETRER DANS LE BACK OFFICE PAYZEN </td>
						</tr>
						
						<tr>
							<td colspan="3">L'url serveur est une URL qui doit être renseignée dans le back office PAYZEN. Cette url est systematiquement appelée à la fin d'un paiement par la plateforme PAYZEN. Lors de cet appel la plateforme de paiement PAYZEN renvoie en mode POST l'ensemble des champs nécessaires à l'analyse du paiement ( paiement accepté ou paiement refusé ). <br/>Cet appel est indépendant du retour ou non de l'internaute vers la boutique.Cet appel doit vous permettre de mettre à jour votre systeme d'information. 
							Dans le cas où la plateforme n'arrive pas à joindre l'url serveur, vous recevrez automatiquement un mail vous indiquant le paiement concerné, vous pourrez alors analyser la raison de l'échec ( erreur http XXX ) et rejouer l'url serveur depuis le back office PAYZEN en cliquant sur la transaction et en sélectionnant "exécuter l'url serveur".		 
							<br/><br/> Dans ce pack vous pouvez faire pointer à titre d'exemple l'url serveur vers le fichier return_payment.php.
							</td>
						</tr>
					</table>
					<button type="submit" class="validationButton" >
				<span><em>Valider et envoyer les paramètres vers le fichier form_payment.php</em></span>
				</button>
				</form>
		
		
	</div>
		
	