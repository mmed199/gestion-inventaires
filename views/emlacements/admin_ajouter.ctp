 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion d'emplacements</h2>
                <p class="sub-title">La gestion d'emplacements............</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-stocks.html">Gestion de stock</a> </li>
                    <li><a href="/admin/materiels/index">Gestion d'inventaire'</a> </li>
                     <li class="active"><a href="/admin/emplacements/index">Emplacement</a> </li>
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
	                            <h5>Ajouter un emplacement</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Emplacement',array(
																	'url'=>array('action'=>'ajouter'),
																	'class'=>'col-md-10 col-md-offset-1',
																	));?>
				                <div class="form-group">
									<label for="code">Code emplacement</label>
										<?php echo $form->input('Emplacement.code',array(
																				'label'=>false,
																				'class'=>'form-control',
																				'div'=>false) ) ; ?>
								</div>

				                <div class="form-group">
									<label for="Commentaire">Commentaire</label>
									<div class="panel-body">
										<?php echo $form->input('Emplacement.commentaire',array(
																					'label'=>false,
																					'rows'=>'10',
																					'cols'=>'80',
																					'class'=>'form-control',
																					'id'=>'editor1',
																					'div'=>false) ) ; ?>
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