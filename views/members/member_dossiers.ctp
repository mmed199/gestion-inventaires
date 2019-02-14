 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des dossiers</h2>
                <p class="sub-title">constitue la base du suivi des dossiers</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/gestion-activites.html">Gestion activité</a> </li>
                    <li class="active">Gestion des dossiers</li>
                </ul>
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
                                <h5>Liste de dossiers</h5>

                            </div>
                        </div>                        
                        <div class="panel-body p-20 overflow-x-auto">
                            <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="example_filter" class="dataTables_filter">
                                            <label>
                                                Search: <input class="form-control input-sm" type="search" placeholder="" aria-controls="example">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Titre</th>
                                                    <th>Type</th>
                                                    <th>Date d'ajout</th>
                                                    <th>Suivie par</th>
                                                    <th>Status</th>
                                                    <th class="ecomm-action-icon">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Example de titre</td>
                                                    <td>publication du marché num 01/2018/BP</td>
                                                    <td>02/03/2018</td>
                                                    <td>Lhiadi Redouane</td>
                                                    <td>
                                                        <span class="label label-info label-wide">Publié</span>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-xs btn-labeled">Approver<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                        <button type="button" class="btn btn-danger btn-xs btn-labeled next-btn">Supprimer<span class="btn-label btn-label-right"><i class="fa fa-times"></i></span></button>
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