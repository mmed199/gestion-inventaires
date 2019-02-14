<h3><?php __d('members',"Mes informations personnelles") ;?> </h3>
<table>
	<tr>
		<td valign="top" align="center" width="300px">
			<?php
				if ($member['Member']['logo']==null){
					echo '<img src="/img/avatar.gif" id="avatar" alt="Logo" />';
					
				}else{
					echo '<img src="/uploads/members/'.$member['Member']['logo'].'" id="avatar" alt="Logo" height="80px" />';
				}
			?>
			<br><br>
			<a href="/member/members/edit_photo" style="color: #EF377D;font-size:12px;"><?php __d('members',"Modifier ma photo") ;?></a>
			
		</td>
		<td width="400px">
			<table>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Type de compte :") ;?>  </span></td><td style="color: #EF377D;">
				<?php  
					if ($member['Member']['type_compte']==0){ echo 'Particulier' ;}
					if ($member['Member']['type_compte']==1){ echo 'Professionnel' ;}
					if ($member['Member']['type_compte']==2){ echo 'Créateur' ;}
				?>
				</td></tr>
				<tr><td>&nbsp;</td><td></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Civilité :") ;?>  </span></td><td><?php echo ($member['Member']['civilite'] == 2? 'Mme':'Mr');?></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Nom :") ;?>  </span></td><td><?php echo $member['Member']['nom'];?></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Prénom :") ;?>  </span></td><td><?php echo $member['Member']['prenom'];?></td></tr>
				<tr><td>&nbsp;</td><td></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Adresse :") ;?>  </span></td><td><?php echo $member['Member']['adresse'] . ($member['Member']['adresse_suite'] != ''?'<br>'.$member['Member']['adresse_suite']:'');?></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"></td><td><?php echo $member['Member']['codepostal'] . ' - ' . $member['Member']['ville'];?></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"></span></td><td><?php echo $member['Country']['nom'];?></td></tr>
				<tr><td>&nbsp;</td><td></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Téléphone :") ;?>  </span></td><td><?php echo $member['Member']['telephone'];?>  </td></tr>
				<tr><td>&nbsp;</td><td></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Pseudo :") ;?>  </span></td><td><?php echo $member['Member']['pseudo'];?>  <?php if ($member['Member']['pseudo']== "") { ?><a style="color: #EF377D;font-size:10px;" href="/member/members/ajouter_mot_pseudo"><?php __d('members',"Ajouter un pseudo") ; ?></a><?php } ?></td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Email :") ;?>  </span></td><td><?php echo $member['Member']['email'];?>  </td></tr>
				<tr><td class="td1"><span class="lbl_bleu"><?php __d('members',"Mot de passe :") ;?>  </span></td><td> *********** <a style="color: #EF377D;font-size:10px;" href="/member/members/modifier_mot_de_passe"><?php __d('members',"Modifier le mot de passe"); ?></a> </td></tr>
				<tr><td>&nbsp;</td><td></td></tr>
				<!-- <tr><td>&nbsp;</td><td><div id="modifier"><a href="/member/members/editProfil"><?php __d('members',"Modifier mes informations") ;?> </a></div></td></tr> -->
			</table>
			
		</td>
		<td valign="top" width="80px">
			<div id="contenu-actions">
				<a href="/member/members/editProfil" title ="<?php __d('members',"Modifier mes informations") ;?>">
					<img alt="<?php __d('members',"Modifier mes informations") ;?>" src="/_admin/img/edit.png">
				</a>
			</div>
		</td>
	</tr>
</table>
<div class="clear"></div>