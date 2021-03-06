 <?php
function afficher_date($ma_date ){
    $mate_str_replace = str_replace("/","-",$ma_date );
    $liste_mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
    $matefr_j_mois = date("d",strtotime($mate_str_replace))." ".$liste_mois[date("n",strtotime($mate_str_replace))] ; 
                                            
    $mate = date('Y-m-d',strtotime($mate_str_replace));
    $mate_aujourdhui = date('Y-m-d');
    $mate_hier = date('Y-m-d', strtotime(date('Y-m-d').' - 1 DAY'));
    if ( $mate  == $mate_aujourdhui )
        echo  date("H\hi", strtotime($mate_str_replace));//on met que heure et munite pour aujourd'hui
    else
        if ( $mate  >= $mate_hier)
            echo "Hier à " . date('H\hi', strtotime($mate_str_replace ) );
        else
            echo date('d/m/Y',strtotime($mate_str_replace));            
}
?>
 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion d'inventaires</h2>
                <p class="sub-title">Gestion des Fournisseurs</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-stocks.html">Gestion de stock</a> </li>
                    <li><a href="/admin/materiels/index">Gestion d'inventaires</a> </li>
                    
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/fournisseurs/ajouter"><i class="fa fa-plus"></i><span>Ajouter</span></a>
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
                                        <?php echo $form->create('Fournisseur',array('action'=>'rechercher') ) ; ?>
                                            Rechercher: <?php echo $form->input('query',array('class'=>'form-control input-sm','onclick'=>"this.value=''",'label'=>false,'div'=>false) ) ; ?>
                                               
                                            <button class="btn btn-default icon-only" type="submit">

                                                <span><i class="fa fa-search"></i></span>
                                            </button><br><br>
                                              <?php echo $form->create('Fournisseur',array('action'=>'rechercher') ) ; ?>
                                            Rechercher par date : du <div id="datetimepicker9" class="input-group date">
                            <?php echo $form->input('Indemnite.date_debut',array(
                                      'label'=>false,
                                                              'type'=>"text",
                                              'class'=>'form-control date_picker',
                                                              'div'=>false) ) ; ?>
                                                                                                <span class="input-group-addon" style="">
                                            <span class="fa fa-calendar"> </span>
                                        </span>
                                    </div>
                                    <span> au </span>
                                    <div id="datetimepicker9" class="input-group date">
                                        <?php echo $form->input('Indemnite.date_debut',array(
                                                                                            'label'=>false,
                                                                                            'type'=>"text",
                                                                                            'class'=>'form-control date_picker',
                                                                                            'div'=>false) ) ; ?>
                                                                                                <span class="input-group-addon" style="">
                                            <span class="fa fa-calendar"> </span>
                                        </span>
                                    </div>

            &nbsp;
                                            <button class="btn btn-default icon-only" type="submit">
                                                <span><i class="fa fa-search"></i></span>
                                            </button>
                                            




                                        <?php echo $form->end() ; ?>

                                        

                                     
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if(!empty($fournisseurs) ) : ?>
                                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                  
                                   <th><?php echo $this->Paginator->sort('Nom de Fournisseur', 'Fournisseur.nom'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                   
                                   <th><?php echo $this->Paginator->sort('identifiant fiscal', 'Fournisseur.identifiant_fiscal'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                   <th><?php echo $this->Paginator->sort(' Siege Social', 'Fournisseur.siege_social'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                    <th><?php echo $this->Paginator->sort('patente', 'Fournisseur.patente'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                
                                               
                                                <!-- <th><?php //echo $this->Paginator->sort('Emplacement', 'Emplacement.code'); ?>&nbsp;<i class="fa fa-sort"></i></th> -->
                                               
                                                <th class="ecomm-action-icon">Action</th>
                                            </tr>
                                            </thead> 
                                            <tbody>
                                                <?php foreach($fournisseurs as $m ) : ?>
                                                    <tr>
                                                    
                                                        <td><?php echo $m['Fournisseur']['nom'] ; ?></td>
                                                        <td><?php echo $m['Fournisseur']['identifiant_fiscal'] ; ?></td>
                                                        <td><?php echo $m['Fournisseur']['siege_social'] ; ?></td>
                                                        <td><?php echo $m['Fournisseur']['patente'] ; ?></td>
                                                        
                                                        
                                                        
                                                        <!-- <td><?php // echo $m['Emplacement']['code'] ; ?></td> -->
 
                                                        <!-- status -->
                                                  

                                                        <td>
                                                            <a href="/admin/fournisseurs/afficher/<?php echo $m['Fournisseur']['id'] ; ?>" title ="Afficher"> 
                                                                <button class="btn btn-default icon-only" type="button">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a>
                                                            <a href="/admin/fournisseurs/modifier/<?php echo $m['Fournisseur']['id'] ; ?>" title ="Modifier"><button class="btn btn-default icon-only" type="button">
                                                                <i class="fa fa-edit"></i>
                                                            </button></a>
                                                            <a href="/admin/fournisseurs/supprimer/<?php echo $m['Fournisseur']['id'] ; ?>" class="ask" title ="Supprimer"><button class="btn btn-default icon-only" type="button">
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
                                                Aucun fournisseur n'a été trouvé !
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