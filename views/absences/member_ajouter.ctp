 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des absences</h2>
                <p class="sub-title">La gestion des absences et des congés</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/gestion-absences.html">Gestion des absences</a> </li>
                    <li class="active">Demande d'absence</li>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
	    <div class="container-fluid">

	        <div class="row">
	            <div class="col-md-6">
	                <div class="panel">
	                    <div class="panel-heading">
	                        <div class="panel-title">
	                            <h5>Demande d'absence</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Absence',array(
																	'url'=>array('action'=>'ajouter'),
																	'class'=>'col-md-10 col-md-offset-1',
																	));?>
								<div class="form-group">
	                        		<label for="typeabsence_id">Type d'absence</label>
	                        			<?php echo $form->input('Absence.typeabsence_id',array(
																					'label'=>false,
                                                                 					'empty'=>'--------',
																					'class'=>'form-control',
																					'div'=>false) ) ; ?>
	                        	</div>
	                        	<div class="form-group">
	                        		<label for="annee_id">Année</label>
	                        			<?php echo $form->input('Absence.annee_id',array(
																				'label'=>false,
                                                                 				'empty'=>'--------',
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
	                        	</div>
				                <div class="form-group">
									<label for="date_debut">Date début</label>
									<div id="datepicker1" class="input-group">
										<?php echo $form->input('Absence.date_debut',array(
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
									<label for="date_fin">Date fin</label>		
									<div id="datepicker2" class="input-group">
										<?php echo $form->input('Absence.date_fin',array(
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
									<label for="commentaire">commentaire</label>
									<div class="panel-body">
										<?php echo $form->input('Absence.commentaire',array(
																							'label'=>false,
																							'rows'=>'10',
																							'cols'=>'80',
																							'class'=>'form-control',
																							'id'=>'editor1',
																							'div'=>false) ) ; ?>
									</div>
								</div>
	                        	<button class="btn btn-primary pull-right mt-10" type="submit"> Ajouter </button>
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