<!-- ------------------------------------------------- 
Exemple de code php - Formulaire de paiement unitaire
VERSION 1.0a - Lyra Network
------------------------------------------------------ -->

<?php

/*--------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------
FONCTION => Exemple de génération de trans_id basé sur un compteur.
Trans_id est un identifiant de transaction qui doit être:
		- unique sur une même journée
		- compris entre 000000 et 899999
		- de longueur 6 ( 6 caractères )
---------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/

function get_Trans_id() {
	// Dans cet exemple la valeur du compteur est stocké dans un fichier count.txt,incrémenté de 1 et remis à zéro si la valeur est superieure à 899999
	// ouverture/lock 
	$filename = "./compteur/count.txt";// il faut ici indiquer le chemin du fichier.
	$fp = fopen($filename, 'r+');
	flock($fp, LOCK_EX);

	// lecture/incrémentation
	$count = (int)fread($fp, 6);    // (int) = conversion en entier.
	$count++;
	if($count < 0 || $count > 899999) {
		$count = 0;
	}

	// on revient au début du fichier
	fseek($fp, 0);
	ftruncate($fp,0);

	// écriture/fermeture/Fin du lock
	fwrite($fp, $count);
	flock($fp, LOCK_UN);
	fclose($fp);

	// le trans_id : on rajoute des 0 au début si nécessaire
	$trans_id = sprintf("%06d",$count);
	return($trans_id);
}

// -------------------------------------------------------------------------------------------------------------------

/*--------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------
FONCTION => CALCUL DE LA SIGNATURE
---------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function get_Signature($field,$key) {
	ksort($field); // tri des paramétres par ordre alphabétique
	$contenu_signature = "";
	foreach ($field as $nom => $valeur)
	{
		if(substr($nom,0,5) == 'vads_') {
		$contenu_signature .= $valeur."+";
		}
	}
	$contenu_signature .= $key;	// On ajoute le certificat à la fin de la chaîne.
	$signature = sha1($contenu_signature);
	return($signature);

}

//--------------------------------------------------------------------------------------------------------------------


/*--------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------
FONCTION => CONTROLE DE LA SIGNATURE RECUE
---------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function Check_Signature($field,$key) {
	$result='false';

	$signature=get_Signature($field,$key);

	if(isset($field['signature']) && ($signature == $field['signature']))
	{
		$result='true';
		
	}
	return ($result);
}

//--------------------------------------------------------------------------------------------------------------------


/*--------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------
FONCTION => GENERATION DU TABLEAU DE TOUS LES CHAMPS A ENVOYER A LA PLATEFORME
Les champs doivent être encodés en UTF8 obligatoirement- Seul les champs commençant par vads_xxxx sont envoyés.
---------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function get_formHtml_request($field,$key) {

	$params=array();
		foreach ($field as $nom => $valeur)
		{
			if(substr($nom,0,5) == 'vads_') {
			//$params[$nom]=	utf8_encode($valeur);
			$params[$nom]=($valeur);
			}
		}
	$params['vads_trans_id']=get_Trans_id();
	$params['vads_trans_date'] = gmdate ("YmdHis", time());
	$params['signature'] = get_Signature($params,$key);

	$form= '<form method="POST" action="https://paiement.systempay.fr/vads-payment/" id="form-paiement-cb">';
	foreach ($params as $nom => $valeur)
			{
				//$form.=$nom.' : '.$valeur.'<br/>';
				$form.='<input type="hidden" name="' . $nom . '" value="' . $valeur . '" />';	
			}
	$form.='<button type="submit" class="validationButton" >';
	$form.=	'<span><em>Payer ma commande</em></span>';
	$form.='</button></form>';
	return($form);

}
//----------------------------------------------------------------------------------------------------------------------


?>