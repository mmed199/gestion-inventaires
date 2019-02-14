<?php
$site_url = Configure::read("site_url");
$site_url_courte = Configure::read("site_url_courte");
$site_name =Configure::read("site_name");
$this->set ('page_title','Authentification - ' . $site_name );
?>

<div class="login-bg-color bg-black-300">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel login-box">
				<div class="panel-heading">
					<div class="panel-title text-center">
						<h4>ClicAdministration</h4>
					</div>
				</div>
				<div class="panel-body p-20">

					<div class="section-title">
						<p class="sub-title text-muted">Identifiez-vous.</p>
					</div>
					<?php echo $session->flash() ; ?>

					<?php echo $form->create('Member',array('id'=>'MemberConnexionForm'));?>
						<div class="form-group">
							<label for="email">Addresse E-mail</label>
							<input type="email" class="form-control" id="email" placeholder="Addresse E-mail..." autocomplete="off" >
						</div>
						<div class="form-group">
							<label for="password">Mot de passe</label>
							<input type="password" class="form-control" id="password" placeholder="Mot de passe...">
						</div>
						<div class="form-group mt-20">
							<div class="">
								<a href="/mot-de-passe-oublie.html" class="form-link"><small class="muted-text">Mot de passe oublié ?</small></a>
								<input id="SubmitLogin" class="btn btn-success btn-labeled pull-right" type="submit" onclick="$('#MemberConnexionForm').submit();" value="Connexion" name="SubmitLogin">
								<div class="clearfix"></div>
							</div>
						</div>
					<?php e($form->end()); ?>

					<hr>

					<div class="text-center">
						<a href="#" class="form-link"><small class="muted-text">Créez votre compte!</small></a>
					</div>

				</div>
			</div>
			<!-- /.panel -->
			<p class="text-muted text-center"><small>Copyright © ClicAdministration 2018 | Version : 0.0.1.01
		</div>
		<!-- /.col-md-6 col-md-offset-3 -->
	</div>
	<!-- /.row -->
</div>