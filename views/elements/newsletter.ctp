<section id="newsletter_block_left"  class="block products_block column_box">
	<h4><span>Newsletter</span><span class="column_icon_toggle"></span></h4>
	<div class="block_content toggle_content">
		<form action="#" method="post">
			<p>
				<input type="email" name="email" size="18" 
					value="votre e-mail" 
					onfocus="javascript:if(this.value=='votre e-mail')this.value='';" 
					onblur="javascript:if(this.value=='')this.value='votre e-mail';" 
					class="inputNew" />
				<!--<select name="action">
				<option value="0">Inscription</option>
				<option value="1">Désinscription</option>
				</select>-->
				<input type="submit" value="ok" class="button_form button" name="submitNewsletter" />
				<input type="hidden" name="action" value="0" />
			</p>
		</form>
	</div>
</section>

<!-- 
<?php echo $form->create('Abonne',array('id'=>'newsletter_form-rapide',
												'url'=>array('controller'=>'abonnes',
												'action'=>'inscriptionRapide')
												)); ?>
			<p>
				<?php echo $form->input('email',array(
													'label' =>false,
													'div' =>false,
													'name' => "email",
													'value' => "votre e-mail",
													'type' => 'text',
													'size' => '18',
													'onfocus' => "javascript:if(this.value=='votre e-mail')this.value='';",
													'onblur' => "javascript:if(this.value=='')this.value='votre e-mail';",
													'class'=>'inputNew',
													));?>
				<!--<select name="action">
				<option value="0">Inscription</option>
				<option value="1">Désinscription</option>
				</select>--><!--
				<input type="submit" onclick="$('#newsletter_form-rapide').submit();" value="ok" class="button_form button" name="submitNewsletter" />
			</p>
		</form>
 -->
