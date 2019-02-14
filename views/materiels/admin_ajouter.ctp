 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">

                <h2 class="title">Gestion inventaires</h2>
                <p class="sub-title">Gestion des Materiels</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                   <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-stocks.html">Gestion de stock</a> </li>
                    <li><a href="/admin/materiels/index">Gestion d'inventaires</a> </li>
                    <li><a href="/admin/fournisseurs/index">Fournisseur</a></li>
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
	                            <h5>Ajouter un matériel</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Materiel',array(
																	'url'=>array('action'=>'ajouter'),
																	'class'=>'col-md-10 col-md-offset-1',
																	));?>


							<div class="form-group">
	                        			<label for="marque_id">Type Materiels</label>
										<?php echo $form->input('Materiel.typemateriel_id',array(
																				'label'=>false,
				                                                                'empty'=>'Type Matériels',
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
	                        </div>	
				                <div class="form-group">
									<label for="nom">Nom matériel</label>
										<?php echo $form->input('Materiel.nom',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>

				         

								<div class="form-group">
									<label for="nom">Prix</label>
										<?php echo $form->input('Materiel.prix',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>

                            <div class="form-group">
	                        	<label for="marque_id">Emplacement</label>
								<?php echo $form->input('Materiel.emplacement_id',array(
																				'label'=>false,
				                                                                'empty'=>'Emplacement', 
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
	                        	</div>


							<div class="form-group">
	                        			<label for="marque_id">Fournisseurs</label>
										<?php echo $form->input('Materiel.fournisseur_id',array(
																				'label'=>false,
				                                                                'empty'=>'fournisseur', 
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
	                        	</div>
								
	                       

	                               <div class="form-group">
									<label for="date_limite">Date achat</label>		
									<div id="datetimepicker9" class="input-group">
										<?php echo $form->input('Materiel.date_achat',array(
																						'label'=>false,
																						'type'=>"text",
																						'class'=>'form-control date_picker',
																						'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>

	                        <div class="form-group">
	                        			<label for="marque_id">Type Achats</label>
										<?php echo $form->input('Materiel.typeachat_id',array(
																				'label'=>false,
				                                                                'empty'=>'typeachat', 
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
	                        </div>

	                        

				                <div class="form-group">
									<label for="description">Description</label>
									<div class="panel-body">
										<?php echo $form->input('Materiel.description',array(
																					'label'=>false,
																					'rows'=>'10',
																					'cols'=>'80',
																					'class'=>'form-control',
																					'id'=>'editor1',
																					'div'=>false) ) ; ?>
									</div>
								</div>
									
	                        	<button class="btn btn-default pull-right mt-10" type="submit"> Ajouter </button>
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