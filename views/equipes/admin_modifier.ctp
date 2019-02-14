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
                    <li><a href="/admin"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/admin/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/admin/gestion-absences.html">Gestion des absences</a> </li>
                    <li class="active">Modifier la demande d'absence</li>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
	    <div class="container-fluid">

	        <div class="row">
	            <div class="col-md-8 col-md-offset-2">
	                <div class="panel">
	                    <div class="panel-heading">
	                        <div class="panel-title">
	                            <h5>Modifier la demande d'absence</h5>
	                        </div> 
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Absence',array('class'=>'col-md-10 col-md-offset-1'));?>
							<?php echo $form->hidden('id') ; ?>
							<?php echo $form->hidden('user_id') ; ?>
								<div class="form-group">
	                        		<label for="prenom">Type d'absence</label>
	                        			<?php echo $form->input('typeabsence_id',array(
																					'label'=>false,
																					'class'=>'form-control',
																					'div'=>false) ) ; ?>
	                        	</div>
	                        	<div class="form-group">
	                        		<label for="prenom">Année</label>
	                        			<?php echo $form->input('annee_id',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
	                        	</div>
				                <div class="form-group">
									<label for="date_debut">Date début</label>
									<div id="datetimepicker9" class="input-group date">
										<?php echo $form->input('Absence.date_debut',array(
																							'label'=>false,
																							'type'=>"text",
																							'value'=> strftime('%d/%m/%Y', strtotime($this->data['Absence']['date_debut'])),
																							'class'=>'form-control date_picker',
																							'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
				                <div class="form-group">
									<label for="date_fin">Date fin</label>		
									<div id="datetimepicker9" class="input-group date">
										<?php echo $form->input('Absence.date_fin',array(
																						'label'=>false,
																						'type'=>"text",
																						'value'=> strftime('%d/%m/%Y', strtotime($this->data['Absence']['date_fin'])),
																						'class'=>'form-control date_picker',
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
								<?php if($absence['Absence']['envoyer']==0) { ?> 
	                        	<button class="btn btn-primary pull-right mt-10" type="submit"> Modifier </button>
	                        	<?php } else { ?>
	                        	<button class="btn btn-primary pull-right mt-10" type="submit"> Satisfaction </button>
	                        	<?php } ?>
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