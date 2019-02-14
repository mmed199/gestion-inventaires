 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des projets</h2>
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
                    <li><a href="/admin/taches/index">Gestion des taches</a> </li>

                    <li class="active">Ajouter une Équipe</li>
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
                           

                                <!-- Detail de tache  -->
                                <h4>Detail de tache</h4><br>

                               <strong>Référence: </strong> <?php echo  $tache['Tache']['id']  ; ?><br>

                               <strong>Objet: </strong> <?php echo  $tache['Tache']['titre']  ; ?><br>
                             <strong>Texte: </strong> <?php echo  $tache['Tache']['texte']  ; ?><br>
                               <strong>Date de début: </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($tache['Tache']['date_debut'])) ; ?><br>
                               <strong>Date limite: </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($tache['Tache']['date_limite'])) ; ?><br>
                              
                                <?php if ($tache['Tache']['status']==1) { ?>
                                            <strong>Status: </strong>
                                                <span class='label label-success label-wide'> Términée </span>
                                            <br>
                                 <?php } else { ?>
                                            <strong>Status: </strong>
                                                <span class='label label-warning label-wide'>En cours </span>
                                            <br> <br> 
                                <?php } ?> 

                                <!-- ***********************************-->

	                            <h5>Ajouter équipe</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Tache',array(
																	'url'=>array('action'=>'ajouter_equipe'),
																	'class'=>'col-md-10 col-md-offset-1',
																	));?>
								<input id="MemberProjetId" type="hidden" name="data[Member][tache_id]" value="<?php echo $tache['Tache']['id']; ?>">
				                <div class="form-group">
									<label for="nom">Choisir un membre </label>
										<?php echo $form->input('Member.id',array('type' => 'select',
                                                                                         'empty' =>'------------', 
	                                                                                     'options' =>$members, 
	                                                                                     'class'=>"js-states form-control",
	                                                                                     'div'=>false,
	                                                                                     'label' =>false));?>
								</div>
	                        	<button class="btn btn-default pull-right mt-10" type="submit"> Ajouter </button>
	                        </form>
	                        <!-- /.col-md-12 -->
	                    </div>
                    </div>
                    </div>
	                </div>

                <?php if(!empty($equipes) ) : ?>
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Liste des équipes: </h5>
                            </div>
                        </div>
                        <div class="panel-body">
                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr> 
                                <th>Id</th>
                                <th>CIN</i></th>
                                <th>Nom & Prénom</i></th>
                                <th>Grade</th>
                                <th>Division</th>
                                <th>Status</i></th>
                                <th class="ecomm-action-icon">Action</th>
                            </tr>
                            </thead> 
                            <tbody>
                                <?php foreach($equipes as $e ) : ?>
                                    <tr>
                                        <td><?php echo $e['Member']['id'] ; ?></td>
                                        <td><?php echo $e['Member']['cin'] ; ?></td>
                                        <td><?php echo $e['Member']['nom'] ; ?><?php echo $e['Member']['prenom'] ; ?></td>
                                        <td><?php echo $e['Member']['grade'] ; ?></td>
                                        <td><?php echo $e['Division']['nom'] ; ?></td>
                                        <td>
                                            <?php echo ($e['Member']['active'] == 0 ?"<span class='label label-warning label-wide'> En cours </span>"  : "<span class='label label-success label-wide'> Terminé </span>" ); ?>
                                        </td>

                                        <td>
                                            <a href="/admin/members/afficher/<?php echo $e['Member']['id'] ; ?>" title ="Afficher"> 
                                                <button class="btn btn-default icon-only" type="button">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            <?php if ($e['Member']['active']==0) { ?>
                                            <a href="/admin/members/deletEquipe/<?php echo $e['Member']['id'] ; ?>" class="ask" title ="Activer">
                                                <button class="btn btn-default icon-only" type="button">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
                                            <?php }else { ?>
                                            <button class="btn btn-default icon-only" type="button" disabled>
                                                    <i class="fa fa-trash-o"></i>
                                            </button>
                                            <?php }; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ; ?>                                 
                            </tbody>
                            <tfoot>
                            </tfoot>          
                        </table>
                        </div>
                        <?php else : ?>
                        <div class="alert alert-default bg-warning">
                            <button class='close' aria-label='Close' data-dismiss='alert' type='button'>
                                <span aria-hidden='true'>×</span>
                            </button>
                            Aucun Member de l'équipe n'a été trouvé !
                        </div>  
                    </div>
                </div>
                </div>
                <?php endif ; ?>
	    </div>
	    <!-- /.container-fluid -->
	</section>
	<!-- /.section -->
</div>