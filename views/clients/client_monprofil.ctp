<?php
	$this->set('page_title', __("Mes coordonnées",true) .' | ' . __('Espace client',true));
	$langCode = Configure::read('Config.langCode');  
	$this->set ('page_noindex','<META NAME="robots" CONTENT="noindex,nofollow">');
?>

<div class="block-compte-left">
<h1><?php echo __("Mes coordonnées",true);?></h1>
<br>
<?php echo __("Civilité",true);?> : <?php echo !empty($client['Client']['civilite'])?$client['Client']['civilite']:" "; ?> <br/>
<?php echo __("Nom",true);?> : <?php echo $client['Client']['nom'] ; ?> <br/>
<?php echo __("Prénom",true);?> : <?php echo $client['Client']['prenom'] ; ?> <br/>
<?php echo __("Email",true);?> : <?php echo $client['Client']['email'] ; ?> <br/>
<?php echo __("Date de naissance",true);?> : <?php echo !empty($client['Client']['date_naissance'])?$client['Client']['date_naissance']:""; ?> <br/>
<?php echo __("Société",true);?> : <?php echo !empty($client['Client']['societe'])?$client['Client']['societe']:"" ; ?> <br/>
<?php echo __("Adresse",true);?> : <?php echo !empty($client['Client']['adresse'])?$client['Client']['adresse']:""; ?> <br/>
<?php echo __("Ville",true);?> : <?php echo !empty($client['Client']['ville'])?$client['Client']['ville']:""; ?> <?php echo $client['Client']['codepostal'] ; ?><br/>
<?php echo __("Pays",true);?> : <?php echo !empty($client['Client']['pays'])?$client['Client']['pays']:""; ?> <br/>
<?php echo __("Téléphone",true);?> : <?php echo !empty($client['Client']['tel'])?$client['Client']['tel']:""; ?> <br/>
<!--
Nombre de commandes: <?php echo $client['Client']['order_count']; ?> <br/>
Langue : <img src="/img/<?php echo $client['Client']['lang']; ?>.png" /> <?php echo $client['Client']['lang']; ?>  <br/>
Date d'inscription: <?php echo $client['Client']['created'] ; ?> <br/>
-->
<br>
<a href="/client/clients/modifier"><?php echo __("Modifier",true);?></a>

</div>