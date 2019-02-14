

<div class="titre_violet">
	Modifier mon profil
</div>
<?php echo $session->flash('auth');?>
<?php echo $session->flash();?>

<?php echo $this->Form->create('User', array("enctype" => "multipart/form-data"));?>
<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
<?php echo $this->Form->input('username', array('type' => 'hidden'));?>
<?php echo $this->Form->input('Secteur.0.SecteursUser.id', array('type' => 'hidden'));?>
<?php echo $this->Form->input('Secteur.1.SecteursUser.id', array('type' => 'hidden'));?>
<?php echo $this->Form->input('Secteur.2.SecteursUser.id', array('type' => 'hidden'));?>


<div class="form">
	<fieldset>
	<legend>Général</legend>
		<table width="80%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="32%" valign="top">
					<?php echo $html->image('/img/user/image/thumb.medium.'.$form->data['User']['image'], array('alt' => 'image'));?> 	
				</td>
				
				<td valign="top" class="profil_edition">
					<ul>
						<li>Login : <?php echo $this->Session->read('Auth.User.username');?>
						<li><?php echo $html->link('Modifier mon adresse email ('.$this->data['User']['email'].')', array('action' => 'changeemail'));?></li>
						<li><?php echo $html->link('Modifier mon mot de passe', array('action' => 'changepass'));?></li>
						<li><?php echo $form->input('image', array('type' => 'file', 'label' => 'Image '));?>
							<?php 
								if($form->data['User']['image'] != 'nophoto.gif'){
									echo '<br/>';
									$form->data['User']['image']['remove'] = 0;
									echo $this->Form->checkbox('User.image.remove'); 
									echo '&nbsp;supprimer l\'image actuelle';
								}
							?>
						</li>
					</ul>
					
				</td>
			</tr>


		</table>
	</fieldset>
	
	<fieldset>
	<legend>Mes informations personnelles</legend>
		<table width="100%">
			<tr>
				<td valign="top" align="center" width="50%">
					<table>
						<tr>
							<td align="right">Nom</td>
							<td><?php echo $this->Form->input('nom', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Prénom</td>
							<td><?php echo $this->Form->input('prenom', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Adresse</td>
							<td><?php echo $this->Form->input('adresse', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Code postal</td>
							<td><?php echo $this->Form->input('code_postal', array('label' => false, 'size' => 32));?>
							</td>
						</tr>
						<tr>
							<td align="right">Ville</td>
							<td><?php echo $this->Form->input('ville', array('label' => false, 'size' => 32));?>
							</td>
						</tr>
					</table>
				</td>
				<td valign="top" align="center" width="50%">
					<table>
						<tr>
							<td align="right">Téléphone</td>
							<td><?php echo $this->Form->input('telephone', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Mobile</td>
							<td><?php echo $this->Form->input('mobile', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Fax</td>
							<td><?php echo $this->Form->input('fax', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Site internet</td>
							<td><?php echo $this->Form->input('siteweb', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right"><p>Compte paypal</p></td>
							<td><?php echo $this->Form->input('paypal', array('label' => false, 'size' => 32));?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</fieldset>
	
	<?php if($session->read('Auth.User.group_id') == 3):?>
	<fieldset>
	<legend>Mon entreprise</legend>
		<table width="100%">
			<tr>
				<td valign="top" align="center" width="50%">
					<table>
						<tr>
							<td align="right">Métier</td>
							<td><?php echo $this->Form->input('metier', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Société</td>
							<td><?php echo $this->Form->input('societe', array('label' => false, 'size' => 32));?></td>
						</tr>
						<tr>
							<td align="right">Siret</td>
							<td><?php echo $this->Form->input('siret', array('label' => false, 'size' => 32));?></td>
						</tr>
					</table>
				</td>
				<td valign="top" align="center" width="50%">
					<table>
						<tr>	
							<td align="right">Activité (1)</td>
							
							<td><?php echo $this->Form->select('Secteur.0.SecteursUser.secteur_id', $secteurs, null, array('escape' => false));?></td>
						</tr>
						<tr>	
							<td align="right">Activité (2)</td>
							
							<td><?php echo $this->Form->select('Secteur.1.SecteursUser.secteur_id', $secteurs, null, array('escape' => false));?></td>
						</tr>
						<tr>	
							<td align="right">Activité (3)</td>
							
							<td><?php echo $this->Form->select('Secteur.2.SecteursUser.secteur_id', $secteurs, null, array('escape' => false));?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</fieldset>
	
	
	
	<fieldset>
	<legend>Présentation libre</legend>
		<div class="textarea_grand">
			<table border="0">
				<tr>
					<td align="center">
						<p>Présenter votre société vous permet de mieux vous référencer sur notre site et d'informer le visiteur de votre activité</p>
					</td>
				</tr>
				<tr>	
					<!--<td width="50px" align="right" valign="top">Message</td>-->
					<td align="left" colspan="2"><?php echo $this->Form->textarea('description', array('rows' => '9', 'cols' => '105'));?></td>
				</tr>
			</table>
		</div>
	</fieldset>
	<?php endif;?>

	<center><?php echo $this->Form->end('Mettre à jour');?></center>
	
	
</div>
