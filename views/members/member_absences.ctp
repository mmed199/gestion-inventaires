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
                <h2 class="title">Gestion des absences</h2>
                <p class="sub-title">La gestion des absences et des congés des collaborateurs.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/gestion-rh.html">Gestion RH</a> </li>
                    <li class="active">Gestion des absences</li>
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <a href="/add-absences.html"><i class="fa fa-plus"></i><span>Ajouter</span></a>
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
                                <h5>Liste des demandes</h5>

                            </div>
                        </div>
                        <?php echo $session->flash() ; ?>                        
                        <div class="panel-body p-20 overflow-x-auto">
                            <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="example_filter" class="dataTables_filter">
                                            <label>
                                                Rechercher: <input class="form-control input-sm" type="search" placeholder="" aria-controls="example">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $this->Paginator->sort('Id', 'Member.id'); ?></th>
                                                    <th><?php echo $this->Paginator->sort('Nom & prénom', 'Member.nom'); ?></th>
                                                    <th><?php echo $this->Paginator->sort('Type d\'absence', 'Typeabsence.title'); ?></th>
                                                    <th><?php echo $this->Paginator->sort('Date de demandes', 'Absence.created'); ?></th>
                                                    <th><?php echo $this->Paginator->sort('Status', 'Absence.status'); ?></th>
                                                    <th class="ecomm-action-icon">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($absences as $a ) : ?>
                                                    <tr>
                                                        <td><?php echo $a['Member']['id'] ; ?></td>
                                                        <td><?php echo $a['Member']['nom'] ; ?>&nbsp;&nbsp;<?php echo $a['Member']['prenom'] ; ?></td>
                                                        <td><?php echo $a['Typeabsence']['title'] ; ?></td>
                                                        <td><?php echo afficher_date($a['Absence']['created']) ; ?></td>
                                                        <td>
                                                            <span class="label label-info label-wide"><?php echo $a['Absence']['status'] ; ?></span>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-default icon-only" type="button">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                            <button class="btn btn-default icon-only" type="button">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-default icon-only" type="button">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ; ?>                                               
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="example_paginate" class="dataTables_paginate paging_simple_numbers">
                                            <ul class="pagination">
                                                <li id="example_previous" class="paginate_button previous disabled">
                                                    <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0">Précédent</a>
                                                </li>
                                                <li class="paginate_button active">
                                                    <a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">1</a>
                                                </li>
                                                <li class="paginate_button ">
                                                    <a href="#" aria-controls="example" data-dt-idx="2" tabindex="0">2</a>
                                                </li>
                                                <li id="example_next" class="paginate_button next">
                                                    <a href="#" aria-controls="example" data-dt-idx="3" tabindex="0">Suivant</a>
                                                </li>
                                            </ul>
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