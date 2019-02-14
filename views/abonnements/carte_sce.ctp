<?php
//debug($session->read('user'));
//debug($session->read('abonnement'));
?>
<div class="inscription">

	<div class="liste_etape">
		<ul>
			<li>Etape 1 : Mes informations |</li>
			<li>Etape 2 : Mon code Abonnement |</li>
			<li class="hover">Etape 3 : Confirmer</li>
		</ul>
	</div>
	
	<?php echo $this->Form->create('Abonnement', array('controller' => 'abonnements', 'action'=>'carte_sce'));?>
		<div class="form">
			<fieldset>
				<legend>Votre code d'abonnement</legend>
				<table>
					<tr>
						<td width="170px" align="right">numéro</td>
						<td><?php 
							echo $session->flash();
							echo $this->Form->input('code', array('label' => false, 'size' => 40));
							?>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td> <br/><?php echo $form->end("Confirmer");?></td>
					</tr>
				</table>
			</fieldset>
		</div>
</div>