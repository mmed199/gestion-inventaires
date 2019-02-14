<div class="inscription">
	<div class="titre_violet">Abonnement</div>
	<div class="liste_etape">
		<ul>
			<li>Etape 1 : Mes identifiants |</li>
			<li class="hover">Etape 2 : Ma société |</li>
			<li>Etape 3 : Paiement</li>
		</ul>
	</div>
	
	<?php echo $this->Form->create('Abonnement', array('action'=>'etape2'));?>	
		<div class="form">
			<fieldset>
				<legend>Vos informations personnelles</legend>
				<table>
					<tr>
						<td width="170px" align="right">Nom *</td>
						<td><?php echo $this->Form->input('nom', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Prénom *</td>
						<td><?php echo $this->Form->input('prenom', array('label' => false, 'size' => 40));?></td>
					</tr>
				</table>
			</fieldset>
			
			<fieldset>
				<legend>Votre société</legend>
				<table>
					<tr>	
						<td width="170px" align="right">Société *</td>
						<td><?php echo $this->Form->input('societe', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Adresse *</td>
						<td><?php echo $this->Form->input('adresse', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Département*</td>
						<td><?php 
						
						echo $this->Form->select('dpt', $dpt, null, array('escape' => false));?>
						
									
						</td>
					</tr>
					<tr>	
						<td align="right">Ville *</td>
						<td><?php echo $this->Form->input('ville', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Code postal *</td>
						<td><?php echo $this->Form->input('code_postal', array('label' => false, 'size' => 40));?></td>
					</tr>
					
					<tr>	
						<td align="right">Siret </td>
						<td><?php echo $this->Form->input('siret', array('label' => false, 'size' => 40));?></td>
					</tr>
				</table>
			</fieldset>			<p>* champs obligatoire</p>
		<?php echo $form->end("Etape suivante");?>
		</div>
</div>
	