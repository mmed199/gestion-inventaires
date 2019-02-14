 <?php
function afficher_date($ma_date ){
    $pate_str_replace = str_replace("/","-",$ma_date );
    $liste_mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
    $patefr_j_mois = date("d",strtotime($pate_str_replace))." ".$liste_mois[date("n",strtotime($pate_str_replace))] ; 
                                            
    $pate = date('Y-m-d',strtotime($pate_str_replace));
    $pate_aujourdhui = date('Y-m-d');
    $pate_hier = date('Y-m-d', strtotime(date('Y-m-d').' - 1 DAY'));
    if ( $pate  == $pate_aujourdhui )
        echo  date("H\hi", strtotime($pate_str_replace));//on met que heure et munite pour aujourd'hui
    else
        if ( $pate  >= $pate_hier)
            echo "Hier à " . date('H\hi', strtotime($pate_str_replace ) );
        else
            echo date('d/m/Y',strtotime($pate_str_replace));            
}
?>
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
                    <li class="active">Gestion des projets</li>
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/projets/ajouter"><i class="fa fa-plus"></i><span>Ajouter un Projet</span></a>
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
                        <div class="panel-body p-30 overflow-x-auto">
                            <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row"> 
                                    <div class="col-sm-3">
                                        <?php echo $form->create('Projet',array('action'=>'rechercher') ) ; ?>
                                        Rechercher: <?php echo $form->input('query',array('class'=>'form-control input-sm',
                                                                                          'onclick'=>"this.value=''",
                                                                                          'label'=>false,
                                                                                          'div'=>false) ) ; ?>
                                    </div> 
                                    <div> 
                                    <div class="col-sm-3">
                                             date du <div id="datetimepicker9" class="input-group date">
                                                    <?php echo $form->input('date_debut',array(
                                                                                           'label'=>false,
                                                                                           'type'=>"text",
                                                                                           'class'=>'form-control date_picker',
                                                                                           'div'=>false) ) ; ?>
                                                    <span class="input-group-addon" style="">
                                                        <span class="fa fa-calendar"> </span>
                                                    </span>
                                                </div> 
                                                </div> 
                                    </div>
                                    <div class="col-sm-3">  
                                                <span> au </span>
                                                <div id="datetimepicker2" class="input-group date">
                                                    <?php echo $form->input('date_fin',array(
                                                                                          'label'=>false,
                                                                                          'type'=>"text",
                                                                                          'class'=>'form-control date_picker',
                                                                                          'div'=>false) ) ?>
                 
                                                    <span class="input-group-addon" style="">
                                                        <span class="fa fa-calendar"> </span>
                                                    </span>
                                                </div> 
                                    </div>
                                    <div class="col-sm-1"> 
                                        <span> &nbsp; </span> 
                                        <div>
                                            <button class="btn btn-default icon-only" type="submit">
                                                <span><i class="fa fa-search"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php echo $form->end() ; ?> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if(!empty($projets) ) : ?>
                                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th><?php echo $this->Paginator->sort('Id', 'Projet.id'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <th><?php echo $this->Paginator->sort('Nom du projet', 'Projet.nom'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <th><?php echo $this->Paginator->sort('Date de création', 'Projet.created'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <th><?php echo $this->Paginator->sort('Nombre d\'équipe', 'Projet.nbr_equipe'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <th><?php echo $this->Paginator->sort('Status', 'Projet.status'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <th class="ecomm-action-icon">Action</th>
                                            </tr>
                                            </thead> 
                                            <tbody>
                                                <?php foreach($projets as $p ) : ?>
                                                    <tr>
                                                        <td><?php echo $p['Projet']['id'] ; ?></td>
                                                        <td><?php echo $p['Projet']['nom'] ; ?></td>
                                                        <td><?php echo afficher_date($p['Projet']['created']) ; ?></td>
                                                        <td><?php echo $p['Projet']['nbr_equipe'] ; ?></td>
 
                                                        <!-- décision -->
                                                        <td>
                                                            <?php echo ($p['Projet']['status'] == 0 ?"<span class='label label-warning label-wide'> En cours </span>"  : "<span class='label label-success label-wide'> Terminé </span>" ); ?>
                                                        </td>

                                                        <td>
                                                            <a href="/admin/projets/afficher/<?php echo $p['Projet']['id'] ; ?>" title ="Afficher"> 
                                                                <button class="btn btn-default icon-only" type="button">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a>
                                                            <?php if($p['Projet']['status']==0) { ?>
                                                            <a href="/admin/projets/modifier/<?php echo $p['Projet']['id'] ; ?>" title ="Modifier"><button class="btn btn-default icon-only" type="button">
                                                                <i class="fa fa-edit"></i>
                                                            </button></a>
                                                            <a href="/admin/projets/supprimer/<?php echo $p['Projet']['id'] ; ?>" class="ask" title ="Supprimer"><button class="btn btn-default icon-only" type="button" >
                                                                <i class="fa fa-trash-o"></i>
                                                            </button></a>
                                                             <?php } else { ?>
                                                                <a href="#" title ="Modifier">
                                                                    <button class="btn btn-default icon-only" type="button" disabled><i class="fa fa-edit"></i></button>
                                                                </a>
                                                                <a href="#" title ="Supprimer">
                                                                    <button class="btn btn-default icon-only" type="button" disabled><i class="fa fa-trash-o"></i></button>
                                                                </a>
                                                            <?php } ?> 
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