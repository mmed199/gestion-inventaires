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
            <div class="col-md-6">
                <h4 class="title">Mon profil: <small class="ml-10"><?php echo ucfirst ($session->read('Auth.Member.nom'));  ?> <?php echo ucfirst($session->read('Auth.Member.prenom'));  ?></small></h4>
                <p class="sub-title">La gestion des paramètres et les informations générales de votre profil</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
					<li><a href="/"><i class="fa fa-home"></i> Accueil</a></li>
					<li class="active">Mon profil</li>
				</ul>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6 text-right">
                <a href="/member/members/editProfil" class="pl-20"><i class="fa fa-cog"></i> Modifier mon profil</a>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->  

        <div class="row mt-30">
        <?php echo $session->flash() ; ?>
            <div class="col-md-3">
                <div class="panel border-primary no-border border-3-top">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <img src="<?php echo '/uploads/members/'.$member['Member']['logo'] ; ?>" alt="<?php echo $session->read('Auth.Member.nom');  ?> <?php echo $session->read('Auth.Member.prenom');  ?>" class="img-circle profile-img" style = "height: 140px; width: 140px; ">
                                <div class="text-center">
                                   <a href="/member/members/edit_photo" class="btn btn-primary btn-xs btn-labeled mt-10">
                                        Modifier l'image<span class="btn-label btn-label-right"><i class="fa fa-pencil"></i></span>
                                   </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel -->

                <div class="panel border-primary no-border border-3-top">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5>Statistiques de l'utilisateur</h5>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <table class="table table-striped">
                            	<tbody>
                                    <tr>
                                        <th>Projets</th>
                                        <td><small class="color-success"><?php echo $nbr_projet ; ?></small></td>
                                    </tr>
                                    <tr>
                                        <th>Tâchs</th>
                                        <td><small class="color-success"><?php echo $nbr_tache ; ?></small></td>
                                    </tr>
                            		<tr>
                            			<th>Messages</th>
                            			<td><small class="color-success">23</small></td>
                            		</tr>
                            		<tr>
                                        <th>Dernière connexion</th>
                            			<td><?php echo date('d/m/Y',strtotime($member['Member']['d_d_con'])); ?><br>
                                            <small class="color-warning"><?php echo afficher_date($member['Member']['d_d_con']) ; ?></small>
                                        </td>
                            		</tr>
                            	</tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.panel -->

                <div class="panel border-primary no-border border-3-top">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5>Status de l'utilisateur</h5>
                        </div>
                    </div>
                    <div class="panel-body p-20">
                        <span class="label label-success label-rounded label-bordered">Active</span>
                        <span class="label label-warning label-rounded label-bordered">Non active actuellement</span>
                    </div>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-3 -->

            <div class="col-md-9">
                <ul class="nav nav-tabs nav-justified" role="tablist">
            		<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
            		<li role="presentation"><a href="#experience" aria-controls="experience" role="tab" data-toggle="tab">Expérience professionnelle</a></li>
            		<li role="presentation"><a href="#poste" aria-controls="poste" role="tab" data-toggle="tab">Poste actuel</a></li>
            		<li role="presentation"><a href="#adresses" aria-controls="adresses" role="tab" data-toggle="tab">Adresses</a></li>
            	</ul>
                <div class="tab-content bg-white p-15">
            		<div role="tabpanel" class="tab-pane active" id="description">
            		    <p>
                            <?php echo $member['Member']['description']; ?>      
                        </p>

                        <div id="carousel-example-generic" class="carousel slide mt-20" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>                            
                        </div>
            		</div>
            		<div role="tabpanel" class="tab-pane" id="experience">
            		    <p>
                            <?php echo $member['Member']['experiences']; ?>       
                        </p>
            		</div>
            		<div role="tabpanel" class="tab-pane" id="poste">
            		   <?php echo $member['Member']['poste_actuel']; ?>  
            		</div>
            		<div role="tabpanel" class="tab-pane" id="adresses">
            		     <p>
                            <strong> Numéro de téléphone fix: </strong><?php echo $member['Member']['telephone']; ?>  <br>
                            <strong> GSM: </strong><?php echo $member['Member']['mobile']; ?>  <br>
                            <strong> Adresse E-mail: </strong><?php echo $member['Member']['email']; ?>  <br>
                            <strong> Adresse: </strong><?php echo $member['Member']['adresse']; ?> <?php echo $member['Member']['adresse_suite']; ?> 
                         </p>
            		</div>
                    <!-- /.section-title -->
            	</div>
            </div>
            <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


</div>
<!-- /.main-page -->