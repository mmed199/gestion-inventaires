<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Modifier les informations d'un abonné</h2>
	</div>
	<div id='contenu-actions'>		
	</div>
</div>
<div class="form">
            <?php echo $form->create('Abonne',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'modifier'))); ?>

                <fieldset>
                    <dl>
                        <dt><label for="email">Nom :</label></dt>
                        <dd><?php echo $form->input("Abonne.nom", array("label"=>false)); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Prénom :</label></dt>
                        <dd><?php echo $form->input("Abonne.prenom", array("label"=>false)); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Email :</label></dt>
                        <dd><?php echo $form->input("Abonne.email", array("label"=>false)); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Ville :</label></dt>
                        <dd><?php echo $form->input("Abonne.ville", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="ville">Sexe:</label></dt>
                        <dd>
							<?php 
							$options=array('0'=>'Inconnu','1'=>'Homme','2'=>'Femme');
							echo $form->select("Abonne.sexe",$options ); ?>
                      
                        </dd>
                    </dl> 
                    <dl>
                        <dt><label for="ville">Langue :</label></dt>
                        <dd>
							<?php 
							$options=array('fr'=>'Français','en'=>'Anglais');
							echo $form->select("Abonne.lang",$options ); ?>
                      
                        </dd>
                    </dl>   
                    
                     <dl class="submit">
                     <?php echo $form->end(" Valider "); ?>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
 </div>
 