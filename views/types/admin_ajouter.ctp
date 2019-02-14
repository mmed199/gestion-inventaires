<h2>Ajouter un nouveau Type</h2>
<div class="form">
    <?php echo $form->create('Type',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'ajouter'))); ?>
		<fieldset>
			<dl>
				<dt><b>Préfixe</b></dt>
				<dd></dd>
			</dl>
			<?php foreach(Configure::read('Config.languages') as $codeLang => $locale): ?>
			<dl>
				<dt><label for="nom">préfixe (<?php echo $codeLang ; ?>):  </label></dt>
				<dd>
					<?php e($form->input('Type.prefixe.'.$locale,array('label' => false,"style"=>"width:250px;")));?>
				</dd>
			</dl>
			<?php endforeach; ?>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl>
				<dt><b>Nom du Type</b></dt>
				<dd></dd>
			</dl>
			<?php foreach(Configure::read('Config.languages') as $codeLang => $locale): ?>
			<dl>
				<dt><label for="nom">Nom (<?php echo $codeLang ; ?>):  </label></dt>
				<dd>
					<?php e($form->input('Type.nom.'.$locale,array('label' => false,"style"=>"width:250px;")));?>
				</dd>
			</dl>
			<?php endforeach; ?>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl>
				<dt><b>Nom pluriel</b></dt>
				<dd></dd>
			</dl>
			<?php foreach(Configure::read('Config.languages') as $codeLang => $locale): ?>
			<dl>
				<dt><label for="nom">Pluriel (<?php echo $codeLang ; ?>):  </label></dt>
				<dd>
					<?php e($form->input('Type.nom_p.'.$locale,array('label' => false,"style"=>"width:250px;")));?>
				</dd>
			</dl>
			<?php endforeach; ?>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl>
				<dt><label for="email">Catégorie :</label></dt>
				 <dd><?php echo $form->input('category_id', array('type'=>'select','label'=>false,'options'=>$categories)); ?>
				</dd>
			</dl>
			<dl>
				<dt><label for="email">Catégorie Google :</label></dt>
				<dd><?php echo $form->input("Type.google_product_category", array("class"=>" validate[required]","label"=>false,"style"=>"width:450px;")); ?>
				</dd>
			</dl>
			<dl>
				<dt><label for="email">Famille de produit :</label></dt>
				 <dd><?php echo $form->input('pfamille_id', array('type'=>'select','label'=>false,'options'=>$familles,'empty' => '')); ?>
				</dd>
			</dl>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl>
				<dt><b>Slug</b></dt>
				<dd></dd>
			</dl>
			<?php foreach(Configure::read('Config.languages') as $codeLang => $locale): ?>
			<dl>
				<dt><label for="nom">Slug (<?php echo $codeLang ; ?>):  </label></dt>
				<dd>
					<?php e($form->input('Type.slug.'.$locale,array('label' => false,"style"=>"width:250px;")));?>
				</dd>
			</dl>
			<?php endforeach; ?>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl>
				<dt><b>Méta titre</b></dt>
				<dd></dd>
			</dl>
			<?php foreach(Configure::read('Config.languages') as $codeLang => $locale): ?>
			<dl>
				<dt><label for="nom">Méta titre (<?php echo $codeLang ; ?>):  </label></dt>
				<dd>
					<?php e($form->input('Type.mtitle.'.$locale,array('label' => false,"style"=>"width:450px;")));?>
				</dd>
			</dl>
			<?php endforeach; ?>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl>
				<dt><b>Méta description</b></dt>
				<dd></dd>
			</dl>
			<?php foreach(Configure::read('Config.languages') as $codeLang => $locale): ?>
			<dl>
				<dt><label for="nom">Méta description (<?php echo $codeLang ; ?>):  </label></dt>
				<dd>
					<?php e($form->input('Type.mdescription.'.$locale,array('label' => false,"style"=>"width:650px;")));?>
				</dd>
			</dl>
			<?php endforeach; ?>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl>
				<dt><b>Méta mots clefs</b></dt>
				<dd></dd>
			</dl>
			<?php foreach(Configure::read('Config.languages') as $codeLang => $locale): ?>
			<dl>
				<dt><label for="nom">Méta mots clefs (<?php echo $codeLang ; ?>):  </label></dt>
				<dd>
					<?php e($form->input('Type.mkeywords.'.$locale,array('label' => false,"style"=>"width:650px;")));?>
				</dd>
			</dl>
			<?php endforeach; ?>
			<dl><dt>&nbsp;&nbsp;</dt><dd></dd></dl>
			<dl class="submit">
			 <?php echo $form->end(" Ajouter "); ?>
			</dl>
		</fieldset>
	</form>
 </div>