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
                    <li class="active">Détail de Projet</li>
                </ul>
            </div>
            <?php if($projet['Projet']['status']==0) { ?>
            <div class="col-md-6 text-right">
                <a href="/admin/taches/ajouter/<?php echo  $projet['Projet']['id']  ; ?>"><i class="fa fa-plus"></i><span>Ajouter une Tâche</span></a>
                <a href="/admin/projets/ajouter_equipe/<?php echo  $projet['Projet']['id']  ; ?>"><i class="fa fa-plus"></i><span>Ajouter une Équipe</span></a>
            </div>
            <?php } ?> 
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section"> 
        <div class="container-fluid">
            <div class="row">
                <?php echo $session->flash() ; ?> 
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5><?php echo  $page_title  ; ?></h5>
                            </div> 
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs border-bottom border-primary" role="tablist">
                                <li role="presentation" class="active"><a class="" href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                               <!--  <li role="presentation"><a class="" href="#calendrier" aria-controls="calendrier" role="tab" data-toggle="tab">Calendrier</a></li>
                                <li role="presentation"><a class="" href="#suivi" aria-controls="suivi" role="tab" data-toggle="tab">Suivi des heures</a></li> -->
                            </ul>
                            <div class="tab-content bg-white pt-30">
                                <div role="tabpanel" class="tab-pane active" id="details">
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
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h5>Liste des tâches: </h5>
                                                    <?php if(!empty($taches) ) : ?>
                                                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Titre</i></th>
                                                                <th>Date debut</i></th>
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
                                                                    <td><?php echo strftime( "%d/%m/%Y" , strtotime($t['Tache']['date_debut'])) ; ?></td>
                                                                    <td><?php echo strftime( "%d/%m/%Y" , strtotime($t['Tache']['date_limite'])) ; ?></td>
                                                                    <td><?php echo $t['Tache']['nbr_equipe'] ; ?></td>
             
                                                                    <!-- décision -->
                                                                    <td>
                                                                        <?php echo ($t['Tache']['status'] == 0 ?"<span class='label label-warning label-wide'> En cours </span>"  : "<span class='label label-success label-wide'> Terminé </span>" ); ?>
                                                                    </td>

                                                                    <td>
                                                                        <a href="/admin/taches/afficher/<?php echo $t['Tache']['id'] ; ?>" title ="Afficher"> 
                                                                            <button class="btn btn-default icon-only" type="button">
                                                                                <i class="fa fa-eye"></i>
                                                                            </button>
                                                                        </a>
                                                                        <a href="/admin/taches/modifier/<?php echo $t['Tache']['id'] ; ?>" title ="Modifier"><button class="btn btn-default icon-only" type="button">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button></a>
                                                                        <a href="/admin/taches/supprimer/<?php echo $t['Tache']['id'] ; ?>" class="ask" title ="Supprimer"><button class="btn btn-default icon-only" type="button">
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
                                                    <?php endif ; ?>  
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h5>Liste des équipes: </h5>
                                                    <?php if(!empty($equipes) ) : ?>
                                                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr> 
                                                            <th>Id</th>
                                                            <th>CIN</i></th>
                                                            <th>Nom & Prénom</i></th>
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
                                                                    <td><?php echo ucfirst($e['Member']['nom']) ; ?> <?php echo ucfirst($e['Member']['prenom']) ; ?></td>
                                                                    <td><?php echo $e['Division']['abreviation'] ; ?></td>
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
                                                                        <a href="/admin/projets/deletEquipe/<?php echo $e['Member']['id'] ; ?>" class="ask" title ="Activer">
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
                                                    <?php endif ; ?>  
                                                </div>
                                            </div>
                                        </div>       
                                    </div>
                                    <!-- end  -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php if($projet['Projet']['status']==0) { ?> 
                                 
                                                <a href="/admin/projets/terminer/<?php echo $projet['Projet']['id']  ; ?>">
                                                    <button class="btn btn-default btn-labeled pull-right" style = "margin-left: 10px;" type="button">
                                                        <span class="btn-label"><i class="fa fa-check"></i></span>Terminer
                                                    </button>
                                                </a>   
                                                <a href="/admin/projets/modifier/<?php echo $projet['Projet']['id']  ; ?>">
                                                    <button class="btn btn-default btn-labeled pull-right" type="button">
                                                        <span class="btn-label"><i class="fa fa-edit"></i></span>Modifier
                                                    </button>
                                                </a>  

                                             <?php } ?>  
                                        </div>
                                    </div>
                                </div>
