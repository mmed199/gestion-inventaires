 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des dépenses</h2>
                <p class="sub-title">La gestion des dépenses </p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/admin/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/admin/depenses/index">Gestion des dépenses</a> </li>
                    <li class="active">Modifier la demande de dépenses</li>
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
	                            <h5>Modifier la demande des dépenses</h5>
	                        </div> 
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Depense',array('class'=>'col-md-10 col-md-offset-1'));?>
							<?php echo $form->hidden('id') ; ?>
							<?php echo $form->hidden('depense_id') ; ?>
								<div class="form-group">
	                        		<label for="objet">objet</label>
	                        			<?php echo $form->input('objet',array(
																					'label'=>false,
																					'class'=>'form-control',
																					'div'=>false) ) ; ?>
	                        	</div>
	                        	<div class="form-group">
	                        		<label for="signataire_id">signataire</label>
	                        			<?php echo $form->input('signataire',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
	                        	</div>
				                <div class="form-group">
									<label for="date_signature">Date signature</label>
									<div id="datetimepicker9" class="input-group date">
										<?php echo $form->input('Depense.date_signature',array(
																							'label'=>false,
																							'type'=>"text",
																							'value'=> strftime('%d/%m/%Y', strtotime($this->data['depense']['date_debut'])),
																							'class'=>'form-control date_picker',
																							'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
				                
				                
								<?php if($depense['Depense']['envoyer']==0) { ?> 
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