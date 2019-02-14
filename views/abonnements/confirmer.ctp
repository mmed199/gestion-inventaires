<div class="inscription">
	
	<div class="liste_etape">
		<ul>
			<li>Etape 1 : Mes informations |</li>
			<li>Etape 2 : Mon code Abonnement |</li>
			<li class="hover">Etape 3 : Confirmer</li>
		</ul>
	</div>
	
	<br/><br/>
	
	<center>
	<table width="90%" align="middle" cellpadding="0" cellspacing="4">
		<tr>
			<td width="50%" valign="top">
				<div class="titre_violet">Vos informations</div>
				
				<div class="boite_recap">
					<?php echo $session->read('User.prenom').' '.$session->read('User.nom');?><br/>
					<?php echo $session->read('User.adresse');?><br/>
					<?php echo $session->read('User.code_postal').' '.$session->read('User.ville');?><br/>
					<?php if($session->check('User.telephone')) echo 'Téléphone : '.$session->read('User.telephone').'<br/>';?>
					<?php if($session->check('User.portable')) echo 'Mobile : '.$session->read('User.portable').'<br/>';?>
				</div>
				<p>Vous pourrez compléter, modifier vos informations dans votre espace personnel</p>
			</td>
			
			<td valign="top">
				<div class="titre_violet">Votre abonnement </div>
				<div class="boite_recap">
					Durée d'abonnement : 1 an<br/>
					Règlement : carte d'abonnement SCE
				</div>
			</td>
		</tr>
	</table>
	
	<?php echo $this->Form->create('Abonnement', array('controller' => 'abonnements', 'action'=>'confirmer'));?>
	<?php echo $this->Form->input('confirm', array('type' => 'hidden', 'value' => true));?>
	<div class="form">
		<?php echo $form->end("Confirmer votre abonnement");?></td>
	</div>
		
	</center>
	

		
</div>