  <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des dépenses</h2>
                <p class="sub-title">La gestion des depenses pour les utlisateurs.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/admin/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/admin/depenses/index">Gestion des depenses</a> </li>
                    <li class="active">ajouter une depense</li>
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
	                            <h5>Ajouter une dépense</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Depense',array(
																	'url'=>array('action'=>'ajouter'),
																	'class'=>'col-md-10 col-md-offset-1',
																	));?>
				                <div class="form-group">
									<label for="objet">Objet</label>
									<div id="objet" class="input-group">
										<?php echo $form->input('Depense.objet',array(
																					'label'=>false,
																					'class'=>'form-control',
																					'div'=>false) ) ; ?>
									</div>

								
								<div class="form-group">
	                        		<label for="signataire">Signé par </label>
	                        			<?php echo $form->input('Depense.signataire_id',array(
																					'label'=>false,
																					'options' => $signataires,
                                                                 					'empty'=>'--------',
																					'class'=>'form-control',
																					'div'=>false) ) ; ?>
	                        	</div>
				                <div class="form-group">
									<label for="date_signature">Date signature</label>		
									<div id="datetimepicker9" class="input-group date">
										<?php echo $form->input('Depense.date_signature',array(
																						'label'=>false,
																						'type'=>"text",
																						'class'=>'form-control date_picker',
																						'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
	                        	<button class="btn btn-default pull-right mt-10" type="submit"> Valider </button>
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
 <script>
   $('#datetimepicker9 .date_picker').datepicker({
        format: "dd/mm/yyyy",
        language: "fr",
        orientation: "bottom right",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });
    
</script>