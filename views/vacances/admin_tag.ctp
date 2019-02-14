<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Modifier tag du produit <?php echo $this->data['Produit']['id']; ?></h2>
	</div>
	<div id='contenu-actions'>
		
	</div>
</div>
<div class="form">
            <?php echo $form->create('Produit',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'tag'))); ?>
				<fieldset>
                    <dl><?php echo $form->hidden('id');?>
                        <dt><label for="tag"></label></dt>
						<dd>
							<?php echo $form->input('Produit.tag_home',array('type' => 'checkbox', 'label' =>"&nbsp;&nbsp;Afficher sur la page d'accueil"));?>
						</dd>
                    </dl>
					<dl>
                        <dt><label for="tag"></label></dt>
						<dd>
							<?php echo $form->input('Produit.tag_nouveaute',array('type' => 'checkbox', 'label' =>'&nbsp;&nbsp;Nouveauté'));?> 
						</dd>
                    </dl>
					<dl>
                        <dt><label for="tag"></label></dt>
						<dd>
							<?php echo $form->input('Produit.tag_selection',array('type' => 'checkbox', 'label' =>'&nbsp;&nbsp;Sélection Services4all'));?> 
						</dd>
                    </dl>
					<dl>
                        <dt><label for="tag"></label></dt>
						<dd>
							<?php echo $form->input('Produit.tag_coups_coeur',array('type' => 'checkbox', 'label' =>'&nbsp;&nbsp;Coup de coeur'));?> 
						</dd>
                    </dl>
					<dl>
                        <dt><label for="tag"></label></dt>
						<dd>
							<?php echo $form->input('Produit.tag_bonplan',array('type' => 'checkbox', 'label' =>'&nbsp;&nbsp;Bon plan'));?> 
						</dd>
                    </dl>					 					
                     <dl class="submit">
                     <?php echo $form->end(" Valider "); ?>                    
					</dl>                   
                </fieldset>                
         </form>
 <br><br>

 </div>