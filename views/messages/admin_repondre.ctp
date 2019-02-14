<h2>Envoyer un message </h2>
<div class="form">
<?php echo $form->create('Message',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'repondre_valider'))); ?>
<fieldset>
		<dl><?php echo $form->hidden('nom',array('value'=>$message['Message']['nom'] )) ; ?>
			<dt><label for="email">Destinataire :</label></dt>
			<dd>
				<?php echo $form->input("Message.email", array("class"=>"validate[required,custom[email]] inputlong","label"=>false,'value'=>$message['Message']['email'],"style"=>"width:200px;")); ?>
			</dd>
		</dl>
		<dl>		
			<dt><label for="email">Objet : </label></dt>
			<dd>
				<?php echo $form->input("Message.objet", array("class"=>"validate[required] inputlong","label"=>false,'value'=> "Re: " . $message['Message']['objet'],"style"=>"width:200px;")); ?>
			</dd>	
		</dl>
		<dl>		
			<dt><label for="email">Message : </label>
			<dd>
				<textarea name="data[Message][message]" rows="8" cols="60"><?php echo $this->data['Message']['message'];?></textarea>
				<script type="text/javascript">//<![CDATA[
				window.CKEDITOR_BASEPATH='/js/ckeditor/';
				//]]></script>
				<script type="text/javascript" src="/js/ckeditor/ckeditor.js?t=B5GJ5GG"></script>
				<script type="text/javascript">//<![CDATA[
				CKEDITOR.replace('data[Message][message]');
				//]]>
				</script>
			</dd>
			<dl class="submit">
				<?php echo $form->end("Envoyer"); ?>
			 </dl>
		</fieldset>
			
	 </form>
 </div>