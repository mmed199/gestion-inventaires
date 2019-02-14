 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion d'inventaires</h2>
                <p class="sub-title">Affichage de Fournisseur.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin/"><i class="fa fa-home"></i>Accueil</a> </li>                    
                    <li><a href="/admin/gestion-activites.html">Gestion des activités</a> </li>
                    <li><a href="/admin/projets/index">Gestion des projets</a> </li>
                    <li class="active">Détail de projet</li>
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
                               <strong>Référence: </strong> <?php echo  $fournisseur['Fournisseur']['id']  ; ?><br>
                              <strong>Nom: </strong> <?php echo  $fournisseur['Fournisseur']['nom']  ; ?><br>
                              <strong>Registre Commerce: </strong> <?php echo  $fournisseur['Fournisseur']['registre_commerce']  ; ?><br>
                               <strong>identifiant fiscal: </strong> <?php echo  $fournisseur['Fournisseur']['identifiant_fiscal']  ; ?><br>
                               <strong>Siege Social:</strong> <?php echo  $fournisseur['Fournisseur']['siege_social'] ; ?><br>
                               <strong>patente: </strong> <?php echo  $fournisseur['Fournisseur']['patente']  ; ?><br>
                               <strong>Télephone: </strong> <?php echo  $fournisseur['Fournisseur']['tel']  ; ?><br>
                               <strong>email: </strong> <?php echo  $fournisseur['Fournisseur']['email']  ; ?><br>
                               <strong>cnss: </strong> <?php echo  $fournisseur['Fournisseur']['cnss']  ; ?><br>
                               <strong>Description: </strong> <?php echo  $fournisseur['Fournisseur']['description']  ; ?><br>
                              
              
                                    <div class="panel-body">
                                   
                                    <a href="/admin/fournisseurs/modifier/<?php echo $fournisseur['Fournisseur']['id']  ; ?>">
                                        <button class="btn btn-default btn-labeled pull-right" type="button">
                                            <span class="btn-label"><i class="fa fa-edit"></i></span>Modifier
                                        </button>
                                    </a>&nbsp; &nbsp;
                                    <a href="/admin/fournisseurs">
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