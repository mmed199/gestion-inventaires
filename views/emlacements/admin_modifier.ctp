 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des projet</h2>
                <p class="sub-title">La gestion de projets et de suivie les tâches assignées à votre équipes.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                     <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/admin/gestion-activites.html">Gestion des activités</a> </li>
                     <li><a href="/admin/projets/index">Gestion des projets</a> </li>
                   <li class="active">modifier de projet</li>
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
	                            <h5>Modifier projet</h5>
	                        </div> 
	                    </div>
	                    <div class="panel-body">
	                    	   <?php echo $session->flash() ; ?>

				               
				                       <div class="form-group">
									<label for="nom">Nom de projet</label>
										<?php echo $form->input('Projet.nom',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>
				                <div class="form-group">
									<label for="description">Description</label>
									<div class="panel-body">
										<?php echo $form->input('Depense.description',array(
																					'label'=>false,
																					'rows'=>'10',
																					'cols'=>'80',
																					'class'=>'form-control',
																					'id'=>'editor1',
																					'div'=>false) ) ; ?>
									</div>
								</div>
				              
										<div class="form-group">
									<label for="date_limite">Date limite</label>		
									<div id="datetimepicker9" class="input-group date">
										<?php echo $form->input('Depense.date_limite',array(
																						'label'=>false,
																						'type'=>"text",
																						'class'=>'form-control date_picker',
																						'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
	                        	<button class="btn btn-default pull-right mt-10" type="submit"> Modifier </button>
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