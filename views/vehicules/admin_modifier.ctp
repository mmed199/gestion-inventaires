 <?php
	$attrs = $this->requestAction('/vehicules/getCriteresRecherche') ;
	$marques = $attrs['marques'] ;
	$modeles = $attrs['modeles'] ; 
?>

 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion de stocks</h2>
                <p class="sub-title">La gestion de Parc-Auto.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/admin/gestion-stocks.html">Gestion de stocks</a> </li>
                     <li><a href="/admin/vehicules/index">Gestion de Parc-Auto</a> </li>
                   <li class="active">Modifier le véhicule</li>
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
	                            <h5>Modifier le véhicule</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <?php echo $session->flash() ; ?>
							<?php echo $form->create('Vehicule',array('class'=>'col-md-10 col-md-offset-1'));?>
							<?php echo $form->hidden('id') ; ?>
							<?php echo $form->hidden('user_id') ; ?> 
				               <div class="col-sm-8">
				            	<div class="form-group">
									<label for="category_id">Catégorie</label>
										<?php echo $form->input('Vehicule.category_id',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'value' => $vehicule["Vehicule"]["category_id"],
																				'div'=>false) ) ; ?>
								</div>
							</div> 
				            <div class="col-sm-8">
				            	<div class="form-group">
									<label for="marque_id">Marque</label> 
										<?php echo $form->input('Vehicule.marque_id',array(
																				'label'=>false,
																				'type' => 'select',
				                                                                'options' => $marques,
																				'value' => $vehicule["Vehicule"]["marque_id"],
				                                                                'onChange'=>'updateModeles(this.value);',
				                                                                'name'=>'data[Vehicule][marque_id]',
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>
							</div> 
				            <div class="col-sm-8">
				            	<div class="form-group">
									<label for="modele_id">Modèle</label>
										<?php echo $form->input('Vehicule.modele_id',array(
																				'label'=>false,
																				'type' => 'select',
																				'value' => $vehicule["Vehicule"]["modele_id"],
                                                                				'name'=>'data[Vehicule][modele_id]',
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>
							</div>
				            <div class="col-sm-8">
				            	<div class="form-group">
									<label for="type_id">Type</label>
										<?php echo $form->input('Vehicule.type_id',array(
																				'label'=>false,
																				'type' => 'select',
                                                                    			'options' => $types,
																				'value' => $vehicule["Vehicule"]["type_id"],
                                                                				'name'=>'data[Vehicule][type_id]',
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>
							</div>
				            <div class="col-sm-8">
				            	<div class="form-group">
									<label for="num_matricule">Numéro de matricule</label>
										<?php echo $form->input('Vehicule.num_matricule',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>
							</div>
				            <div class="col-sm-8">
				            	<div class="form-group">
									<label for="puissance_fiscale">Puissance fiscale</label>
										<?php echo $form->input('Vehicule.puissance_fiscale',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>
							</div>
				            <div class="col-sm-8">
				            	<div class="form-group">
									<label for="nbr_place">Nombre de place</label>
										<?php echo $form->input('Vehicule.nbr_place',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>
							</div>
							<div class="col-sm-6">
				                <div class="form-group">
									<label for="mise_en_circulation">Date de mise en circulation</label>		
									<div id="datetimepicker9" class="input-group">
										<?php echo $form->input('Vehicule.mise_en_circulation',array(
															'label'=>false,
															'type'=>"text",
															'value'=> strftime('%d/%m/%Y', 
																	  strtotime($this->data['Vehicule']['mise_en_circulation'])),
															'class'=>'form-control date_picker',
															'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
				                <div class="form-group">
									<label for="description">Description</label>
									<div class="panel-body">
										<?php echo $form->input('Vehicule.description',array(
																					'label'=>false,
																					'rows'=>'10',
																					'cols'=>'80',
																					'class'=>'form-control',
																					'id'=>'editor1',
																					'div'=>false) ) ; ?>
									</div>
								</div>
							</div>
							<div class="col-sm-8">
				            	<div class="form-group">
				            		<img style="max-width:200px;max-height:200px;" src="/uploads/vehicules/<?php echo $vehicule['Vehicule']['photo'] ; ?>"/>
									<label for="photo" class="col-sm-5 control-label">Sélectionner une photo</label>
		                            <?php echo $form->input('Vehicule.imagePre', array('type' => 'file','class' => 'col-sm-10','label' =>false ));?>
		                        </div>
		                    </div>
							<div class="col-sm-12">
	                        	<button class="btn btn-default pull-right mt-10" type="submit"> Modifier </button>
	                        </div>
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

<script type="text/javascript" language="javascript">
function updateModeles(marque_id){
		$.ajax({
			url:'/vehicules/getModeleByMarqueId/'+marque_id,
			dataType: "text" ,
			success: function(data) {
				$('#VehiculeModeleId').empty();
				$('#VehiculeModeleId').html(data);			
			}
		}) ;
	}
</script>