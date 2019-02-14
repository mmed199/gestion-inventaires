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
                    <li class="active">Equipes</li>
                </ul>
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
                                <h5>Ajouter Equipe</h5>
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
                            <?php if(!empty($equipes) ) : ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>Liste des tâches: </h5>
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
                                                                    <?php echo ($e['Member']['status'] == 0 ?"<span class='label label-warning label-wide'> En cours </span>"  : "<span class='label label-success label-wide'> Terminé </span>" ); ?>
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
                                                <?php else : ?>
                                                    <div class="alert alert-default bg-warning">
                                                        <button class='close' aria-label='Close' data-dismiss='alert' type='button'>
                                                            <span aria-hidden='true'>×</span>
                                                        </button>
                                                        Aucun Member de l'équipe n'a été trouvé !
                                                    </div>  
                                            </div>
                                        </div>
                                        <?php endif ; ?>  
                                        
                                    </div>
                                </div>
                                 <!-- end  -->
                                    <div class="panel-body">
                                    <?php if($projet['Projet']['status']==0) { ?> 
                                     
                                        <a href="/admin/projets/terminer/<?php echo $projet['Projet']['id']  ; ?>">
                                            <button class="btn btn-default btn-labeled pull-right" style = "margin-left: 10px;" type="button">
                                                <span class="btn-label"><i class="fa fa-upload"></i></span>Terminer
                                            </button>
                                        </a>           
                                        
                                     <?php } ?>    
                                    <a href="/admin/projets/modifier/<?php echo $projet['Projet']['id']  ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" type="button">
                                            <span class="btn-label"><i class="fa fa-edit"></i></span>Modifier
                                        </button>
                                    </a>
                                    </div> 
                                </form>
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