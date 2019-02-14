<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Détail de la demande </h2>
	</div>
	<div id='contenu-actions'>
		<?php if ($demande['Demande']['valide']!= 1) { ?>
		<a href="/admin/demandes/valider/<?php echo  $demande['Demande']['id']  ; ?>" title="Valider" alt="Valider"><img src="/_admin/img/valid.png" width="22px" height="22px"/></a>
		<?php } ?>	
		<a href="/admin/demandes/<?php echo ($demande['Demande']['tag_offre'] ==  1 ? 'modifier_offre':'modifier');?>/<?php echo $demande['Demande']['id'] ; ?>"><img src="/_admin/img/edit.png" alt="Modifier" title="Modifier" border="0" /></a>
		<a href="/admin/demandes/supprimer/<?php echo  $demande['Demande']['id']  ; ?>"><img src="/_admin/img/delete.png" title="Supprimer" alt="Supprimer"></a>	
		<?php if ($demande['Demande']['details_added']== 0) { ?>			
		<a href="/admin/demandes/ajouter_details/<?php echo  $demande['Demande']['id']  ; ?>" title="Ajouter détails" alt="Ajouter détails"><img src="/_admin/img/add.png" width="22px" height="22px"/></a>
		<?php }else{  ?>
		<a href="/admin/demandes/modifier_details/<?php echo  $demande['Demande']['id']  ; ?>" title="Modifier détails" alt="Modifier détails"><img src="/_admin/img/edit.png" width="22px" height="22px"/></a>
		<?php }?>
		<a href="#"><img src="/_admin/img/print.png" title="Imprimer" alt="Imprimer"></a>
		<a href="#"><img src="/_admin/img/excel.png" title="Exporter" alt="Exporter"></a>
	</div>
</div>


<div id="fiche-produit">
	<div id="fiche-entete">
		<div id="fiche-titre">
		<label>Référence : </label><label class='inf'><?php echo  $demande['Demande']['id']  ; ?></label>
			<label>&nbsp;&nbsp;Mise en ligne</label> <label class='inf'><?php 
								$datefr_j_mois = date("d/m/Y",strtotime($demande['Demande']['created'])) ; 
													
								$date_annonce = date('Y-m-d',strtotime($demande['Demande']['created']));
								$date_aujourdhui = date('Y-m-d');
								$date_hier = date('Y-m-d', strtotime(date('Y-m-d').' - 1 DAY'));
								if ( $date_annonce  == $date_aujourdhui )
									echo "aujourd'hui à" . date(" H\Hi", strtotime($demande['Demande']['created']));
								else
									if ( $date_annonce  >= $date_hier)
										echo "hier à " . date('H\Hi', strtotime($demande['Demande']['created']));
									else
										echo "le $datefr_j_mois";
							
						?>			</label>
		</div>
		<div id='fiche-actions'>
				<span class="price-btcarac">Statut :</span>
				<span class="dprix dlabel-spe"><?php switch ( $demande['Demande']['valide']){
							case 0 :
								echo "<span class='alert'>Non validée</span>";
								break;
							case 1 :
								echo "<span class='inf'>Validée</span>";
								break;
							case 2 :
								echo "<span class='alert'>Refusée</span>";
								break;
						}
					?> </span>
		</div>
	</div>
	<div id="left-col">
			
			<div id="ficheimg">
				<div id="bigimage" >
				  <img src="/uploads/demandes/<?php echo  $demande['Demande']['image']  ;?>" alt="" /></a>
				</div>
			</div>
			<div id="fiche-client">
				<span id="dlabel" ><b>Demandeur :</b></span>
				<div style="clear:both;"></div>
				<span class="dlabel">Nom :</span>
				<span class="dvaleur"><?php echo  $demande['Demandeur']['nom']  ;?> <?php echo  $demande['Demandeur']['prenom']  ;?></span>
				<div style="clear:both;"></div>
				<span class="dlabel">Type :</span>
				<span class="dvaleur"> <?php echo  ($demande['Demandeur']['type_compte'] == 0 ?'Particulier' : 'Pro') ;?></span>
				<div style="clear:both;"></div>
				<span class="dlabel">Email :</span>
				<span class="dvaleur"><?php echo  $demande['Demandeur']['email']  ;?></span>
				<div style="clear:both;"></div>
				<span class="dlabel">Téléphone :</span>
				<span class="dvaleur"><?php echo  $demande['Demandeur']['telephone']  ;?></span>
				<div style="clear:both;"></div>				
				&nbsp;&nbsp;&nbsp;<a href="/admin/members/afficher/<?php echo  $demande['Demandeur']['id']  ;?>">Détails</a>
			
			</div>
			<div id="fiche-tags">
				<b>Tags :</b>
				<?php echo $form->create('Demande',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'modifier_tags'))); ?>
					<?php echo $form->input("id", array('type'=>'hidden',"value"=> $demande['Demande']['id'],"label"=>false)); ?>
					<table><tr>
								<td><?php echo $form->input("Demande.tag_nouveaute", array('type'=>'checkbox',"checked"=>$demande['Demande']['tag_nouveaute'],"label"=>"&nbsp;&nbsp;Nouv.")); ?>
								</td>
								<td><?php echo $form->input("Demande.tag_pro", array('type'=>'checkbox',"checked"=>$demande['Demande']['tag_pro'],"label"=>"&nbsp;&nbsp;Pro.")); ?>
								</td>
								<td>
									<?php echo $this->Form->submit('/_admin/img/save.png', array('div' => false, 'class' => ''));?>
								</td>
							</tr>
					</table>
				 </form>
			</div>
	</div>
	<div>
			<div id="fichedescription">
				<span class="price-btcarac encadree">Nom :</span>
				<span class="dprix" style="width:250px;"><?php echo  $demande['Demande']['nom']  ; ?></span>
				<div style="clear:both;"></div>
				<span class="price-btcarac encadree">Type :</span>
				<span class="dprix" style="width:250px;"><?php echo  $demande['Dtype']['nom']  ; ?></span>
				<div style="clear:both;"></div>
				<span class="price-btcarac encadree">Catégorie :</span>
				<span class="dprix" style="width:250px;"><?php echo  $demande['Dcategory']['nom']  ; ?> </span>
				<div style="clear:both;"></div>
				<span class="price-btcarac encadree">Ville :</span>
				<span class="dprix" style="width:250px;"><?php echo  $demande['City']['nom']  ; ?> </span>
				<div style="clear:both;"></div>
				<div style="clear:both;"></div><br>
				<div style="clear:both;"></div>				
				<span class="price-btcarac encadree">Budget :</span>
				<span class="dprix"><?php echo  $demande['Demande']['budget']  ; ?> DHS <b></span>				
				
				<div style="clear:both;"></div>	
				<br>
				<span class="price-btcarac encadree">Description :</span>
				<div id="desc-annonce">
					<?php echo  $demande['Demande']['descDemande']  ; ?>
				</div>
				<div style="clear:both;"></div>						
				<span class="price-btcarac encadree">Détails :</span>
				<div style="clear:both;"></div>	
				<center>
					
				</center>
			</div><!--fichedescription-->
			
		</div><!-- left col -->
		
		<div style="clear:both;"></div>
		
</div>