<!--                                 <div class="tab-pane" role="tabpanel" id="calendrier">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <h5> Calendrier </h5>
                                                    </div>
                                                </div>
                                                <div class="panel-body overflow-x-auto">
                                                    <div class="panel-title">
                                                        <h5><?php //echo  $page_title  ; ?></h5>
                                                    </div>
                                                    <?php/*

error_reporting(E_ALL);


define("GET_DATE_FORMAT","Y-m-d");

if(isset($_GET['firstday'])){

    //on vérifie le format de l'entrée GET : n'oubliez pas qu'il ne faut jamais faire confiance aux entrées utilisateur!

    try{

        

        $firstDay = DateTime::createFromFormat(GET_DATE_FORMAT,$_GET['firstday']);//si la donnée est au mauvais format, une exception est lancée

        

        $firstDay->modify("first day of this month");//pour être vraiment sûr que les données sont cohérentes

    }catch(Excpetion $e){

        

        $firstDay = new DateTime("first day of this month");

    }

}else{

    $firstDay = new DateTime("first day of this month");

}




$formatter_semaine = new IntlDateFormatter("fr_FR",IntlDateFormatter::FULL,IntlDateFormatter::FULL,'Europe/Paris',

                IntlDateFormatter::GREGORIAN,"EEEE" );

$formatter_semaine->setPattern("EEEE");

$formatter_mois = new IntlDateFormatter("fr_FR",IntlDateFormatter::FULL,IntlDateFormatter::NONE,'Europe/Paris',

                IntlDateFormatter::GREGORIAN,"MMMM" );

$formatter_mois->setPattern("MMMM");

?>

<h1><?php echo $formatter_mois->format($firstDay);?></h1>

<?php

$lastDay = clone $firstDay;

$lastDay->modify("last day of this month");// le dernier jour du mois

$offset_depart = $firstDay->format("w");// le nombre de jour qu'il faut passer au début du calendrier

$offset_fin = 6 - $lastDay->format("w");// le nombre de jour qu'il reste dans la dernière semaine du calendrier

$firstDay->modify("-$offset_depart days" );

$lastDay->modify("+$offset_fin days");

$dateInitWeek = clone $firstDay;

$endInitWeek = clone $dateInitWeek;

$endInitWeek->modify("+7 days");

$intervalInitWeek = new DateInterval("P1DT0S");

$aujourdhui = new DateTime("today");

?>

<table>

    <tbody>

        <tr>

            <?php 

            foreach(new DatePeriod($dateInitWeek,$intervalInitWeek,$endInitWeek) as $jour){

                 if($jour->format("w")==0){

                    echo "<th class=\"dimanche\">",$formatter_semaine->format($jour),"</th>";

                }else{

                    echo "<th>",$formatter_semaine->format($jour),"</th>";

                }

                

            }?>

        </tr>


<?php


$lastDay->modify("+1 day");//c'est une astuce pour utiliser DatePeriod 

//qui ne sait pas prendre en compte le dernier jour si on ne fait pas ça

$intervale_iteration = new DateInterval("P1DT0S");

$iterateur = new DatePeriod($firstDay,$intervale_iteration,$lastDay);

$i = 0;

foreach($iterateur as $jour){

    if($i == 0){

        echo "<tr>";

    }

    if($jour == $aujourdhui){

                    echo "<td id=\"today\">",$jour->format("d"),"</td>";

                }else if($jour->format("w")==0){

                    echo "<td class=\"dimanche\">",$jour->format("d"),"</td>";

                }else{

                    echo "<td>",$jour->format("d"),"</td>";

                }

    $i++;

    $i %=7;

    if($i == 0){

        echo "<tr/>";

    }

}*/

?>
                                                </div>
                                                /.panel-body 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="suivi">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>
                                            --------------
                                             Suivi des heures
                                            --------------
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
 -->                        <!-- /.panel-body --> 
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-md-8 col-md-offset-2 -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.section -->
</div>