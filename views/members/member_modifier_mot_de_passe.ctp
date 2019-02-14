<?php 
	$site_name =Configure::read("site_name");
	$this->set('page_title',__d('members',"Changement du mot de passe",true)." | " . $site_name) ; 
?>
<div id="contenu-entete">
	<div id="contenu-titre">
		<h2><?php __d('members',"Modifier le mot de passe") ;?></h2>
	</div>
	<div id='contenu-actions'></div>
</div>

<?php echo $form->create('Member',
					array(
						'enctype'=>'multipart/form-data',
						'id'=>"infosperso_password",
						'url'=>array(
								'action'=>'modifier_mot_de_passe'
									)
						)
			);?>
                <br>
				<table>
                    <tr>
                        <td class="td1"><label for="email"><?php __d('members',"Mot de passe actuel :") ;?></label></td>
                        <td>
						<?php echo $form->password('old_password',array('label'=>false,'class'=>'input-200')) ; ?>
						</td>
                    </tr>
                    <tr>
                        <td class="td1"><label for="email"><?php __d('members',"Nouveau mot de passe :") ;?></label></td>
                        <td>
						<?php echo $form->input('password',array('label'=>false,'class'=>'input-200')) ; ?>
						</td>
                    </tr>
                     <tr><td>&nbsp;</td><td></td></tr>
					<tr><td>&nbsp;</td><td>
					<p id="creercompte_btn"><a href="#" onclick="$('#infosperso_password').submit();" > <?php __d('members',"Modifier") ;?> </a></p>
					</td></tr>
			
				</table>
		</form>
	