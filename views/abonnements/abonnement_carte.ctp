<div class="inscription">
	
	<div class="titre_violet">Abonnement SCE : Mes informations</div>

	<?php
		echo $session->flash();
		//echo $session->flash('auth');
	?>
	
	<?php echo $this->Form->create('Abonnement', array('url' => array('controller' => 'abonnements', 'action'=>'abonnement_carte')));?>	
		<div class="form">
			<fieldset>
				<legend>Vos identifiants</legend>
				<table>
					<tr>
						<td width="170px" align="right">Pseudo *</td>
						<td><?php echo $this->Form->input('username', array('label' => false, 'size' => 40, 'title' => 'Votre login ne peut comporter que des chiffres et des lettres' ));?></td>
					</tr>
					<tr>	
						<td align="right">Email *</td>
						<td><?php echo $this->Form->input('email', array('label' => false, 'size' => 40, 'title' => 'Indiquer une adresse email valide'));?></td>
					</tr>
					<tr>	
						<td align="right">Confirmez Email *</td>
						<td><?php echo $this->Form->input('confirm_email', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Mot de passe *</td>
						<td><?php echo $this->Form->input('pass', array('type' => 'password', 'label' => false, 'size' => 40, 'title' => 'Votre mot de passe doit contenir 4 à 25 caractères'));?></td>
					</tr>
				</table>
			</fieldset>
			
			<fieldset>
				<legend>Vos informations personnelles</legend>
				<table>
					<tr>	
						<td width="170px" align="right">Nom *</td>
						<td><?php echo $this->Form->input('nom', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Prénom *</td>
						<td><?php echo $this->Form->input('prenom', array('label' => false, 'size' => 40, 'title' => 'Votre mot de passe doit contenir 4 à 25 caractères'));?></td>
					</tr>
					<tr>	
						<td align="right">Adresse *</td>
						<td><?php echo $this->Form->input('adresse', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Code postal *</td>
						<td><?php echo $this->Form->input('code_postal', array('label' => false, 'size' => 40, 'title' => 'Votre mot de passe doit contenir 4 à 25 caractères'));?></td>
					</tr>
					<tr>	
						<td align="right">Ville *</td>
						<td><?php echo $this->Form->input('ville', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Tél. fixe</td>
						<td><?php echo $this->Form->input('telephone', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Tél. mobile</td>
						<td><?php echo $this->Form->input('portable', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>	
						<td align="right">Site internet</td>
						<td><?php echo $this->Form->input('siteweb', array('label' => false, 'size' => 40, 'title' => 'Votre mot de passe doit contenir 4 à 25 caractères'));?></td>
					</tr>
				</table>
			</fieldset>
			
			<fieldset>
				<legend>Mon compte paypal</legend>
				<table>
					<tr>	
						<td align="right" width="170px">mon identifiant paypal</td>
						<td><?php echo $this->Form->input('paypal', array('label' => false, 'size' => 40));?></td>
					</tr>
					<tr>
						<td colspan="2">
							<p>Avoir un compte paypal vous permet recevoir en ligne les paiments réalisé par vos ventes</p>
						</td>
					</tr>
				</table>
			</fieldset>
			
			<fieldset>
				<legend>Mon entreprise</legend>
				<table>
					<tr>
						<td align="right">Société</td>
						<td><?php echo $this->Form->input('societe', array('label' => false, 'size' => 40));?></td>
					<tr>	
						<td align="right" width="170px">Activité (1)</td>				
						<td><?php echo $this->Form->select('Secteur.0.SecteursUser.secteur_id', $secteurs, null, array('escape' => false));?></td>
					</tr>
					<tr>	
						<td align="right">Activité (2)</td>			
						<td><?php echo $this->Form->select('Secteur.1.SecteursUser.secteur_id', $secteurs, null, array('escape' => false));?></td>
					</tr>
				</table>
			</fieldset>
			<p>* champs obligatoire</p>
		<?php echo $this->Form->checkbox('cgv');?> J'ai lu et accepte les <a href="/Pages/cgv/">CGV</a>
		<?php echo $form->end("Valider mon abonnement à SCE");?>
		</div>


</div>
