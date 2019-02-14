 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">

                <h2 class="title">Gestion inventaires</h2>
                <p class="sub-title">Gestion des Types Materiel</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                     <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-stocks.html">Gestion de stock</a> </li>
                    <li><a href="/admin/typemateriels/index">Typemateriel</a> </li>

                     
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
	                            <h5>Ajouter un typemateriel</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Typemateriels',array(
																	'url'=>array('action'=>'ajouter'),
																	'class'=>'col-md-10 col-md-offset-1',
																	));?>
				                <div class="form-group">
									<label for="nom">Titre</label>
										<?php echo $form->input('Typemateriel.title',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>

				               

								<div class="form-group">
									<label for="nom">Slug</label>
										<?php echo $form->input('Typemateriel.slug',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>

								<div class="form-group">
									<label for="nom">Nombre de Materiel</label>
										<?php echo $form->input('Typemateriel.nbr_mat',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
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