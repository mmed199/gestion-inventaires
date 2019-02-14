<h2>Ajouter une nouvelle marque</h2>
<div class="form">
            <?php echo $form->create('Marque',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'ajouter'))); ?>

                <fieldset>
                    <dl>
                        <dt><label for="nomMarque">Marque :</label></dt>
                        <dd><?php echo $form->input("Marque.nom", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"14")); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="url_m">URL :</label></dt>
                        <dd><?php echo $form->input("Marque.slug", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"14")); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for "imageMarque" class="validate[required] newfleurinput ">Image : </label></dt>
                        <dd><?php echo $form->file("Marque.image"); ?></dd>
                    </dl>
					<dl>
						<dt><label for="email">Description :</label></dt>
						<dd><?php echo $cksource->ckeditor("Marque.description", array("class"=>" newfleurinput ","label"=>false)); ?>
					</dd>
				</dl>
                    <dl class="submit">
                     <?php echo $form->end("Valider"); ?>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
 </div>