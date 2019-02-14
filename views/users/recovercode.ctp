 <div class="login_form">         
	<h4>Mot de passe oublié </h4>
	<br>
	<?php echo $form->create('User',array('class'=>'form-horizontal')) ; ?>
		<div style="text-align:center; color: red;">
			<?php echo $this->Session->flash('auth'); echo $this->Session->flash() ; ?>
		</div>
		<div class="control-group">
		 	<label class="control-label" for="inputEmail">Email</label>
		    <div class="controls">
		    	<?php echo $form->input('email',array('id'=>"inputEmail",'placeholder'=>"Email",'label'=>false));?>
		    </div>
		</div>
	    <div class="control-group">
		    <div class="controls">
			    <button type="submit" class="btn btn-primary" id="submit">Valider</button>
			    <a href="/admin/users/login" class="forgot_pass">retourner à la page de connexion</a> 
			</div>
	    </div>	
	</form>
</div>