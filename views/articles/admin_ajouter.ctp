<h2>Ajouter une nouvelle article</h2>
<div class="form">
    <?php echo $form->create('Article',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'ajouter'))); ?>
		<fieldset>
			<dl>
				<dt><label for="titre">Titre de l'article : </label></dt>
				<dd>
					<?php e($form->input("Article.title", array("class"=>" validate[required] newfleurinput ","label"=>false,"style"=>"width:450px;"))); ?>
				</dd>
			</dl>
			<dl>
				<dt><label for="titre">Section de l'article : </label></dt>
				<dd>
					<?php echo $form->input("asection_id", array("label"=>false)); ?>
				</dd>
			</dl>
			<dl>
				<dt><label for="titre">Résumé de l'article : </label></dt>
				<dd>
					<?php e($form->input("Article.scontent", array("class"=>" validate[required] newfleurinput ","label"=>false,"style"=>"width:450px;"))); ?>
				</dd>
			</dl> 
			<dl>
				<dt><label for="titre">Contenu : </label></dt>
				<dd>
					<?php e($cksource->ckeditor("Article.content", array("class"=>" validate[required] newfleurinput ","label"=>false))); ?>
				</dd>
			</dl>
			<dl>
				<dt><label for="titre">Méta titre : </label></dt>
				<dd>
					<?php e($form->input("Article.meta_title", array("class"=>" validate[required] newfleurinput ","label"=>false,"style"=>"width:450px;"))); ?>
				</dd>
			</dl>
			<dl>
				<dt><label for="titre">Méta description : </label></dt>
				<dd>
					<?php e($form->input("Article.meta_description", array("class"=>" validate[required] newfleurinput ","label"=>false,"style"=>"width:650px;"))); ?>
				</dd>
			</dl>
			<dl>
				<dt><label for="titre">Méta keywords : </label></dt>
				<dd>
					<?php e($form->input("Article.meta_keywords", array("class"=>" validate[required] newfleurinput ","label"=>false,"style"=>"width:650px;"))); ?>
				</dd>
			</dl>
			 <dl class="submit">
				<?php echo $form->end(" Ajouter "); ?>
			 </dl>
		</fieldset>
	 </form>
 </div>