<?php 
	$civilites =array('1'=>'Monsieur','2'=>'Madame','3'=>'Mademoiselle') ;
	$site_name =Configure::read("site_name");
	$this->set('page_title',"Inscription ~ ".$site_name ) ; 
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
                        <p class="sub-title text-muted">Créez votre compte.</p>
                    </div>
                    <?php echo $session->flash() ; ?>
                    <?php echo $form->create('Member',array('action'=>'inscription')); ?>
                        <div class="form-group">
                    		<label for="civilite">Civilité<sup> * </sup></label>
                            <?php echo $form->input('civilite',array(
																	'label' =>false,
																	'class' =>'form-control',
																	'id' =>'civilite',
                                                                    'type' => 'select',
																	'empty' => '-----------',
																	'options' => $civilites,
																	'name'=>'data[Member][civilite]',
																	));?>
                    	</div>
                    	<div class="form-group">
                    	<label for="nom">Nom<sup> * </sup></label>
                            <?php echo $form->input('nom',array(
																'label' =>false,
																'class' =>'form-control',
																'id' =>'nom',
																'placeholder' =>'Nom...',
																'type' => 'text'
																));?>
						</div>
						<div class="form-group">
                    	<label for="prenom">Prénom<sup> * </sup></label>
                            <?php echo $form->input('prenom',array(
																'label' =>false,
																'class' =>'form-control',
																'id' =>'prenom',
																'placeholder' =>'Prénom...',
																'type' => 'text'
																));?>
						</div>
                    	<div class="form-group">
                    		<label for="email">Addresse E-mail<sup> * </sup></label>
                            <?php echo $form->input('email',array(
																'label' =>false,
																'class' =>'form-control',
																'id' =>'email',
																'placeholder' =>'Addresse E-mail...',
																'type' => 'text'
																));?>
                    	</div>
                    	<div class="form-group">
                    		<label for="password">Mot de passe<sup> * </sup></label>
                    		<?php echo $form->input('password',array(
																	'label' =>false,
																	'class' =>'form-control',
																	'id' => 'password',
																	'placeholder' =>'Mot de passe...',
																	));?>
                    	</div>
                    	<div class="form-group">
                    		<label for="repassword">Confirmer le mot de passe<sup> * </sup></label>
                    		<?php echo $form->input('repassword',array(
																	'label' =>false,
																	'type' =>'password',
																	'class' =>'form-control',
																	'id' => 'repassword',
																	'placeholder' =>'Confirmer le mot de passe...',
																	));?>
                    	</div>
                       <!--  <div class="checkbox op-check">
                           <label>
                               <input type="checkbox" name="remember" class="flat-blue-style"> <span class="ml-10">I agree <a href="#">terms & conditions</a></span>
                           </label>
                       </div> -->
                        <div class="form-group mt-20">
                            <div class="">
                                <button type="submit" class="btn btn-success btn-labeled pull-right"> S'inscrire <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                               <div class="clearfix"></div>
                            </div>
                        </div>
                        <span>
							<sup>*</sup>
							Champs obligatoires
						</span>
                    </form>

                </div>
            </div>
            <!-- /.panel -->
             <p class="text-muted text-center"><small>Copyright © ClicAdministration 2018 | Version : 0.0.1.01
        </div>
        <!-- /.col-md-6 col-md-offset-3 -->
    </div>
    <!-- /.row -->
</div>
<!-- /. -->