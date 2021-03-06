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
                <h2 class="title">Gestion inventaires</h2>
                <p class="sub-title">Gestion des Materiels</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-stocks.html">Gestion de stock</a> </li>
                    <li><a href="/admin/materiels/index">Gestion d'inventaires</a> </li>
                    <li class="active">Materiels</li>
                    
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/materiels/ajouter"><i class="fa fa-plus"></i><span>Ajouter un materiel</span></a>
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
                                        <?php echo $form->create('Materiel',array('action'=>'rechercher') ) ; ?>
                                           
                                             
                                            Rechercher: <?php echo $form->input('query',array('class'=>'form-control input-sm','onclick'=>"this.value=''",'label'=>false,'div'=>false) ) ; ?>
                                                
                                            
                                            Type Materiel :
                                            <?php echo $form->input('type',array('type' => 'select',
                                                                                   'options' =>$types, 
                                                                                   'empty' =>'-----------', 
                                                                                   'class'=>"js-states form-control",
                                                                                   'div'=>false,
                                                                                   'label' =>false));?>
                                               
                                            <button class="btn btn-default icon-only" type="submit">

                                                <span><i class="fa fa-search"></i></span>
                                            </button><br><br>
                                           
                                                                                            
                                    </div>
                                   
                                  

            &nbsp;
                                          
                                            




                                        <?php echo $form->end() ; ?>

                                        

                                     
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if(!empty($materiels) ) : ?>
                                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                             
                                                <th><?php echo $this->Paginator->sort('Nom du Materiel', 'Materiel.nom'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <th><?php echo $this->Paginator->sort('Date achat', 'Materiel.created'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <!-- <th><?php //echo $this->Paginator->sort('Emplacement', 'Emplacement.code'); ?>&nbsp;<i class="fa fa-sort"></i></th> -->
                                      

                                    <th><?php echo $this->Paginator->sort('Type Materiel', 'Typemateriel.tilte'); ?>&nbsp;<i class="fa fa-sort"></i></th>    

                                     <th><?php echo $this->Paginator->sort('Fournisseur', 'Fournisseur.nom'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                       <th><?php echo $this->Paginator->sort('Emplacement', 'Emplacement.code'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                     <th><?php echo $this->Paginator->sort('Status', 'Materiel.status'); ?>&nbsp;<i class="fa fa-sort"></i></th>
                                                <th class="ecomm-action-icon">Action</th>
                                            </tr>
                                            </thead> 
                                            <tbody>
                                                <?php foreach($materiels as $m ) : ?>
                                                    <tr>
                                                       
                                                     
                                                        <td><?php echo $m['Materiel']['nom'] ; ?></td>
                                                        <td><?php echo afficher_date($m['Materiel']['created']) ; ?></td>
                                                       
 
                                                        <!-- status -->
                                                       <td><?php  echo $m['Typemateriel']['title']; ?></td> 
                                                       <td><?php  echo $m['Fournisseur']['nom'] ; ?></td> 
                                                        <td><?php  echo $m['Emplacement']['code'] ; ?></td> 
                                                        <td>
                                                            <?php echo ($m['Materiel']['status'] == 0 ?"<span class='label label-warning label-wide'> Au stock </span>"  : "<span class='label label-success label-wide'> En fonction </span>" ); ?>
                                                        </td>

                                                        <td>
                                                            <a href="/admin/materiels/afficher/<?php echo $m['Materiel']['id'] ; ?>" title ="Afficher"> 
                                                                <button class="btn btn-default icon-only" type="button">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a>
                                                            <a href="/admin/materiels/modifier/<?php echo $m['Materiel']['id'] ; ?>" title ="Modifier"><button class="btn btn-default icon-only" type="button">
                                                                <i class="fa fa-edit"></i>
                                                            </button></a>
                                                            <a href="/admin/materiels/supprimer/<?php echo $m['Materiel']['id'] ; ?>" class="ask" title ="Supprimer"><button class="btn btn-default icon-only" type="button">
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
                                                Aucun matériel n'a été trouvé !
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