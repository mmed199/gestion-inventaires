 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des Taches</h2>
                <p class="sub-title">La gestion des taches</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin"><i class="fa fa-home"></i>Accueil</a> </li>
                   <li><a href="/admin/gestion-activites.html">Gestion des activités</a> </li>
                    <li><a href="/admin/projets/index">Gestion des projets</a> </li>
                    <li><a href="/admin/taches/index">Gestion des taches</a> </li>


                    <li class="active">Modifier la Tâche</li>
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
	                            <h5>Modifier la tache</h5>
	                        </div> 
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>
							
							<?php echo $form->create('Tache',array(
																'url'=>"/admin/taches/modifier/".$id_tache,
																'class'=>'col-md-10 col-md-offset-1',
																));?>

							<?php echo $form->hidden('user_id') ; ?>
							<?php echo $form->hidden('projet_id') ; ?>
					            <div class="col-sm-8">
					                <div class="form-group">
										<label for="titre">Titre</label>
											<?php echo $form->input('Tache.titre',array(
																						'label'=>false,
																						'class'=>'form-control',
																						'div'=>false) ) ; ?>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label for="description">Texte</label>
										<div class="panel-body">
											<?php echo $form->input('Tache.texte',array(
																						'label'=>false,
																						'rows'=>'10',
																						'cols'=>'80',
																						'class'=>'form-control',
																						'id'=>'editor1',
																						'div'=>false) ) ; ?>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
					                <div class="form-group">
										<label for="date_debut">Date début</label>		
										<div id="datetimepicker9" class="input-group">
											<?php echo $form->input('Tache.date_debut',array(
																							'label'=>false,
																							'type'=>"text",
																							'value'=> strftime('%d/%m/%Y', strtotime($this->data['Tache']['date_debut'])),
																							'class'=>'form-control date_picker',
																							'div'=>false) ) ; ?>
											<span class="input-group-addon" style="">
												<span class="fa fa-calendar"> </span>
											</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
					                <div class="form-group">
										<label for="date_limite">Date limite</label>		
										<div id="datetimepicker2" class="input-group">
											<?php echo $form->input('Tache.date_limite',array(
																							'label'=>false,
																							'type'=>"text",
																							'value'=> strftime('%d/%m/%Y', strtotime($this->data['Tache']['date_limite'])),
																							'class'=>'form-control date_picker',
																							'div'=>false) ) ; ?>
											<span class="input-group-addon" style="">
												<span class="fa fa-calendar"> </span>
											</span>
										</div>
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