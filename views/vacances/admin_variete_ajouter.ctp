<?php $this->set ('page_title', "Ajouter une variante et un stock | Services4all");?>
<h3>Définir une variante de l'article</h3><div class="error"></div>
<?php echo $form->create('Produit',array('id'=>'infosperso_form','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'admin_variete_ajouter'))); ?>
<?php echo $form->hidden('Variete.produit_id') ;?>
<fieldset>
	<dl>
		<dt>
			Couleur :
		</dt>
		<dd><?php echo $form->input('Variete.couleur_id',array('type' => 'select','options' =>$couleurs, 'label' =>false));?></p></dd>
	</dl>
	<dl>
		<dt>
			Taille :
		</dt>
		<dd><p><?php echo $form->input('Variete.taille_id',array('type' => 'select','options' =>$tailles, 'label' =>false));?></p></dd>
	</dl>
	<dl>
		<dt>
			Stock :
		</dt>
		<dd><?php echo $form->input("Variete.stock", array(
									'label' =>false,
									'type' => 'text','size'=>8,"onchange"=>"this.value =reformat_prix(this.value);"
									));?>
		</dd>
	</dl>
	<dl>
		<dt>
		
		<dl class="submit">
			<?php echo $form->end("Valider"); ?>
		 </dl>
	</fieldset>
		
 </form>