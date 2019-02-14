<?php 
	$civilites =array('1'=>'Monsieur','2'=>'Madame','3'=>'Mademoiselle') ;
	$site_name =Configure::read("site_name");
	$this->set('page_title',"Inscription ~ ".$site_name ) ; 
?>
 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h4 class="title">Mon profil: <small class="ml-10"><?php echo ucfirst ($session->read('Auth.Member.nom'));  ?> <?php echo ucfirst($session->read('Auth.Member.prenom'));  ?></small></h4>
                <p class="sub-title">La gestion des paramètres et les informations générales de votre profil</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
					<li><a href="/"><i class="fa fa-home"></i> Accueil</a></li>
					<li class="active">Modifier mon profil</li>
				</ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
	    <div class="container-fluid">

	        <div class="row">
	            <div class="col-md-5 col-md-offset-1">
	                <div class="panel">
	                    <div class="panel-heading">
	                        <div class="panel-title">
	                            <h5>Modifier ou compléter vos informations de profil</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>
		                    <?php echo $form->create('Member',array('action'=>'editProfil')); ?>
		                        <div class="form-group">
		                    		<label for="civilite">Civilité<sup> * </sup></label>
		                            <?php echo $form->input('civilite',array(
																			'label' =>false,
																			'class' =>'form-control',
																			'id' =>'civilite',
																			'type' => 'select',
																			'value' => "data[Member][civilite]",
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
		                    		<label for="cin">N° C.I.N</label>
		                            <?php echo $form->input('cin',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'cin',
																		'placeholder' =>'N° C.I.N...',
																		'type' => 'text'
																		));?>
								</div>
				                <div class="form-group">
									<label for="date_naissance">Date de naissance</label>		
									<div id="datepicker" class="input-group">
										<?php echo $form->input('date_naissance',array(
																					'label'=>false,
																					'type'=>"text",
																					'class'=>'form-control date',
																					'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
								<div class="form-group">
		                    		<label for="grade">Grade</label>
		                            <?php echo $form->input('grade',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'grade',
																		'placeholder' =>'Grade...',
																		'type' => 'text'
																		));?>
								</div>
								<div class="form-group">
		                    		<label for="taux_de_base">Taux de base</label>
		                            <?php echo $form->input('taux_de_base',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'taux_de_base',
																		'placeholder' =>'Taux de base...',
																		'type' => 'text'
																		));?>
								</div>
								<div class="form-group">
		                    		<label for="ddr">D.D.R</label>
		                            <?php echo $form->input('ddr',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'ddr',
																		'placeholder' =>'D.D.R...',
																		'type' => 'text'
																		));?>
								</div>
								<div class="form-group">
		                    		<label for="rib">R.I.B</label>
		                            <?php echo $form->input('rib',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'rib',
																		'placeholder' =>'R.I.B...',
																		'type' => 'text'
																		));?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5">
	                	<div class="panel">
	                		<div class="panel-body">
								<div class="form-group">
		                    		<label for="telephone">Téléphone fix</label>
		                            <?php echo $form->input('telephone',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'telephone',
																		'placeholder' =>'Téléphone fix...',
																		'type' => 'text'
																		));?>
								</div>
								<div class="form-group">
		                    		<label for="mobile">GSM</label>
		                            <?php echo $form->input('mobile',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'mobile',
																		'placeholder' =>'GSM...',
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
		                    		<label for="adresse">Adresse </label>
		                            <?php echo $form->input('adresse',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'adresse',
																		'placeholder' =>'Adresse...',
																		'type' => 'text'
																		));?>
								</div>
								<div class="form-group">
		                    		<label for="adresse_suite">Adresse suite</label>
		                            <?php echo $form->input('adresse_suite',array(
																		'label' =>false,
																		'class' =>'form-control',
																		'id' =>'adresse_suite',
																		'placeholder' =>'Adresse suite...',
																		'type' => 'text'
																		));?>
								</div>
								<div class="form-group">
		                    		<label for="description">Description</label>
		                            <?php echo $form->input('description',array(
																		'label'=>false,
																		'rows'=>'10',
																		'cols'=>'80',
																		'class'=>'form-control',
																		'div'=>false) ) ; ?>
								</div>
								<div class="form-group">
		                    		<label for="experiences">Expériences professionnelles</label>
		                            <?php echo $form->input('experiences',array(
																		'label'=>false,
																		'rows'=>'10',
																		'cols'=>'80',
																		'class'=>'form-control',
																		'div'=>false) ) ; ?>
								</div>
								<div class="form-group">
		                    		<label for="poste_actuel">Poste actuel</label>
		                            <?php echo $form->input('poste_actuel',array(
																		'label'=>false,
																		'rows'=>'10',
																		'cols'=>'80',
																		'class'=>'form-control',
																		'div'=>false) ) ; ?>
								</div>
		                        <div class="form-group mt-20">
		                            <div class="">
		                                <button type="submit" class="btn btn-success btn-labeled pull-right"> Modifier <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
		                               <div class="clearfix"></div>
		                            </div>
		                        </div>
		                        <span>
									<sup>*</sup>
									Champs obligatoires
								</span>
		                    </form>

                <!-- /.col-md-12 -->
	                    </div>
	                </div>
	            </div>
	            <!-- /.col-md-6 -->
	        </div>
	        <!-- /.row -->
	    </div>
	    <!-- /.container-fluid -->
	</section>
	<!-- /.section -->
</div>