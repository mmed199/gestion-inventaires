<?php $lang =array('fr'=>'français','en'=>'Anglais','es'=>'Espagnol') ; ?>
<?php $position =array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10') ; ?>
<h2>Ajouter une question réponse</h2>
<div class="form">
	
		<?php echo $form->create('Faq',array('id'=>'formID','class'=>"niceform")); ?>
		<div>
			<fieldset>
				<dl>
					<dt><label for="title_question">Question :</label></dt>
					<dd><?php echo $form->input("Faq.title_question", array("class"=>" validate[required] newfleurinput ","label"=>false,'size'=>'50')); ?>
					</dd>
				</dl>
				<dl>
					<dt><label for="lang">Langue :</label></dt>
					<dd>
						<?php echo $form->input('Faq.lang',array('label' =>false,'type' => 'select','options' => $lang));?>
					</dd>
				</dl>
				<dl>
					<dt><label for="titre">Catégorie :</label></dt>
					<dd>
						<?php echo $form->input('cfaq_id',array('label' =>false,'type' => 'select','options' => $cfaqs));?>
					</dd>
				</dl>
				<dl>
					<dt><label for="position">Position :</label></dt>
					<dd>
						<?php echo $form->input('Faq.position',array('label' =>false,'type' => 'select','options' => $position));?>
					</dd>
				</dl>
				<dl>
					<dt><label for="slug">Slug :</label></dt>
					<dd><?php echo $form->input("Faq.slug", array("class"=>" validate[required] newfleurinput ","label"=>false,'size'=>'50')); ?>
					</dd>
				</dl>
				<dl>
					<dt><label for="page_title">Titre de la page :</label></dt>
					<dd><?php echo $form->input("Faq.page_title", array("class"=>" validate[required] newfleurinput ","label"=>false,'size'=>'50')); ?>
					</dd>
				</dl>
				<dl>
					<dt><label for="page_description">Description de la page :</label></dt>
					<dd><?php echo $form->input("Faq.page_description", array("class"=>" validate[required] newfleurinput ","type"=>"textarea","label"=>false,'size'=>'50')); ?>
					</dd>
				</dl>
				<dl>
					<dt><label for="reponse">Réponse :</label></dt>
					<dd>
						<textarea name="data[Faq][reponse]" rows="8" cols="60"></textarea>
						<script type="text/javascript">//<![CDATA[
						window.CKEDITOR_BASEPATH='/js/ckeditor/';
						//]]></script>
						<script type="text/javascript" src="/js/ckeditor/ckeditor.js?t=B5GJ5GG"></script>
						<script type="text/javascript">//<![CDATA[
						CKEDITOR.replace('data[Faq][reponse]');
						//]]>
						</script>
					</dd>
				</dl>
				 <dl class="submit">
				 <?php echo $form->end("Ajouter"); ?>
				 </dl>
			</fieldset>
 </div>
 </div>