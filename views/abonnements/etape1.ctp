<div class="inscription">
	<div class="titre_violet">Abonnement</div>
	<div class="liste_etape">
		<ul>
			<li class="hover">Etape 1 : Mes identifiants |</li>
			<li>Etape 2 : Ma société |</li>
			<li>Etape 3 : Paiement</li>
		</ul>
	</div>

	<?php
		echo $session->flash();
		//echo $session->flash('auth');
	?>
	
	<?php echo $this->Form->create('Abonnement', array('action'=>'etape1'));?>	
		<div class="form">
			<fieldset>
				<legend>Vos identifiants</legend>
				<table>
					<tr>
						<td width="170px" align="right">Login *</td>
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
			</fieldset>			<p>* champs obligatoire</p>
		<?php echo $form->end("Etape suivante");?>
		</div>


</div>
