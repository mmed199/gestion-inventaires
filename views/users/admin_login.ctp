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
                        <h4>ClicAdministration - Espace Admin</h4>
                    </div>
                </div>
                <div class="panel-body p-20">

                    <div class="section-title">
                        <p class="sub-title text-muted">Identifiez-vous.</p>
                    </div>
                    <?php echo $session->flash() ; ?>

					<?php echo $form->create('User');?>
                    	<div class="form-group">
                    		<?php echo $form->input('email',array(
													'label'=>"Addresse E-mail",
													'class'=>'form-control',
													'id'=>'email',
													'placeholder'=>'Addresse E-mail...',
													'autocomplete'=>'off',
													'div'=>false) ) ; ?>
                    	</div>
                    	<div class="form-group">
                    		<?php echo $form->input('password',array(
													'label'=>"Mot de passe",
													'class'=>'form-control',
													'id'=>'password',
													'placeholder'=>'Mot de passe...',
													'autocomplete'=>'off',
													'div'=>false) ) ; ?>
                    	</div>
                        <div class="form-group mt-20">
                            <div class="">
                                <a href="/users/recovercode" class="form-link"><small class="muted-text">Mot de passe oublié ?</small></a>
                                <button class="btn btn-success btn-labeled pull-right" type="submit">
                                    Connexion
                                    <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span>
                                </button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    <?php e($form->end()); ?>
                </div>
            </div>
            <!-- /.panel -->
            <p class="text-muted text-center"><small>Copyright © ClicAdministration 2018 | Version : 0.0.1.01
        </div>
        <!-- /.col-md-6 col-md-offset-3 -->
    </div>
    <!-- /.row -->
</div>