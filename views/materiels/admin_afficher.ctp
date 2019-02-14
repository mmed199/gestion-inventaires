 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion d'inventaires</h2>
                <p class="sub-title">Affichage des Materiels.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-activites.html">Gestion des stock</a> </li>
                    <li><a href="/admin/projets/index">Gestion d'inventaires'</a> </li>
                    <li class="active">Détails Materiels</li>
                </ul>
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
                                <h5><?php echo  $page_title  ; ?></h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 mt-15">
                               <strong>Référence: </strong> <?php echo  $materiel['Materiel']['id']  ; ?><br>
                              <strong>Nom: </strong> <?php echo  $materiel['Materiel']['nom']  ; ?><br>
                              <strong>date_achat: </strong> <?php echo  $materiel['Materiel']['date_achat']  ; ?><br>
                               <strong>description: </strong> <?php echo $materiel['Materiel']['description']  ; ?><br>
                               <strong>Fournisseur:</strong> <?php echo $materiel['Fournisseur']['nom']  ; ?><br>
                             <strong>Type Materiel:</strong> <?php echo $materiel['Typemateriel']['title']  ; ?><br>
               <strong>Emplacement:</strong> <?php echo $materiel['Emplacement']['code']  ; ?><br>
                 <strong>Type Achat:</strong> <?php echo $materiel['Typeachat']['title']  ; ?><br>
                                    <div class="panel-body">
                                   
                                    <a href="/admin/materiels/modifier/<?php echo  $materiel['Materiel']['id'] ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" type="button">
                                            <span class="btn-label"><i class="fa fa-edit"></i></span>Modifier
                                        </button>
                                    </a>&nbsp; &nbsp;
                                    <a href="/admin/materiels">
                                        <button class="btn btn-default btn-labeled pull-right" type="button">
                                            <span class="btn-label"><i class="fa fa-edit"></i></span>Retour
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