<?php 

	$this->set ('page_title', 'Ajouter un article | kidsdressing');
	$this->set ('meta_robots',"noindex,follow");
	echo $html->script(array(
				'ajouter'
			))
	;
?>

<script type="text/javascript">
    window.history.forward();	
</script>
<h3>Vendre un article :</h3><div class="error"></div>
<br />
<?php echo $this->Form->create('Produit',
					array(
						'enctype'=>'multipart/form-data',
						'id'=>"form_1",
						'url'=>array(
								'action'=>'member_ajouter'
									)
						)
			);?>
	<div class="fondContent">
		<div class="titreEtape"><span class="pink">Etape 1 :</span> Saisir les champs correspondant à l'article dans l'ordre.</div>
		<div class="zoneForm">
			<div>
				<table><tr><td><label>Référence : </label></td><td><?php echo $this->Form->input('refProduitClient ', array('type'=>'text','class'=>'input-200','label'=>false,'div'=>false)); ?>	</td><td>Référence de l'article dans votre boutique</td></tr></table>					
			</div>
			<div>
				<label>Marque : <span class="red">*</span></label>
				<?php echo $this->Form->input('marque_id', array('options' =>$marques, 'empty' => 'Choisir...','class'=>'validate[required] input-200','label'=>false,'div'=>false)); ?>						
			</div>
			<div>
				<label>Catégorie : <span class="red">*</span></label>
				<?php echo $this->Form->input('category_id', array('options' =>$categories, 'onchange'=>"updateType( this.value );",'empty' => 'Choisir...','class'=>'validate[required] input-200','label'=>false,'div'=>false)); ?>						
			</div>
			<div>
				<label>Type : <span class="red">*</span></label>
				<?php echo $this->Form->input('type_id', array('options' =>$types,'empty' => 'Choisir...','class'=>'validate[required] input-200','label'=>false,'div'=>false)); ?>						
			</div>			
			<div>
				<label>Sexe : <span class="red">*</span></label>
				<?php echo $this->Form->input('sexe_id', array('options' =>$sexes, 'empty' => 'Choisir...','class'=>'validate[required] input-150','label'=>false,'div'=>false)); ?>
							
			</div>
			<div>
				<label>Etat : <span class="red">*</span></label>
				<?php echo $this->Form->input('etat_id', array('options' =>$etats, 'empty' => 'Choisir...','class'=>'validate[required] input-150','label'=>false,'div'=>false)); ?>
							
			</div>
			<div>
				<label>Matière : <span class="red">*</span></label>
				<?php echo $this->Form->input('matiere_id', array('options' =>$matieres, 'empty' => 'Choisir...','class'=>'validate[required] input-150','label'=>false,'div'=>false)); ?>						
			</div>
			<div>
				<label>Saison : <span class="red">*</span></label>
				<?php echo $this->Form->input('saison_id', array('options' =>$saisons, 'empty' => 'Choisir...','class'=>'validate[required] input-150','label'=>false,'div'=>false)); ?>						
			</div>
			
			
			<div>
				<table><tr>
							<td><label>Prix : <span class="red">*</span></label></td>
							<td>
								<table>
										<tr>
											<td>
												<?php echo $this->Form->input('prix', array('label'=>false,'size'=>8,"onchange"=>"this.value =reformat_prix(this.value);",'div'=>false,'class'=>'validate[required] input-100')); ?> €						
											</td>
											<td width="40px" align="center">
												<?php echo $form->checkbox('frais_port_inclus'); ?>
											</td>
											<td>
												Frais de port inclus dans le prix
											</td>
										</tr>
								</table>
							</td>
						</tr>
				</table>
			</div>
			<div>
				<label>Prix soldé : </label>
				<?php echo $this->Form->input('prixSolde', array('label'=>false,'size'=>8,"onchange"=>"this.value =reformat_prix(this.value);",'div'=>false,'class'=>'input-100')); ?> €						
			</div>
			
			
			<div>
				<table>
					<tr>
						<td style="vertical-align:top"><label>
						Présentation de l'article
						<span class="red">*</span>
						:
						</label>
						<br>
						<span class="red" style="font-size:10px;">90 caractères minimum à saisir</span>
						</td>
						<td>
						<?php e($this->Form->input('commProd',array('class'=>'validate[required]',
											'label' =>false,
											'rows'=>"8",
											'cols'=>"70"
											)));?>
						</td>
					</tr>
				</table>
			</div>
			<div class="zoneForm">
				<table>
					<tr>
						<td>
							<div>
								<label>Photo de face : <span class="red">*</span></label>
								<?php e($this->Form->input('image1ProdPre', array('type' => 'file','label' => false)));?>			
							</div>
							<div>
								<label>Photo de dos : </label>
								<?php e($this->Form->input('image2ProdPre', array('type' => 'file','label' => false)));?>				
							</div>
							<div>
								<label>Photo d'un détail : </label>
								<?php e($this->Form->input('image3ProdPre', array('type' => 'file','label' => false)));?>			
							</div>
							<div>
								<label>Photo de l'article porté : </label>
								<?php e($this->Form->input('image4ProdPre', array('type' => 'file','label' => false)));?>				
							</div>
						</td>
						<td>
							<p><span class="pink">Extensions autorisées : </span>.png .gif .jpg .jpeg</p><br>
							<p>Mettez toutes les chances de votre côté, <a class="blue" href="/pdf/guide photos.pdf" target="_blank">quelques conseils pour mieux mettre en valeur vos articles.</a></p>
			
							
						</td>
					</tr>
				</table>
				<?php // echo $this->element('sql_dump'); ?>
			
		</div>
    <div id="sell-nav">     
		<div id="suivant">
			<?php echo $this->Form->submit(" Suivant ") ; ?> 
		</div>
    </div>
	<div class="clear"></div>
	<span style="font-size:11px;">Les champs marqués d'une <span class="red">*</span> sont obligatoires</span>
	</div>	<div class="clear"></div>

<?php echo $this->Form->end() ; ?>

	