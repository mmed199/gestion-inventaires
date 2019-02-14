<?php
 

$site_url = Configure::read('site_url');
$id_produit = $p ['Produit']['id'];
$marque_nom = $p['Marque']['nom'];
$matiere_nom =   $p['Matiere']['nom'];
$matiere_slug =   $p['Matiere']['slug'];
$type_nom = $p['Type']['nom'] ;
$type_slug	= $p['Type']['slug'] ;
$produit_slug = $p['Produit']['slug'];


$prix = number_format($p ['Produit']['prix'] , 0, '.', ' ');
$prixSolde = number_format($p ['Produit']['prixSolde'] , 0, '.', ' ');
$cheminPhoto = "";
$altImage = $type_nom . " ". $marque_nom . " ". $matiere_nom;
$cheminPhoto = "/_img/w140-h140/uploads/produits/".$p ['Produit']['image1Prod'];
$titre_produit = $p ['Produit']['nom'] ;
?>	
<div class="sproduit">
	<div class="sprod-image">
		<a href="<?php echo "/bijoux/$type_slug/$id_produit-$produit_slug-$matiere_slug.html";?>" title="<?php echo $titre_produit;?>">
			<img src="<?php echo "$cheminPhoto";?>" alt="<?php echo $altImage;?>" title="<?php echo $titre_produit;?>"/>
		</a>
	</div>
	<div class="sprod-detail">
		<a href="<?php echo "/bijoux/$type_slug/$id_produit-$produit_slug-$matiere_slug.html";?>" title="<?php echo $titre_produit;?>">
			<div class="infos_prod">
				<?php //echo $info_prod;?>
				<span style="font-size:12px;"><?php echo $titre_produit;?> </span>
			</div> 
			<div class='price'><?php  if($prixSolde != 0)
						echo "<span class='sprod-prix'>$prixSolde &euro;</span><span style='font-size:10px;'> au lieu de</span> <del>$prix &euro;</del> ";
					else
						echo "<span class='sprod-prix'>$prix &euro;</span>";?>
						
			</div>
		</a>		
	</div>		
</div>




