<div class="login_form">
         
	 <h1>Connexion</h1>
	 
	<?php echo $form->create('User',array('class'=>'niceform')) ; ?>
				<div style="text-align:center;">
					<?php echo $this->Session->flash('auth');
								  echo $this->Session->flash();
					?>
				</div>
				<table class="tab-con">
					<tr >
						<td class="td1"><label for="email">Login :</label></td>
						<td><?php echo $form->input('email',array('size'=>54,'label'=>false)) ; ?></td>
					</tr>
					<tr>
						<td class="td1"><label for="password">Mot de passe :</label></td>
						<td><?php echo $form->input('password',array('size'=>54,'label'=>false)) ; ?></td>
					</tr>
					
				</table>
				 <dl class="submit">
					<input type="submit" name="submit" id="submit" value="Connection" class="login-button" />
				 </dl>
				
		   <a href="/users/recovercode" class="forgot_pass">Mot de passe oublié ?</a> 
	
	 </form>
</div>  