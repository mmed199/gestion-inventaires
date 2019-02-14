<?php $this->set ('page_title', 'Afficher article | kidsdressing');?>
<h3>Informations article</h3>
<div id="fiche-produit">
	<div id="ficheimg">			
		<div id="bigimage" >
		  <img id="bigimmgpre" src="http://www.kidsdressing.com/uploads/produits/<?php echo  $article['Produit']['image1Prod']  ;?>" alt="" /></a>
		</div>
		<div id="icons" style="float:left;margin-left:5px;" >
			 
				<a class="imgcl" alt="http://www.kidsdressing.com/uploads/produits/<?php echo  $article['Produit']['image1Prod']  ;?>" >
					<img  src="http://www.kidsdressing.com/uploads/produits/<?php echo  $article['Produit']['image1Prod']  ;?>" alt="" />
				</a>							 
				<a class="imgcl" alt="http://www.kidsdressing.com/uploads/produits/<?php echo  $article['Produit']['image2Prod']  ;?>" >
					<img src="http://www.kidsdressing.com/uploads/produits/<?php echo  $article['Produit']['image2Prod']  ;?>" alt="" />
				</a>
				<a class="imgcl" alt="http://www.kidsdressing.com/uploads/produits/<?php echo  $article['Produit']['image3Prod']  ;?>" >
					<img src="http://www.kidsdressing.com/uploads/produits/<?php echo  $article['Produit']['image3Prod']  ;?>" alt="" />
				</a>
		</div> 
		<div class="clear"></div>
		<br>
		<a href="/member/produits/modifier_images/<?php echo $article['Produit']['id'] ; ?>" style="color: #EF377D;font-size:12px;">Modifier image</a><br>
	</div>
	<div id='contenu-actions'>
		<a href="/member/produits/modifier/<?php echo $article['Produit']['id'] ; ?>"><img alt="Modifier l'article" src="/_admin/img/edit.png"></a>
	</div>
	<div style="clear:both;"></div>
	<div id="fiche-entete">
		<div id="fiche-titre">
			<span class="dlabel encadree">Référence :</span>
			<span class="dvaleur inf"  style="width: 220px;"><?php echo  $article['Produit']['id']  ; ?></span>
			<span class="dlabel" style="width: 80px;">Statut :</span>
			<span class="dprix dlabel-spe"><?php switch ( $article['Produit']['statut']){
						case 0 :
							echo "<span class='alert'>En attente de validation</span>";
							break;
						case 1 :
							echo "<span class='inf'>Validé</span>";
							break;
						case 3 :
							echo "<span class='alert'>Modifié en attente de validation</span>";
							break;
						case 4 :
							echo "<span class='refus'>Refusé</span>";
							break;
					}
				?> 
			</span>			
		</div>
	</div>
	<div id="left-col">
		
		<div id="fichedescription">
			<span class="price-btcarac encadree">Marque :</span>
			<span class="dprix" style="width:250px;"><?php echo  $article['Marque']['nom']  ; ?></span>
			<div style="clear:both;"></div>
			<span class="price-btcarac encadree">Type :</span>
			<span class="dprix" style="width:250px;"><?php echo  $article['Type']['nom']  ; ?> </span>
			<div style="clear:both;"></div>
			<span class="price-btcarac encadree">Prix :</span>
			<span class="dprix"><?php echo  $article['Produit']['prix']  ; ?> €</span>
			<span class="price-btcarac encadree">Prix soldé :</span>
			<span class="dprix"><?php echo  $article['Produit']['prixSolde']  ; ?> €</span>
			<div style="clear:both;"></div>
			
			<span class="price-btcarac encadree">Sexe :</span>
			<span class="dprix"><?php echo  $article['Sexe']['nom']  ; ?> </span>
			<span class="price-btcarac encadree">Matière :</span>
			<span class="dprix"><?php echo  $article['Matiere']['nom']  ; ?></span>
			<span class="price-btcarac encadree">Etat :</span>
			<span class="dprix"><?php echo  $article['Etat']['nom']  ; ?> </span>
			<div style="clear:both;"></div>
			<span class="price-btcarac encadree">Saison :</span>
			<span class="dprix"><?php echo  $article['Saison']['nom']  ; ?> </span>
			<span class="price-btcarac encadree">Réf (client) :</span>
			<span class="dprix"><?php echo  $article['Produit']['refProduitClient']  ; ?> </span>
			<div style="clear:both;"></div>	
			
			<span class="price-btcarac encadree">Description :</span>
			<div id="desc-annonce">
				<?php echo  $article['Produit']['commProd']  ; ?>
			</div>
			<div style="clear:both;"></div>						
			<span class="price-btcarac encadree">Variantes :</span>
			<div style="clear:both;"></div>	
			<center>
				<table class="liste-cmd">
					<thead> 
						<tr>
							<th class="col_21">Id variante</th>
							<th class="col_21">Couleur</th>
							<th class="col_21">Taille</th>
							<th class="col_21">Stock</th>
							<?php  if($this->Session->check('Auth.Member.type_compte') != 0){ ?>
							<th class="col_21"><a href ="/member/produits/variete_ajouter/<?php echo $article['Produit']['id'];?>"><img src="/_admin/img/add.png" alt="Ajouter" title="" border="0" /></a></th>
							<?php }else{?>
							<th class="col_21"></th>
							<?php }?>
						</tr>
					</thead> 
					<tfoot>
					</tfoot>
					<tbody id="test-list">
						<?php foreach ($varietes as $v) : ?>
						<tr id="listItem_1" >
						<td><center><?php echo $v['Variete']['id'];?></center></td>
						<td><center><?php echo $v['Couleur']['nom'];?></center></td>
						<td><center><?php echo $v['Taille']['nom'];?></center></td>
						<td><center><?php echo $v['Variete']['stock'];?></center></td>
						<td>
							<center><a href ="/member/produits/variete_modifier/<?php echo $v['Variete']['id'];?>"><img src="/_admin/img/edit.png" alt="Modifier" title="" border="0" /></a>
								<a href ="/member/produits/variete_delete/<?php echo $v['Variete']['id'];?>"><img src="/_admin/img/delete.png" alt="Supprimer" title="" border="0" /></a>
							</center>
						</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</center>		
		</div><!--fichedescription-->			
	</div><!-- left col -->		
	<div style="clear:both;"></div>		
</div>