<div id="contenu-entete">
	<div id="contenu-titre">
		<h2>Modifier l'annonce : <?php echo $this->data['Vacance']['titre']; ?></h2>
	</div>
	<div id='contenu-actions'>
		
	</div>
</div>
<div class="form">
		<?php echo $form->create('Vacance',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'modifier'))); ?>

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
                <dt><label for="logo"></label></dt>
                <dd>
                    <img alt="<?php echo $this->data['Vacance']['titre'] ; ?>" style="width:200px;" class="img-polaroid" title="<?php echo $this->data['Vacance']['titre'] ; ?>" src="<?php echo '/uploads/vacances/'.$this->data['Vacance']['image'] ; ?>" >
                </dd>
            </dl>
			<dl>
				<dt><label for="nom">Image :</label></dt>
				<dd>
					<?php echo $form->input('Vacance.imagePre',array('type' => 'file', 'label' =>false));?>
				</dd>
			</dl>		
			<dl>
				<dt><label for="nom">Titre:  </label></dt>
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
				 <?php echo $form->end(" Modifier "); ?>
				</dl>
		</fieldset>
	 </form>
 </div>