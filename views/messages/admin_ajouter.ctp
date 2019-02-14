<h2>Ajouter une nouvelle couleur</h2>
<div class="form">
            <?php echo $form->create('Couleur',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'ajouter'))); ?>

                <fieldset>
                    <dl>
                        <dt><label for="email">Couleur :</label></dt>
                        <dd><?php echo $form->input("Couleur.nomCouleur", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"14")); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Slug :</label></dt>
                        <dd><?php echo $form->input("Couleur.url_couleur", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"14")); ?>
                        </dd>
                    </dl>
                    <dl class="submit">
                     <?php echo $form->end("Valider"); ?>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
 </div>