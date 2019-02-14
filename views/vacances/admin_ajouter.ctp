<h2>Ajouter une annonce</h2>
<div class="form">
	<?php echo $form->create('Vacance',array('id'=>'formID','class'=>"niceform",'type'=>'file')); ?> 
		<fieldset>
			 <dl>
				<dt><label for="nom">Annonceur :</label></dt>
				<dd>
					<select name="data[Vacance][annonceur_id]" id="VacanceAnnonceurId" class="validate[required] input-200">
					<option value="">Choisir...</option>
					<?php  
						foreach($annonceurs as  $annonceur ) : ?>	
							
								<option value="<?php echo $annonceur['Annonceur']['id'] ; ?>" <?php if(isset($this->data['Annonceur']['id']) && $type['Annonceur']['id']== $this->data['Annonceur']['id'] ) echo 'selected' ; ?> >
								<?php echo $annonceur['Annonceur']['nom'] . ' ' . $annonceur['Annonceur']['prenom']  . ' - ' . $annonceur['Annonceur']['username']   ; ?></option>
						<?php endforeach; ?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt><label for="nom">Référence client :</label></dt>
				<dd><?php echo $form->input("Vacance.refClient", array("class"=>" newfleurinput ","label"=>false,"size"=>"14")); ?>
				</dd>
			</dl> 
			<dl>
				<dt><label for="nom">Budget :</label></dt>
				<dd><?php echo $form->input("Vacance.budget", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"14")); ?>
				</dd>
			</dl>		
			<dl>
				<dt><label for="nom">Ville :</label></dt>
				<dd>
					<?php echo $form->input('Vacance.city_id',array('type' => 'select','options' =>array('escape' => false,$villes),'label' =>false));?>
				</dd>
			</dl>
			<dl>
				<dt><label for="nom">Image :</label></dt>
				<dd>
					<?php echo $form->input('Vacance.imagePre',array('type' => 'file', 'label' =>false));?>
				</dd>
			</dl>		
			<dl>
				<dt><label for="nom">Nom :  </label></dt>
				<dd>
					<?php e($form->input('Vacance.titre',array('label' =>false,"style"=>"width:275px;")));?>
				</dd>
			</dl>			
			<dl>
				<dt><label for="nom">Description :  </label></dt>
				<dd>
					<?php e($cksource->ckeditor('Vacance.description',array('label' =>false)));?>
				</dd>
			</dl>			
			<dl>
				<dt><label for="nom">Méta titre :  </label></dt>
				<dd>
					<?php e($form->input('Vacance.mtitle',array('label' =>false,"style"=>"width:250px;")));?>
				</dd>
			</dl>			
			<dl>
				<dt><label for="nom">Méta description :  </label></dt>
				<dd>
					<?php e($form->input('Vacance.mdescription',array('label' =>false,"style"=>"width:650px;")));?>
				</dd>
			</dl>			
			<dl>
				<dt><label for="nom">Méta keywords :  </label></dt>
				<dd>
					<?php e($form->input('Vacance.mkeywords',array('label' =>false,"style"=>"width:650px;")));?>
				</dd>
			</dl>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl class="submit">
			 <?php echo $form->end("Valider"); ?>
			 </dl>
		</fieldset>			
	 </form>
 </div>