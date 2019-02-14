 <?php
function afficher_date($ma_date ){
    $date_str_replace = str_replace("/","-",$ma_date );
    $liste_mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
    $datefr_j_mois = date("d",strtotime($date_str_replace))." ".$liste_mois[date("n",strtotime($date_str_replace))] ; 
                                            
    $date = date('Y-m-d',strtotime($date_str_replace));
    $date_aujourdhui = date('Y-m-d');
    $date_hier = date('Y-m-d', strtotime(date('Y-m-d').' - 1 DAY'));
    if ( $date  == $date_aujourdhui )
        echo  date("H\hi", strtotime($date_str_replace));//on met que heure et munite pour aujourd'hui
    else
        if ( $date  >= $date_hier)
            echo "Hier à " . date('H\hi', strtotime($date_str_replace ) );
        else
            echo date('d/m/Y',strtotime($date_str_replace));            
}
?>
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
                    <li><a href="/admin/indemnites/index">Gestion des indemnités</a> </li>
                    <li class="active">Gestion des indemnités</li>
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/indemnites/ajouter"><i class="fa fa-plus"></i><span>Ajouter</span></a>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section"> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5><?php echo $balise_h5 ; ?></h5>
                            </div>
                        </div>
                        <?php echo $session->flash() ; ?>                        
                        <div class="panel-body p-20 overflow-x-auto">
                            <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row"> 
                                    <div class="col-sm-12">
                                        <div id="example_filter" class="dataTables_filter"> 
                                        <?php echo $form->create('Absence',array('action'=>'rechercher') ) ; ?>
                                            Rechercher: <?php echo $form->input('query',array('class'=>'form-control input-sm','onclick'=>"this.value=''",'label'=>false,'div'=>false) ) ; ?>
                                               
                                            <button class="btn btn-default icon-only" type="submit">
                                                <span><i class="fa fa-search"></i></span>
                                            </button>
                                        <?php echo $form->end() ; ?>
                                        <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if(!empty($indemnites) ) : ?>
                                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $this->Paginator->sort('Id', 'Absence.id'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                    <th><?php echo $this->Paginator->sort('Nom & Prénom', 'Member.nom'); ?>&nbsp;<i class="fa fa-sort"></th>
                                                    <th><?php echo $this->Paginator->sort('Année', 'Annee.titre'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                    <th><?php echo $this->Paginator->sort('Durée', 'Absence.duree'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                    <th><?php echo $this->Paginator->sort('Date de l\'indemnité', 'Absence.created'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                    <th><?php echo $this->Paginator->sort('Décision', 'Absence.decision'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                    <th class="ecomm-action-icon">Action</th>
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                <?php foreach($indemnites as $i ) : ?>
                                                    <tr>
                                                        <td><?php echo $i['Absence']['id'] ; ?></td>
                                                        <td><?php echo $i['Member']['nom'] ; ?> <?php echo $i['Member']['prenom'] ; ?></td>
                                                        <td><?php echo $i['Annee']['titre'] ; ?></td>
                                                        <td><?php echo $i['Absence']['duree'] ; ?></td>
                                                        <td><?php echo afficher_date($i['Absence']['created']) ; ?></td>

                                                        <!-- décision -->
                                                         <?php if($i['Absence']['decision']==3) {?>
                                                        <td>
                                                            <span class='label label-danger label-wide'> Refusée </span>
                                                        </td>
                                                        <?php }else if ($i['Absence']['decision']==2) { ?>
                                                        <td>
                                                            <span class='label label-warning label-wide'> Accord Partiel </span>
                                                        </td>  
                                                        <?php }else if ($i['Absence']['decision']==1) { ?>
                                                        <td>
                                                            <span class='label label-success label-wide'> Accordée </span>
                                                        </td> 
                                                        <?php } else { ?>
                                                        <td>
                                                            <span class='label label-default label-wide'> En cours de traitement </span>
                                                        </td>
                                                        <?php } ?> 
                                                        <td>
                                                            <a href="/admin/indemnites/afficher/<?php echo $i['Absence']['id'] ; ?>" title ="Afficher"> 
                                                                <button class="btn btn-default icon-only" type="button">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a>
                                                            <!-- 
                                                            <button class="btn btn-danger btn-labeled" type="button">
                                                                Annuller
                                                                <span class="btn-label btn-label-right">
                                                                    <i class="fa fa-check"></i>
                                                                </span>
                                                            </button> -->
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
                                                Aucune demande n'a été trouvée !
                                            </div>
                                        <?php endif ; ?>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="example_paginate" class="dataTables_paginate paging_simple_numbers">
                                            Page : 
                                            <?php echo $this->Paginator->counter(array( 'format' =>'<strong> %page% </strong> / %pages% ')) ; ?>
                                            <?php echo $paginator->numbers(array('separator' => ' - ')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.section -->
</div>