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
                    <li><a href="/"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/member/absences/index">Gestion des absences</a> </li>
                    <li class="active">Afficher détail</li>
                </ul>
            </div>
            <!-- <div class="col-md-6 text-right">
            </div> -->
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
                                <h5><?php echo  $page_title  ; ?> du <?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['created'])) ; ?></h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 mt-15">
                               <strong>Référence : </strong> <?php echo  $absence['Absence']['id']  ; ?><br>
                               <strong>Année : </strong> <?php echo  $absence['Annee']['id']  ; ?><br>
                               <strong>Type d'absence : </strong> <?php echo  $absence['Typeabsence']['title']  ; ?><br>
                               <strong>Année : </strong> <?php echo  $absence['Annee']['titre']  ; ?><br>
                               <strong>Durée : </strong> <?php echo  $absence['Absence']['duree']  ; ?><br>
                               <strong>Date début : </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['date_debut'])) ; ?><br>
                               <strong>Date fin : </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['date_fin'])) ; ?><br>
                               <!-- status -->
                                <?php if ($absence['Absence']['status']==1) { ?>
                                                        <strong>Status : </strong>
                                                            <span class='label label-success label-wide'> Términer </span>
                                                        <br>
                                 <?php } else { ?>
                                                        <strong>Status : </strong>
                                                            <span class='label label-warning label-wide'> En cours </span>
                                                        <br> 
                                                        <?php } ?> 
                                <strong>Commentaire : </strong>
                                <p><?php echo  $absence['Absence']['commentaire']  ; ?></p> <br>
                                <?php if(!empty($absence['Absence']['remarque']) ) : ?>
                                <strong>Remarque pour la décision "Accord Partiel": </strong>
                                <p><?php echo  $absence['Absence']['remarque']  ; ?></p>
                                <?php endif ; ?>  
                                <div class="panel-body">                               
                                    <a href="/member/absences/imprimer/<?php echo $absence['Absence']['id']  ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" style = "margin-left: 10px;" type="button">
                                            <span class="btn-label"><i class="fa fa-print"></i></span>Imprimer
                                        </button>
                                    </a>
                                <?php if($absence['Absence']['envoyer']==0) { ?>
                                    <?php if($absence['Absence']['satisfaction']==0) { ?>                         
                                    <a href="/member/absences/modifier/<?php echo $absence['Absence']['id']  ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" type="button">
                                            <span class="btn-label"><i class="fa fa-edit"></i></span>Satisfaction
                                        </button>
                                    </a> 
                                    <?php } else { ?>                       
                                    <a href="/member/absences/modifier/<?php echo $absence['Absence']['id']  ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" type="button">
                                            <span class="btn-label"><i class="fa fa-edit"></i></span>Modifier
                                        </button>
                                    </a>
                                    <?php } ?>
                                <?php } ?>
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