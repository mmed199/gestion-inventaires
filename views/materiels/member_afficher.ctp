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
                    <li><a href="/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/member/gestion-activites.html">Gestion des activités</a> </li>
                    <li><a href="/member/projets/index">Gestion des projets</a> </li>
                    <li class="active">Détail de projet</li>
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <a href="/member/taches/ajouter/<?php echo  $projet['Projet']['id']  ; ?>"><i class="fa fa-plus"></i><span>Ajouter une tâche</span></a>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section"> 
        <div class="container-fluid">
            <div class="row">
                <?php echo $session->flash() ; ?> 
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5><?php echo  $page_title  ; ?></h5>
                            </div> 
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 mt-15">
                               <strong>Référence: </strong> <?php echo  $projet['Projet']['id']  ; ?><br>
                               <strong>Description: </strong> <?php echo  $projet['Projet']['description']  ; ?><br>
                               <strong>Date de création: </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($projet['Projet']['created'])) ; ?><br>
                               <strong>Date limite: </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($projet['Projet']['date_limite'])) ; ?><br>
                              <!-- télécharger -->
                                <?php if ($projet['Projet']['status']==1) { ?>
                                            <strong>Status: </strong>
                                                <span class='label label-success label-wide'>Terminé</span>
                                            <br>
                                 <?php } else { ?>
                                            <strong>Status: </strong>
                                                <span class='label label-warning label-wide'>En cours</span>
                                            <br> 
                                <?php } ?> 
                                
                                <!-- Lister la table des tâches s'elle existe -->
                                <div class="panel-body p-20 overflow-x-auto">
                                    <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <?php if(!empty($taches) ) : ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>Liste des tâches: </h5>
                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Titre</i></th>
                                                        <th>Date de création</i></th>
                                                        <th>Date limite</th>
                                                        <th>Nombre d'équipe</th>
                                                        <th>Status</i></th>
                                                        <th class="ecomm-action-icon">Action</th>
                                                    </tr>
                                                    </thead> 
                                                    <tbody>
                                                        <?php foreach($taches as $t ) : ?>
                                                            <tr>
                                                                <td><?php echo $t['Tache']['id'] ; ?></td>
                                                                <td><?php echo $t['Tache']['titre'] ; ?></td>
                                                                <td><?php echo strftime( "%d/%m/%Y" , strtotime($t['Tache']['created'])) ; ?></td>
                                                                <td><?php echo strftime( "%d/%m/%Y" , strtotime($t['Tache']['date_limite'])) ; ?></td>
                                                                <td><?php echo $t['Tache']['nbr_equipe'] ; ?></td>
         
                                                                <!-- décision -->
                                                                <td>
                                                                    <?php echo ($t['Tache']['status'] == 0 ?"<span class='label label-warning label-wide'> En cours </span>"  : "<span class='label label-success label-wide'> Terminé </span>" ); ?>
                                                                </td>

                                                                <td>
                                                                    <a href="/member/taches/afficher/<?php echo $t['Tache']['id'] ; ?>" title ="Afficher"> 
                                                                        <button class="btn btn-default icon-only" type="button">
                                                                            <i class="fa fa-eye"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="/member/taches/modifier/<?php echo $t['Tache']['id'] ; ?>" title ="Modifier"><button class="btn btn-default icon-only" type="button">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button></a>
                                                                    <a href="/member/taches/supprimer/<?php echo $t['Tache']['id'] ; ?>" class="ask" title ="Supprimer"><button class="btn btn-default icon-only" type="button">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ; ?>                                 
                                                    </tbody>
                                                    <tfoot>
                                                    </tfoot>          
                                                </table>
                                                <?php else : ?>
                                                    <div class="alert alert-default bg-warning">
                                                        <button class='close' aria-label='Close' data-dismiss='alert' type='button'>
                                                            <span aria-hidden='true'>×</span>
                                                        </button>
                                                        Aucun tâche n'a été trouvé !
                                                    </div>  
                                            </div>
                                        <?php endif ; ?>  
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.section -->
</div>