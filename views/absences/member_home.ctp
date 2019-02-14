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
                                                    <th>Nom & prénom</th>
                                                    <th>Type</th>
                                                    <th>Date de demandes</th>
                                                    <th>remplacé par</th>
                                                    <th>Status</th>
                                                    <th class="ecomm-action-icon">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Lhiadi Redouane</td>
                                                    <td>Demande de congé</td>
                                                    <td>02/03/2018</td>
                                                    <td>aucun</td>
                                                    <td>
                                                        <span class="label label-info label-wide">Visé</span>
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
                                                <tr>
                                                    <td>12</td>
                                                    <td>Lhiadi Redouane</td>
                                                    <td>Demande de congé</td>
                                                    <td>02/03/2018</td>
                                                    <td>aucun</td>
                                                    <td>
                                                        <span class="label label-info label-wide">Visé</span>
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
                                                <tr>
                                                    <td>12</td>
                                                    <td>Lhiadi Redouane</td>
                                                    <td>Demande de congé</td>
                                                    <td>02/03/2018</td>
                                                    <td>aucun</td>
                                                    <td>
                                                        <span class="label label-info label-wide">Visé</span>
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