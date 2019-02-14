<?php 
	$civilites =array('1'=>'Monsieur','2'=>'Madame','3'=>'Mademoiselle') ;
	$site_name =Configure::read("site_name");
	$this->set('page_title',"Inscription ~ ".$site_name ) ; 
?>
 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h4 class="title">Mon profil: <small class="ml-10"><?php echo ucfirst ($session->read('Auth.Member.nom'));  ?> <?php echo ucfirst($session->read('Auth.Member.prenom'));  ?></small></h4>
                <p class="sub-title">La gestion des paramètres et les informations générales de votre profil</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
					<li><a href="/"><i class="fa fa-home"></i> Accueil</a></li>
					<li><a href="/mon-profil.html"><i class="fa fa-home"></i> Mon profil</a></li>
					<li class="active">Modifier ma photo de profil</li>
				</ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
	    <div class="container-fluid">

	        <div class="row">
	            <div class="col-md-4 col-md-offset-3">
	                <div class="panel">
	                    <div class="panel-heading">
	                        <div class="panel-title">
	                            <h5>Modifier ma photo de profil</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

		                    <?php echo $form->create('Member',array('id'=>'edit_photo','class'=>'form-horizontal','type'=>'file')); ?>
		                        <div class="form-group">
		                        	<label for="logo" class="col-sm-5 control-label">Sélectionner votre image</label>
		                            <?php echo $form->input('logo', array('type' => 'file','class' => 'col-sm-10','label' =>false ));?>
		                    	</div>
		                    	<div class="form-group mt-20">
		                            <div class="col-sm-offset-2 col-sm-10">
		                                <button type="submit" class="btn btn-success btn-labeled pull-right"> Modifier <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
		                               <div class="clearfix"></div>
		                            </div>
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