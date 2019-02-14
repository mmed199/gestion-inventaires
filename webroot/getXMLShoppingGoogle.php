<?php
//fonction de mise à jour du fichier de Google Shopping Flux
function updateGoogleShoppingFlux (){

	$strRequest = "SELECT p.id, p.prixProd, p.prixSolde, p.image1Prod,
		p.image2Prod, p.image3Prod, p.image4Prod, p.commProd, p.sexe_id, 
		s.nom, p.marque_id, m.nom, m.is_createur, p.type_id, y.nomType,y.nomTypeP,y.url_t,y.google_product_category,
		e.id_etat, e.nomEtat, 
		a.nomMatiere, cl.pseudoCli,cl.id_client, cl.statut, cl.cpCli, cl.villeCli, cl.dateInscriCli, 
		p.seller, p.status, cd.logo, cat.nomCategorie,p.multi_lot,m.url_m,cat.url_c,p.date,
		p.tagProd,p.deleted,p.status
	FROM `produit` AS p

	LEFT OUTER JOIN `sexe` AS s ON ( s.id_sexe = p.id_sexe )
	LEFT OUTER JOIN `marque` AS m ON ( m.id_marque = p.id_marque )
	LEFT OUTER JOIN `type` AS y ON ( y.id_type = p.id_type )
	LEFT OUTER JOIN `categorie` AS cat ON ( cat.id_categorie = y.id_categorie )
	LEFT OUTER JOIN `etat` AS e ON ( e.id_etat = p.id_etat )
	LEFT OUTER JOIN `matiere` AS a ON ( a.id_matiere = p.id_matiere )
	LEFT OUTER JOIN `client` AS cl ON ( cl.mailCli = p.seller )
	LEFT OUTER JOIN client_desc AS cd ON ( cl.mailCli = cd.mailCli ) ";

		$strRequest = $strRequest . " WHERE p.status = 1 and p.deleted =0 and  p.statutProd != 'vendu' and p.commProd != '' order by refProd asc ";
	//echo $strRequest ;
	$sqlResult = mysql_query($strRequest);

				
	$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
 	//$xml = "<?xml version='1.0' encoding='UTF-8' standalone='yes'>\n";
	$xml .= '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">'."\n";
	$xml .= "<channel>\n";
	$xml .= "<title>Produits Kidsdressing</title>\n";
	$xml .= "<link>http://www.kidsdressing.com</link>\n";
	$xml .= "<description>Kidsdressing</description>\n";
	$xml .= "<generator>AS Net</generator>\n";
	file_put_contents("xml/produits-google-shopping-kidsdressing.xml",$xml);
	$total = 0;
	while($ligne = mysql_fetch_array($sqlResult)){
		$xml = "";
		$nomSexe = $ligne['nomSexe'];
		$nomSexe_a = no_special_character_v2($ligne['nomSexe']);
		$refProd = $ligne['refProd'];
		$prixProd = $ligne['prixProd'];
		if ($ligne['prixSolde'] > 0  && $ligne['prixSolde'] != $ligne['prixProd'] ){
			$prixBarre = $ligne['prixSolde'];
			$mntRemise = $ligne['prixProd'] - $ligne['prixSolde'] ;
		}else{
			$prixBarre = 0;
			$mntRemise = 0;
		}
		$ref_client = $ligne['id_client'];
		$nomMarque = $ligne['nomMarque'];
		if (  $nomMarque != "autre")
			$nom_produit = $ligne['nomType'] . " " . strtolower ($ligne['nomSexe']) . " " . $nomMarque ;
		else
			$nom_produit = $ligne['nomType'] . " " . strtolower ($ligne['nomSexe'])  ;
		$description_court = $ligne['nomType'] . " " . strtolower ($ligne['nomSexe']) ;
		$description = $ligne['commProd'];
		$nomCategorie = $ligne['nomCategorie'];
		
		$nomType = $ligne['nomType'];
		$google_product_category = $ligne['google_product_category'];
		$nomMatiere = $ligne['nomMatiere'];
		$id_etat = $ligne ['id_etat'];
		if ( ($id_etat == 4) || ($id_etat == 5) )
			$nomEtat = "new";
		else
			$nomEtat = "used";
		$nomCouleur = $ligne['nomCouleur'];
		$nomTaille = $ligne['nomTaille'];
		
		$mots_clefs = strtolower($nomCategorie) ."," . strtolower($nomCategorie) . " marque ," . strtolower($nomType).",".$nomSexe_a.",".strtolower($nomMarque).", enfant, " .strtolower($nomMatiere); 
		$url_m = $ligne['url_m'];
		$url_t = $ligne['url_t'];
		
		if ( $ligne['isCreateur'] == 1 )
			$url_marque = "/depot-vente-".$url_m.".html";
		else
			$url_marque = "/".$url_m."/vetement-enfant.html";
		
		$url_c = $ligne['url_c'];
		//$url_categorie = "/".$url_c . "-enfant-".$nomSexe_a .".html";
		//$url_type = "/".$url_c . "-enfant-".$nomSexe_a ."-type-".$url_t.".html";
		$url_produit = "http://www.kidsdressing.com/".$url_m."/".$url_c."s-enfant/".$refProd."-".$url_t."-".$nomSexe_a.".html";
		
		$image1Prod = $ligne['image1Prod'];
		$image2Prod = $ligne['image2Prod'];
		$image3Prod = $ligne['image3Prod'];
		$url_photo_1 = "";
		$url_photo_2 = "";
		$url_photo_3 = "";
		
		
			
		if (file_exists("data/img/product/$image1Prod")){//si l'image du produit existe
			//echo "photo n'existe pas <br>";
			//$total ++;
			//}
			$url_photo_1 = "http://www.kidsdressing.com/data/img/product/$image1Prod";		
			if (file_exists("data/img/product/$image2Prod"))
				$url_photo_2 = "http://www.kidsdressing.com/data/img/product/$image2Prod";
			
			if (file_exists("data/img/product/$image3Prod"))
				$url_photo_3 = "http://www.kidsdressing.com/data/img/product/$image3Prod";
			
			
			$req ="select distinct t.id_taille,t.nomTaille,lpt.stock from ligneprod_lot as lpt 
			LEFT OUTER JOIN taille as t on (t.id_taille = lpt.id_taille)
			where lpt.stock > 0 and lpt.refProd = ".$refProd;
			$sqlResult1 = mysql_query($req);
			
			while($ligne_1 = mysql_fetch_array($sqlResult1)){
				$stock = $ligne_1 ['stock'];
				if ($ligne['statutProd'] == "vendu" || $stock == 0 ){
					$lbl_stock = "out of stock";
				}else{
					$lbl_stock = "in stock";
				}
				$id_taille = $ligne_1 ['id_taille'];
				$nomTaille = $ligne_1 ['nomTaille'];
				$nomCouleur = "";
				//recherche la liste des couleurs du produit
				$req ="select c.nomCouleur from ligneprod_lot as lpt 
				LEFT OUTER JOIN couleur as c on (c.id_couleur = lpt.id_couleur)
				where lpt.refProd = ".$refProd . " and lpt.id_taille = " .$id_taille;
				$sqlResult2 = mysql_query($req);
				while($ligne_2 = mysql_fetch_array($sqlResult2)){
					$nomCouleur .= $ligne_2['nomCouleur'] ."/";
				}
				$xml="<item>\n";
				$xml.="<g:id>".$refProd."</g:id>\n";
				$xml.="<reference-fournisseur>".$ref_client."</reference-fournisseur>\n";
				$xml.="<title><![CDATA[".$nom_produit."]]></title>\n";
				$xml.="<description><![CDATA[".$description."]]></description>\n";
				$xml.="<mots-cles><![CDATA[".$mots_clefs."]]></mots-cles>\n";
				$xml.="<g:condition>".strtolower($nomEtat)."</g:condition>\n";
				$xml.="<g:availability>".$lbl_stock."</g:availability>\n";//disponible en stock ou non
				$xml.="<link><![CDATA[".$url_produit ."]]></link>\n";
				$xml.="<g:image_link><![CDATA[".$url_photo_1."]]></g:image_link>\n";
				$xml.="<g:additional_image_link><![CDATA[".$url_photo_2."]]></g:additional_image_link>\n";
				$xml.="<g:additional_image_link><![CDATA[".$url_photo_3."]]></g:additional_image_link>\n";
				$xml.="<g:brand><![CDATA[".$nomMarque."]]></g:brand>\n";
				$xml.="<g:product_type><![CDATA[".$nomCategorie."]]></g:product_type>\n";//a revoir
				$xml.="<g:price>".$prixProd." EURO</g:price>\n";
				if ($prixBarre > 0 ) {
					$xml.="<g:sale_price>".$prixBarre." EURO</g:sale_price>\n";
					$xml.="<g:sale_price_effective_date></g:sale_price_effective_date>\n";
				}
				$xml.="<g:shipping>\n";
				$xml.="<g:country>FR</g:country>\n";
				$xml.="<g:service>Colissimo</g:service>\n";
				$xml.="<g:price>6.90 EURO</g:price>\n";
				$xml.="</g:shipping>\n";
				$xml.="<g:age_group>kids</g:age_group>\n";
				$xml.="<g:gender>".(strtolower($nomSexe)== "garçon"?"male":(strtolower($nomSexe)== "fille"?"female":"unisex"))."</g:gender>\n";
				$xml.="<g:color><![CDATA[".$nomCouleur."]]></g:color>\n";
				$xml.="<g:size>".$nomTaille."</g:size>\n";
				$xml.="<g:shipping_weight>500 g</g:shipping_weight>\n";	
				 //construire catégorie de google
				$xml.="<g:google_product_category><![CDATA[".$google_product_category."]]></g:google_product_category>\n";
				$xml.="<matiere>".$nomMatiere."</matiere>\n";
				 
				$xml.="<quantite>".$stock."</quantite>\n";
				 if( $nomCategorie == "Chaussures")
					$xml.="<pointure>".$nomTaille."</pointure>\n";
				 else
					$xml.="<pointure></pointure>\n";
					
				// $xml.="<dimension></dimension>\n";
				 
				 //$xml.="<g:url_categorie><![CDATA[".$url_categorie."]]></g:url_categorie>\n";
				 //$xml.="<g:url_sous-categorie><![CDATA[".$url_type."]]></g:url_sous-categorie>\n";
				 //$xml.="<g:url_sous-sous-categorie></url_sous-sous-categorie>\n";
				 //$xml.="<g:url_page_marque><![CDATA[".$url_marque."]]></url_page_marque>\n";
				  
				  $xml.="</item>\n";
				  file_put_contents("xml/produits-google-shopping-kidsdressing.xml",$xml,FILE_APPEND);
			
			}
			//LEFT OUTER JOIN couleur on (lpt.refProd = p.refProd)
			
		}

		
	} // while
	$xml .="</channel>\n";
	$xml .= "</rss>\n";
	//echo $total;
	file_put_contents("xml/produits-google-shopping-kidsdressing.xml",$xml,FILE_APPEND);
}


?>