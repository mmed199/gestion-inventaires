<div class="titre_violet">Connexion rapide</div>
<div class="login">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" valign="top" width="60%">

						
						
						<div class="message_erreur">
							<?php
								echo $session->flash();
								echo $session->flash('auth');
							?>
						</div>
						
						<?php echo $this->Form->create('User', array('action'=>'login'));?>	
								<table>
									<tr>
										<td width="85px" align="right">Login</td>
										<td class="form"><?php echo $this->Form->input('email', array('label' => false, 'size' => 45));?></td>
									</tr>
									<tr>	
								
										<td align="right">Mot de passe</td>
										<td class="form"><?php echo $this->Form->input('password', array('label' => false, 'size' => 45));?></td>
									</tr>
									<tr>
										<td colspan="2" class="form" align="right"><?php echo $this->Form->end('Connexion');?></td>
									</tr>
								</table>

			</td>
		</tr>
	</table>

</div>
