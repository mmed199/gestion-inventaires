<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des indemnités</h2>
                <p class="sub-title">La gestion des indemnites pour les utlisateurs.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-activites.html">Gestion des activités</a> </li>
                    <li><a href="/admin/projets/index">Gestion des projets</a> </li>
                    <li><a href="/admin/projets/afficher/<?php echo $id_projet; ?>" > <?php echo  $nom_projet; ?></a></li>
                    <li class="active">Ajouter une tâche</li>
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
                                <h5><?php echo  $page_title  ; ?> du <?php echo strftime( "%d/%m/%Y" , strtotime($depense['Depense']['created'])) ; ?></h5>
                            </div> 
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 mt-15">
                               <strong>Référence: </strong> <?php echo  $depense['Depense']['id']  ; ?><br>
                               <strong>Objet: </strong> <?php echo  $depense['Depense']['objet']  ; ?><br>
                               <strong>Date de création: </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($depense['Depense']['created'])) ; ?><br>
                               <strong>Signé par: </strong><?php echo $depense['Signataire']['nom'] ; ?> <?php echo $depense['Signataire']['prenom'] ; ?><br>
                              <!-- télécharger -->
                                <?php if ($depense['Depense']['telecharge']==1) { ?>
                                            <strong>Status: </strong>
                                                <span class='label label-success label-wide'> Téléchargé </span>
                                            <br>
                                 <?php } else { ?>
                                            <strong>Status: </strong>
                                                <span class='label label-warning label-wide'>Pas encore téléchargé ! </span>
                                            <br> 
                                <?php } ?> 
                                
                                <!-- Lister la table des indémnités s'elle existe -->
                                ++++++++++++++++++++++
                                 <!-- end  -->
                                    <div class="panel-body">
                                    <?php if($depense['Depense']['telecharge']==0) { ?> 
                                     
                                        <a href="/admin/depenses/telecharger/<?php echo $depense['Depense']['id']  ; ?>">
                                            <button class="btn btn-default btn-labeled pull-right" style = "margin-left: 10px;" type="button">
                                                <span class="btn-label"><i class="fa fa-upload"></i></span>Télécharger
                                            </button>
                                        </a>           
                                        
                                     <?php } ?>    
                                    <a href="/admin/depenses/modifier/<?php echo $depense['Depense']['id']  ; ?>">
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