<?php	

$contenu_body = '<div class="product_main" id="product_main">
	<p><img src="./data/img/T_Promotions.jpg" alt="Promotions" title="Promotions" /></p>';
//$contenu_body .= '<div class="product_content">';
$strRequest = "SELECT `refProd`, `nomProd`, `descriptionProd`, `qteProd`, `prixProd`, `imageProd`, `typeProd`, `qteVendue`, `promoProd`, `newProd`, `id_cat` FROM `produit` WHERE `promoProd`<>'0' ORDER BY Rand()";

$sqlResult = mysql_query($strRequest);
if($sqlResult === false || mysql_num_rows($sqlResult) === 0)
{
	$contenu_body .= '<p>Aucun article</p>';
	//$contenu_body .= mysql_error();
}else{
	$intCount = 0;
	while(list($ref, $name, $desc, $qte, $price, $img, $type, $qte_vendu, $promo, $new, $idCat) = mysql_fetch_row($sqlResult))
	{
		$promo = (int)$promo;
		if($intCount === 4)
		{
			$contenu_body .= '<div class="clear"></div>';
			$contenu_body .= '</div>';
			$intCount = 0;
		}
		if($intCount === 0)
		{
			$contenu_body .= '<div class="product_content">';	
		}
		$contenu_body .= '<div class="product_box">';
		$contenu_body .= '<div class="zone">';
		$contenu_body .= '<p><a href="./data/img/product/'.$img.'" rel="lightbox"><img class="icone" src="./data/img/product/'.$img.'" alt="'.utf8_decode($name).'" title="'.utf8_decode($name).'" /></a></p>';
		$contenu_body .= '</div>';
		$contenu_body .= '<p class="title"><marquee behavior="scroll" scrolldelay="170">'.utf8_decode($name).'</marquee></p>';
		$contenu_body .= '<p><a href="?cmd=detail_article&id='.$ref.'"><img src="./data/img/b_Plus2detail.jpg" alt="Plus de détail" title="Plus de détail" /></a>';
		if($new === 'oui')
		{
			$contenu_body .= '&nbsp;&nbsp;<img src="/data/img/ico_new.jpg" alt="News" title="News" />';
		}
		else
		{
			$contenu_body .= '&nbsp;&nbsp;<img src="/data/img/ico_newNo.jpg" />';
		}
		$contenu_body .= '</p>';

		if($promo !== 0)
		{
			//$floOldPrice = number_format(round(($price * $promo) / 100, 2, PHP_ROUND_HALF_UP), 2, ',', ' ');
			$floOldPrice = ($price * $promo) / 100;
			$floOldPrice = $price - $floOldPrice;
			$test = strrchr($floOldPrice, '.');
			if(strlen($test) === 2)
				$floOldPrice .= "0";
			$contenu_body .= '<p class="price"><span>'.number_format($price, 2, '.', ' ').' &euro;</span> '.number_format($floOldPrice, 2, '.', ' ').' &euro;</p>';
			$contenu_body .= '<p class="reduc">soit '.$promo.' % de r&eacute;duction</p>';
		}else{
			$contenu_body .= '<p class="price">'.number_format($price, 2, '.', ' ').' &euro;</p>';
		}
		if($qte > 0){
			if($idCat == 14 || $idCat == 15){
				$contenu_body .= '<form method="post" onSubmit="addItem('.$ref.'); return false;"><p class="qte">Qt&eacute; <input type="text" class="quantity" name="'.$ref.'_quantity" id="'.$ref.'_quantity" value="1" />&nbsp;T.';
				$contenu_body .= '<SELECT name="taille"> <OPTION selected value="">U</OPTION> <OPTION value="S">S</OPTION> <OPTION value="M">M</OPTION> <OPTION value="L">L</OPTION> <OPTION value="XL">XL</OPTION> </SELECT>';
				$contenu_body .=' <input type="submit" id="qte_submit" value="" /></form></p>';
			}
			else{
				$contenu_body .= '<form method="post" onSubmit="addItem('.$ref.'); return false;"><p class="qte">Quantit&eacute; <input type="text" class="quantity" name="'.$ref.'_quantity" id="'.$ref.'_quantity" value="1" /> <input type="submit" id="qte_submit" value="" /></form></p>';
			}
		}
		else{
			$contenu_body .='<div id="rupture">Rupture de stock !</div>';
		}

		$contenu_body .= '</div>';
		$intCount++;
	}
	$contenu_body .= '<div class="clear"></div>';
	$contenu_body .= '</div>';
}  
$contenu_body .= '</div>';
?>