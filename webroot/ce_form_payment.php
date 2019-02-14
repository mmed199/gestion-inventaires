<?php
include ("ce_function_payement.php");


/* --------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------
CREATION DU FORMULAIRE DE PAIEMENT 
Le formulaire de paiement est composé de l'ensemble des champs vads_xxxxx contenu dans le tableau $params 
Celui-ci est envoyé à la plateforme de paiement à l'url suivante :https://secure.payzen.eu/vads-payment/

---------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------- */

// recupération du certificat
$key = $_REQUEST['key'] ; 

// CREATION DU FORMULAIRE DE PAIEMENT  encodé en UTF8
$form = get_formHtml_request($_REQUEST,$key); 
?>



<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Redirection vers la plateforme de paiement</title>
<link href="/data/css/ce-style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="contenair_form">

<?php
echo $form;
?>



</div>
</body>
</html> 
