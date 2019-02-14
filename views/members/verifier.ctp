<?php $this->set ('page_title',"Demande de vérification ~ Services4all");?>

<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" rel="tooltip" title="retour à Accueil" href="/">
			<i class="icon-home"></i>
		</a>
		<span class="navigation-pipe">></span>
		<a class="breadcrumb-home" rel="tooltip" title="Mon profil" href="/mon-profil.html">
			Mon profil
		</a>
		<span class="navigation-pipe">></span>
		<span class="navigation_page">Demande de vérification</span>
	</div>
</div>
<br>	
<!-- Menu member -->
<?php echo $this->element('members/nav-member') ; ?>
<h1>
	<span>Demande de vérification</span>
</h1>
<div class="comment-field">
	<?php echo $form->create('Member',array('id'=>'verifier','class'=>'form-horizontal','type'=>'file')); ?>
		<?php echo $form->hidden('id') ;?>
		<div class="control-group span6" style = "margin-top:25px; margin-bottom: 32px;">
			<div class="controls input-min-large">
				<?php echo $form->input('verified_file', array('type' => 'file','label' =>'' ));?>
			</div>
		</div>
		<p class="cart_navigation required submit">
			<input id="submitAccount" class="exclusive" type="submit" onclick="$('#verifier').submit();" value=" Envoyer " name="submitAccount">
		</p>		
	</form>
</div>	