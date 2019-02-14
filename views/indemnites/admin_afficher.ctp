 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des absences</h2>
                <p class="sub-title">La gestion des absences et des congés.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/admin/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/admin/gestion-absences.html">Gestion des absences</a> </li>
                    <li class="active">Afficher détail</li>
                </ul>
            </div>
           <!--  <div class="col-md-6 text-right">
               
           </div> -->
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
                                <h5><?php echo  $page_title  ; ?> du <?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['created'])) ; ?></h5>
                                <h6>
                                    Votre décision: <?php if($absence['Absence']['decision']==3) {?> <!-- Refusée = 3 / Accord Partiel = 2  / Accordée = 1 / En cours de tratement = 0 par default -->

                                                        <span class='label label-danger label-wide'> Refusée </span>

                                                        <?php }else if ($absence['Absence']['decision']==2) { ?>

                                                        <span class='label label-warning label-wide'> Accord Partiel </span>
                                                        
                                                        <?php }else if ($absence['Absence']['decision']==1) { ?>
                                                       
                                                        <span class='label label-success label-wide'> Accordée </span>
                                                      
                                                        <?php } else { ?>

                                                         <span class='label label-default label-wide'> En cours de traitement </span>
                                                        <br> 
                                                        <?php } ?> 
                                </h6>
                            </div> 
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 mt-15">
                               <strong>Référence: </strong> <?php echo  $absence['Absence']['id']  ; ?><br>
                               <strong>Nom & Prénom: </strong>
                                <?php if($absence['Member']['nom']=='') {?>
                                    <?php echo $absence['User']['nom'] ; ?> <?php echo $absence['User']['prenom'] ; ?>
                                    <?php } else { ?>
                                    <?php echo $absence['Member']['nom'] ; ?> <?php echo $absence['Member']['prenom'] ; ?>
                                <?php }; ?>
                                <br>
                               <strong>Type d'absence: </strong> <?php echo  $absence['Typeabsence']['title']  ; ?><br>
                               <strong>Année: </strong> <?php echo  $absence['Annee']['titre']  ; ?><br>
                               <strong>Durée: </strong> <?php echo  $absence['Absence']['duree']  ; ?><br>
                               <strong>Date début: </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['date_debut'])) ; ?><br>
                               <strong>Date fin: </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['date_fin'])) ; ?><br>
                              <!-- status -->
                                <?php if ($absence['Absence']['status']==1) { ?>
                                                        <strong>Status: </strong>
                                                            <span class='label label-success label-wide'> Términer </span>
                                                        <br>
                                 <?php } else { ?>
                                                        <strong>Status: </strong>
                                                            <span class='label label-warning label-wide'> En cours </span>
                                                        <br> 
                                                        <?php } ?> 

                                <strong>Commentaire: </strong>
                                <p><?php echo  $absence['Absence']['commentaire']  ; ?></p>
                                <?php if($absence['Absence']['envoyer']==1) { ?> 
                                <strong>Votre remarque pour la décision "Accord Partiel": </strong>
                                <p><?php echo  $absence['Absence']['remarque']  ; ?></p>
                                <?php } ?>
                                <!-- Ajouter une remarque si la décision est Refus -->
                                <?php if($absence['Absence']['decision']==2 && $absence['Absence']['envoyer']==0) { ?> 
                                    <?php echo $form->create('Absence',array('url'=>"/admin/absences/envoyer/".$absence['Absence']['id']));?>
                                        <?php $absence['Absence']['user_id'] ; ?>
                                            <div class="form-group">
                                                <label for="commentaire">Votre remarque pour la décision "Accord Partiel": </label>
                                                <div class="panel-body">
                                                    <?php echo $form->input('Absence.remarque',array(
                                                                                                'label'=>false,
                                                                                                'rows'=>'10',
                                                                                                'cols'=>'80',
                                                                                                'class'=>'form-control',
                                                                                                'id'=>'editor1',
                                                                                                'div'=>false) ) ; ?>
                                                </div>
                                            </div>
                                <?php } ?>
                                 <!-- end remarque -->
                                    <div class="panel-body">
                                    <?php if($absence['Absence']['envoyer']==0) { ?> 
                                        <a href="/admin/absences/accorder/<?php echo $absence['Absence']['id']  ; ?>">
                                            <button class="btn btn-success  btn-labeled" type="button">
                                                <span class="btn-label"><i class="fa fa-check"></i></span>Accorder
                                            </button>
                                        </a>
                                        <a href="/admin/absences/accordPartiel/<?php echo $absence['Absence']['id']  ; ?>">
                                            <button class="btn btn-warning  btn-labeled" type="button">
                                                <span class="btn-label"><i class="fa fa-exclamation-circle"></i></span>Accord Partiel
                                            </button>
                                        </a>
                                        <a href="/admin/absences/refuser/<?php echo $absence['Absence']['id']  ; ?>">
                                            <button class="btn btn-danger  btn-labeled" type="button">
                                                <span class="btn-label"><i class="fa fa-close"></i></span>Refuser
                                            </button>
                                        </a>
                                        <?php if($absence['Absence']['decision']!=0) { ?>                     
                                        <a href="/admin/absences/envoyer/<?php echo $absence['Absence']['id']  ; ?>">
                                            <button class="btn btn-default btn-labeled pull-right" type="submit">
                                                <span class="btn-label"><i class="fa fa-send"></i></span>Envoyer
                                            </button>
                                        </a>
                                        <?php } ?>

                                     <?php } ?>
                                        <a href="/admin/absences/imprimer/<?php echo $absence['Absence']['id']  ; ?>">
                                            <button class="btn btn-default btn-labeled pull-right" style = "margin-left: 10px;" type="button">
                                                <span class="btn-label"><i class="fa fa-print"></i></span>Imprimer
                                            </button>
                                        </a>

                                        <?php if($this->Session->read('Auth.User.id') == $absence['Absence']['user_id'] && $absence['Absence']['decision']==0) { ?>                     
                                        <a href="/admin/absences/modifier/<?php echo $absence['Absence']['id']  ; ?>">
                                            <button class="btn btn-default btn-labeled pull-right" type="button">
                                                <span class="btn-label"><i class="fa fa-edit"></i></span>Modifier
                                            </button>
                                        </a>
                                        <?php } ?> 
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