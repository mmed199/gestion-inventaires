<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des depenses</h2>
                <p class="sub-title">La gestion des depenses pour les utlisateurs.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/admin/depenses/index">Gestion des depenses</a> </li>
                    
                    
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/indemnites/ajouter"><i class="fa fa-plus"></i><span>Ajouter une indemnité</span></a>
            </div>
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
                                <h5><?php echo  $page_title  ; ?> du <?php echo strftime( "%d/%m/%Y" , strtotime($depense['Depense']['created'])) ; ?></h5>
                            </div> 
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 mt-15">
                               <strong>Référence: </strong> <?php echo  $depense['Depense']['id']  ; ?><br>
                               <strong>Objet: </strong> <?php echo  $depense['Depense']['objet']  ; ?><br>
                               <strong>Loi de finance: </strong> <?php echo  $depense['Depense']['loi_finance']  ; ?><br>
                               <strong>Nomre de bénéficiares: </strong> <?php echo  $depense['Depense']['nbr_benef']  ; ?><br>
                               <strong>Signé par: </strong> <?php echo  ucfirst($depense['Signataire']['nom'])  ; ?> <?php echo  ucfirst($depense['Signataire']['prenom'] ) ; ?>
                               <strong>Le : </strong> <?php echo strftime( "%d/%m/%Y" , strtotime($depense['Depense']['date_signature'])) ; ?><br>
                              <!-- status -->
                                                            
                                <div class="panel-body">
                                    <a href="/admin/depenses/telecharger/<?php echo $depense['Depense']['id']  ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" style = "margin-left: 10px;" type="button">
                                            <span class="btn-label"><i class="fa fa-print"></i></span>Télécharger
                                        </button>
                                    </a>
                                    <a href="/admin/depenses/modifier/<?php echo $depense['Depense']['id']  ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" type="button">
                                            <span class="btn-label"><i class="fa fa-edit"></i></span>Modifier
                                        </button>
                                    </a>
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