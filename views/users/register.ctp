
<div class="inscription">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" valign="top" width="60%">
						<div class="titre_violet">Inscription particulier</div>

						
						<?php echo $this->Form->create('User', array('action'=>'register'));?>	
							<div class="form">
								<fieldset>
									<legend>Vos identifiants</legend>
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="100px" align="right">Login*</td>
											<td><?php echo $this->Form->input('username', array('label' => false, 'size' => 40, 'title' => 'Votre login ne peut comporter que des chiffres et des lettres' ));?></td>
										</tr>
										<tr>	
											<td align="right">Email*</td>
											<td><?php echo $this->Form->input('email', array('label' => false, 'size' => 40, 'title' => 'Indiquer une adresse email valide'));?></td>
										</tr>
										<tr>	
											<td align="right">Confirmez Email*</td>
											<td><?php echo $this->Form->input('confirm_email', array('label' => false, 'size' => 40));?></td>
										</tr>
										<tr>	
											<td align="right">Mot de passe*</td>
											<td><?php echo $this->Form->input('pass', array('type' => 'password', 'label' => false, 'size' => 40, 'title' => 'Votre mot de passe doit contenir 4 à 25 caractères'));?></td>
										</tr>
									</table>
								</fieldset>
								
								<fieldset>
									<legend>Vos informations personnelles</legend>
										<?php
										$message_erreur = $session->flash();
										if(!empty($message_erreur)){
											echo '<div class="message_erreur">'.$message_erreur.'</div>';
											echo $session->flash('auth');
										}
										?>
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>	
											<td width="100px" align="right">Nom*</td>
											<td><?php echo $this->Form->input('nom', array('label' => false, 'size' => 40));?></td>
										</tr>
										<tr>	
											<td align="right">Prénom*</td>
											<td><?php echo $this->Form->input('prenom', array('label' => false, 'size' => 40, 'title' => 'Votre mot de passe doit contenir 4 à 25 caractères'));?></td>
										</tr>
										<tr>	
											<td align="right">Adresse*</td>
											<td><?php echo $this->Form->input('adresse', array('label' => false, 'size' => 40));?></td>
										</tr>
										<tr>	
											<td align="right">Département*</td>
											<td><?php 
											
											echo $this->Form->select('dpt', $dpt, null, array('escape' => false));?>
											
														
											</td>
										</tr>
										<tr>	
											<td align="right">Ville*</td>
											
											<td>
											<?php echo $this->Form->input('ville', array('label' => false, 'size' => 40));?>
											<?php 
												//$liste_villes = array();
												/*echo $this->Form->select('ville', $liste_villes, null, array('escape' => false));
												echo $form->error('User.ville'); 
												
												echo $ajax->observeField('UserDpt',
													array(
														'url' => array('controller' => 'users', 'action' => 'edit_ville'),
														'update' => 'UserVille',
														'frequency' => 1,
														
													)
												);
												*/?>  
											</td>
										</tr>
										<tr>	
											<td align="right">Code postal*</td>
											<td><?php echo $this->Form->input('code_postal', array('label' => false, 'size' => 40));?>
											
														
											</td>
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
										<tr>
											<td>&nbsp;</td>
											<td><br/><p>* champ obligatoire</p></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td><br/><?php echo $this->Form->checkbox('cgv');?> J'ai lu et accepte les <a href="/pages/cgv" target="_blank">CGV</a></td>
										</tr>
									</table>
								</fieldset>
							</div>
							
							<div class="form"><?php echo $form->end('Envoyer');?></div>
			</td>
			<!--<td align="right" valign="top">
				<div class="inscription_bulle">
						<div class="titre_violet">Pourquoi s'inscrire</div>
							
							<p>
								<strong>Ensemble, moins cher !</strong><br/>
								Profiter des nombreuses offres de vos commerçants
							</p>
							
							<p>
								<strong>Trouver votre prestataire près de chez vous</strong><br/>
								Vous avez besoin de devis, d'offre de prix pour une prestation <br/>de services dans tout domaine
							</p>
							
							<p>
								<strong>Trouver un emploi</strong><br/>
								Les TPE / PME recrutent pour tout type de contrat
							</p>
							
							<p>
								<strong>Gagner de superbes cadeaux</strong><br/>
								Parrainer vos commerçants et gagner un séjour d'une semaine pour 2 en Turquie
							</p>
				</div>
				
				<div class="inscription_bulle2">
					<div class="titre">
						Vous êtes un professionnel
					</div>
					
					<p>Vous souhaitez développer votre activité grâce à SCE et bénéficier de nos nombreux services dédiés aux professionnels</p>
					<?php echo $html->link('Abonnez-vous', array('controller' => 'abonnements', 'action' => 'index'));?>
				</div>
				
				
			</td>-->
		</tr>
	</table>

</div>


