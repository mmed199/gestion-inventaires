<h2>Modification de la  section</h2>
<div class="form">
            <?php echo $form->create('Asection',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data')); ?>

                <fieldset>
					 <dl> 
						<dt><label for="nom">Titre de la section : </label></dt>
						<dd>
							<?php e($form->input('Asection.title',array('label' => false,"style"=>"width:450px;")));?>
						</dd> 
					</dl> 
					<dl> 
						<dt><label for="nom">Slug :</label></dt>
						<dd>
							<?php e($form->input('Asection.slug',array('label' => false,"style"=>"width:450px;")));?>
						</dd> 
					</dl> 
                     <dl class="submit">
                     <?php echo $form->end("Modifier"); ?>
                     </dl>
						
                </fieldset>  
                
         </form>
 </div>