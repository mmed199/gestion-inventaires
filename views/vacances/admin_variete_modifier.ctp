<?php $this->set ('page_title', "Modifier le stock de la variété | Services4all");?>
<h3>Modifier le stock de la variante</h3>
<div class="error"></div>
<?php echo $form->create('Produit',array('id'=>'infosperso_form','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'admin_variete_modifier'))); ?>
<?php echo $form->hidden('Variete.produit_id') ;?>
<?php echo $form->hidden('Variete.id') ;?>
<br>
<fieldset>
	<dl>
		<dt>
			Couleur :
		</dt>
		<dd><?php echo $this->data['Couleur']['nom'];?></dd>
	</dl>
	<dl>
		<dt>
			Taille :
		</dt>
		<dd><?php echo $this->data['Taille']['nom'];?></dd>
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