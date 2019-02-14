<h2>Ajouter un client</h2>
<div class="form">
            <?php echo $form->create('Client',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'ajouter'))); ?>

                <fieldset>
                    <dl>
                        <dt><label for="email">Nom :</label></dt>
                        <dd><?php echo $form->input("Client.nom", array("label"=>false)); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Prénom :</label></dt>
                        <dd><?php echo $form->input("Client.prenom", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Nom société :</label></dt>
                        <dd><?php echo $form->input("Client.societe", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Téléphone :</label></dt>
                        <dd><?php echo $form->input("Client.tel", array("label"=>false)); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Email :</label></dt>
                        <dd><?php echo $form->input("Client.email", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Mot de passe :</label></dt>
                        <dd><?php echo $form->input("Client.password", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Adresse :</label></dt>
                        <dd><?php echo $form->input("Client.adresse", array("label"=>false)); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Ville :</label></dt>
                        <dd><?php echo $form->input("Client.ville", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Code postal :</label></dt>
                        <dd><?php echo $form->input("Client.codepostal", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Pays :</label></dt>
                        <dd><?php echo $form->input("Client.pays", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Date de naissance :</label></dt>
                        <dd><?php echo $form->input("Client.date_naissance", array("label"=>false)); ?>
                        </dd>
                    </dl>
                     <dl>
                        <dt><label for="ville">Langue :</label></dt>
                        <dd>
							<?php 
							$options=array('fr'=>'Français','en'=>'Anglais');
							echo $form->select("Client.lang",$options ,array('default'=>'fr')); ?>
                      
                        </dd>
                    </dl>   
					<br/>
                    
                     <dl class="submit">
                     <?php echo $form->end(" Valider "); ?>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
 </div>
 