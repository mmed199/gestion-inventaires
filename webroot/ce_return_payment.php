<!-- ------------------------------------------------- 
Exemple de code php - Formulaire de paiement unitaire
VERSION 1.0a - Lyra Network
------------------------------------------------------ -->

<?php
include ("./ce_function_payement.php");

// --------------------------------------------------------------------------------------
// RENSEIGNER LA VALEUR DU CERTIFICAT
// --------------------------------------------------------------------------------------
$key = "4594473116797148";
if ($key=="0") {
	echo "ERREUR:Veuillez renseigner la valeur de votre certificat à la ligne 12 du fichier return_payment.php fourni dans ce pack.<br/>";
	echo "Cela est impératif afin que le script puisse contrôler la signature.";
	die;
}

// --------------------------------------------------------------------------------------
// CONTROLE DE LA SIGNATURE RECUE
// --------------------------------------------------------------------------------------

$control = Check_Signature($_REQUEST,$key);
if($control == 'true'){

echo ("Signature Valide <br/>");

//---------------------------------------------------------------------------------------

// --------------------------------------------------------------------------------------
// CONTROLE DU RESULTAT DU PAIEMENT 
// On vérifie si le paramètre vads_result est égal 00.
// Pour en savoir plus merci de consulter la documentation.
// --------------------------------------------------------------------------------------

if($_REQUEST['vads_result'] == "00")
	{
	switch ($_REQUEST['vads_auth_mode']) {
	case "FULL":
		echo "---------------------------------------------------------------------------------------------<br/>";
		echo "Paiement accepté pour le montant total de la transaction. <br/>";
		echo "vads_result=00 et vads_auth_mode=FULL  ( consulter la documentation pour plus d'information ).<br/>";
		echo "---------------------------------------------------------------------------------------------<br/>";
		break;
	case "MARK":
		echo "------------------------------------------------------------------------------------------------------------------------------<br/>";
		echo "Paiement accepté liée à une empreinte de la transaction  ( remise en banque >6 jours ). <br/>"; 
		echo "vads_result=00 et vads_auth_mode=MARK  ( consulter la documentation pour plus d'information ).<br/>";
		echo "ATTENTION le Paiement pourra être refusé ultérieurement lors de l'autorisation pour le montant total de la transaction. <br/>";
		echo "-------------------------------------------------------------------------------------------------------------------------------<br/>";
	break;

		}	
	
	}
	else
	{
		echo "-------------------------------------------------------------------------------------------<br/>";
		echo "Paiement refusé ou referral<br/>";
		echo "-------------------------------------------------------------------------------------------<br/>";
	}
}
else
{
	echo "-------------------------------------------------------------------------------------------<br/>";
	echo " Signature invalide - ne pas prendre en compte le résultat de ce paiement<br/>";
	echo "-------------------------------------------------------------------------------------------<br/>";
}

// -----------------------------------------------------------------------------------------------------------

// --------------------------------------------------------------------------------------
// Affichage des paramètres recus 
// --------------------------------------------------------------------------------------

echo "liste des paramètres réceptionnés:<br/>";
foreach ($_REQUEST as $nom => $valeur)
{
	if(substr($nom,0,5) == 'vads_')
	{
		echo "$nom = $valeur <br/>";	
	}
}

// --------------------------------------------------------------------------------------


?>