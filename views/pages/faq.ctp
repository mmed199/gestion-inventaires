php
	$strPageTitle = "Foire à questions  - kidsdressing";
	
$action = $_GET['action'];	
	/*
	RewriteRule ^faq/code-promotionnel.html$ /index.php?cmd=faq&action=code-promo [L]
RewriteRule ^faq/a-propos-kidsdressing.html$ /index.php?cmd=faq&action=kidsdressing [L]
RewriteRule ^faq/service-client.html$ /index.php?cmd=faq&action=service-client [L]
RewriteRule ^faq/mon-compte.html$ /index.php?cmd=faq&action=mon-compte [L]
RewriteRule ^faq/mes-commandes.html$ /index.php?cmd=faq&action=mes-commandes [L]
RewriteRule ^faq/paiements.html$ /index.php?cmd=faq&action=paiements [L]
RewriteRule ^faq/vendre-sur-kidsdressing.html$ /index.php?cmd=faq&action=vendre [L]
RewriteRule ^faq/echanges-retours.html$ /index.php?cmd=faq&action=echanges-retours [L]
RewriteRule ^faq/livraison.html$ /index.php?cmd=faq&action=livraison [L]
	*/
$contenu_body = <<<EOF
<div id="main" class="texte faq">
     	<div class="faq-g">
			<br>
			<ul>
				<li><a href="/faq/a-propos-kidsdressing.html">A propos de Kidsdressing</a></li>
				<li><a href="/faq/service-client.html">Service Client</a></li>
				<li><a href="/faq/mon-compte.html">Mon compte</a></li>
				<li><a href="/faq/vendre-sur-kidsdressing.html">Vendre sur Kidsdressing</a></li>
				<li><a href="/faq/securite-confidentialite.html">Sécurité et confidentialité</a></li>
				<li><a href="/faq/mes-commandes.html">Mes commandes</a></li>
				<li><a href="/faq/paiements.html">Paiements</a></li>
				<li><a href="/faq/livraison.html">Livraison</a></li>
				<li><a href="/faq/code-promotionnel.html">Code promotionnel</a></li>
				<li><a href="/faq/echanges-retours.html">Echanges et retours</a></li>
			</ul>
		</div>
		<div class="faq-d">
EOF;
	
	
	switch ($action){
		case 'code-promo':
			$strPageTitle = "Code promotionnel";
			include ("faq/script.code-promo.php");
			break;
		case 'kidsdressing':
			$strPageTitle = "A propos de Kidsdressing";
			include ("faq/script.kidsdressing.php");
			break;
		case 'service-client':
			$strPageTitle = "Service client";
			include ("faq/script.service-client.php");
			break;	
		case 'mon-compte':
			$strPageTitle = "Mon compte";
			include ("faq/script.mon-compte.php");
			break;
		case 'securite-confidentialite':
			$strPageTitle = "Sécurité et confidentialité";
			include ("faq/script.securite-confidentialite.php");
			break;
				
		case 'mes-commandes':
			$strPageTitle = "Mes commandes";
			include ("faq/script.mes-commandes.php");
			break;	
		case 'paiements':
			$strPageTitle = "Paiements";
			include ("faq/script.paiements.php");
			break;	
		case 'vendre':
			$strPageTitle = "Vendre sur Kidressing";
			include ("faq/script.vendre.php");
			break;	
		case 'echanges-retours':
			$strPageTitle = "Echanges et retours";
			include ("faq/script.echanges-retours.php");
			break;	
		case 'livraison':
			$strPageTitle = "Livraison";
			include ("faq/script.livraison.php");
			break;	
		
	}
	$strPageTitle .= " | Foire Aux Questions | Kidsdressing";


$contenu_body .=<<<EOF
		</div>	
	</div>
	 <div class="clear"></div>
	
EOF;
?>