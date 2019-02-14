
<div class="profil">
					<div class="tableau">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="75px" valign="top" rowspan="2">
									<?php if(!empty($user['User']['image'])){
									echo $html->image('/img/user/image/thumb.small.'.$user['User']['image'], array(
										'alt' => $user['User']['username']
										));
										
									
									}
									else{
										echo '<img src="/img/user/image/thumb.small.nophoto.gif" alt="logo"/>';
									}
									?>
								</td>
								<td valign="top">
									<div class="titre"><?php echo $user['User']['username'];?></div>
									
									<?php if(!empty($user['User']['metier'])) echo '<span class="sous-titre">'.$user['User']['metier'].',</span> ';?>
									<?php if(!empty($user['User']['societe'])) echo '<span class="sous-titre">'.$user['User']['societe'].'</span> ';?>
									<div><?php //echo $user['User']['code_postal'].' '.$user['FranceVille']['nom'].', '.$user['FranceDepartement']['nom_departement'].', '.$user['FranceVille']['FranceDepartement']['FranceRegion']['nom_region'];?></div>
									<div>Membre depuis le <?php 
										$created = utf8_encode(strftime("%d/%m/%Y", strtotime($user['User']['created'])));
										echo $created;
										?>
									</div>
								</td>
								<td rowspan="2" valign="bottom" align="right" width="250px">
								
										<table class="liens_divers" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td><?php  if(!empty($user['Site']['id'])) echo $html->image("/images/picto/recap.jpg", array(
																			"alt" => "Voir son site vitrine",
																			"title" => "Voir son site vitrine",
																			//'url' => 'http://site.service-conseil-entreprise.fr/'.$user['Site']['nom_site']
																			'url' => array('controller' => 'sites', 'action' => 'voir', $user['Site']['nom_site'])
													)); ?>
												</td>
												<td class="liens"><!--<a href="http://site.service-conseil-entreprise.fr/<?php echo $user['Site']['nom_site'];?>">Voir son site</a>-->
																	<?php if(!empty($user['Site']['id'])) echo $html->link('Voir son site', array('controller' => 'sites', 'action' => 'voir', $user['Site']['nom_site']));?> </td>
											</tr>
											<tr>
												<td><?php  echo $html->image("/images/picto/message.jpg", array(
																			"alt" => "Envoyer un message",
																			"title" => "Envoyer un message",
																			'url' => array('controller' => 'messages', 'action' => 'ecrire', $user['User']['id'])
													)); ?>
												</td>
												<td class="liens"><?php echo $html->link('Envoyer un message', array('controller' => 'messages', 'action' => 'ecrire', $user['User']['id']));?></td>
											</tr>
										</table>
									<?php //if(isset($user['Site']['id'])) echo '<a href="http://site.service-conseil-entreprise.fr/'.$user['Site']['nom_site'].'" target="_blank">Voir son site vitrine</a>';?>
								</td>
							</tr>
							<tr>
								<td valign="bottom"><?php 
									$tb_secteur = array();
									$secteurs = '';
									foreach($user['Secteur'] as $secteur){
									
										$tb_secteur[] = $this->Html->link($secteur['nom'], array('controller' => 'devis_pros', 'action' => 'liste', $secteur['id']), array('escape' => false));
									}
									
									if(!empty($tb_secteur)){
										$secteurs = implode(", ", $tb_secteur);
										echo '<b>Activité :</b> '.$secteurs;
									}
									?></td>
							</tr>
						</table>
					</div>
					
					<div class="titre2">
						Description
					</div>
					<div class="tableau">
						<table width="100%">
							<tr>
								<td>
									<?php echo nl2br($user['User']['description']);?>
								</td>
							</tr>
						</table>
					</div>
					
					<div class="titre2">
						Boutique de <?php echo $user['User']['username'];?>
					</div>
										
					<div class="tableau">
						<table width="100%">
							<tr>
								<td>
									<div id="contenu_2">
										
									<?php
										if(empty($user['Produit']))
											echo '<p>'.$user['User']['username'].' n\'a pas encore de produits en vente</p>';
										else{
											echo '<div class="petit_tableau"><table width="100%" cellpadding="0" cellspacing="0" border="0">';
											foreach($user['Produit'] as $produit):
												echo '<tr>';
												echo '<td width="62px">'.$html->image("/img/produit/image/thumb.small.".$produit['image'], array(
												'alt' => $produit['titre'],
												'width' => '60px',
												'url' => array('controller' => 'produits', 'action' => 'voir', $produit['id'])
												)).'</td>';
												echo '<td width="50%" valign="top">';
												
													echo '<div class="petit_titre">'.$html->link($produit['titre'], array('controller' => 'produits', 'action' => 'voir', $produit['id']), array('escape' => false)).'</div>';
													if(strlen($produit['description']) < 100) 
														echo $produit['description'];
													else echo substr($produit['description'], 0, 100).' [...]';
										
												echo '</td>';
												echo '<td align="right">'.$produit['prix_vente'].' €</td>';
												echo '<td align="right">'.$html->link('Voir le détail', array('controller' => 'produits', 'action' => 'voir', $produit['id'])).'</td>';
												echo '</tr>';
											endforeach;
											echo '</table></div>';
										}
											
									?>
									</div>

								</td>
							</tr>
						</table>
						<br/>
					</div>
										
					
						
				</div>

</div>

