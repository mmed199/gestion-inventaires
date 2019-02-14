<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ClicAdministration - Gestion Administratif - <?php echo (isset($page_title)?$page_title:"Espace Admin") ; ?></title>

        <!-- ========== COMMON STYLES ========== -->
        <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="/css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="../maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="/css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="/css/lobipanel/lobipanel.min.css" media="screen" >

        <!-- ========== PAGE STYLES ========== -->
        <link rel="stylesheet" href="/css/toastr/toastr.min.css" media="screen" >
        <link rel="stylesheet" href="/css/icheck/skins/line/blue.css" >
        <link rel="stylesheet" href="/css/icheck/skins/line/red.css" >
        <link rel="stylesheet" href="/css/icheck/skins/line/green.css" >
        <link rel="stylesheet" href="/_admin/style.css" >
        <link rel="stylesheet" href="/css/bootstrap-tour/bootstrap-tour.css" >

        <!-- ========== Date Picker STYLES ========== -->
        <link rel="stylesheet" type="text/css" href="/css/date-picker/jquery.timepicker.css" />
        <link rel="stylesheet" type="text/css" href="/css/date-picker/bootstrap-datepicker.css" />

        <!-- ========== THEME CSS ========== -->
        <link rel="stylesheet" href="/css/main.css" media="screen" >

        <!-- ========== MODERNIZR ========== -->
        <script src="/js/modernizr/modernizr.min.js"></script>
        <script src="/js/ckeditor/ckeditor.js"></script>
    </head>
    <body class="top-navbar-fixed pace-done">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <nav class="navbar top-navbar bg-white box-shadow">
            	<div class="container-fluid">
                    <div class="row">
                        <div class="navbar-header no-padding">
                			<a class="navbar-brand" href="/admin">
                			    <img src="/images/logo.png" alt="ClicAdministration" class="logo">
                			</a>
                            <span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-outdent"></i></span>
                			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                				<span class="sr-only">Menu</span>
                				<i class="fa fa-ellipsis-v"></i>
                			</button>
                            <button type="button" class="navbar-toggle mobile-nav-toggle" >
                				<i class="fa fa-bars"></i>
                			</button>
                		</div>
                        <!-- /.navbar-header -->

                		<div class="collapse navbar-collapse" id="navbar-collapse-1">
                			<ul class="nav navbar-nav" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li class="hidden-sm hidden-xs"><a href="#" class="user-info-handle"><i class="fa fa-user"></i></a></li>
                                <li class="hidden-sm hidden-xs"><a href="#" class="full-screen-handle"><i class="fa fa-arrows-alt"></i></a></li>
                                <li class="hidden-sm hidden-xs"><a href="#"><i class="fa fa-search"></i></a></li>
                				<li class="hidden-xs hidden-xs"><a href="#">Mes tâches</a></li>
                			</ul>
                            <!-- /.nav navbar-nav -->

                			<ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <!-- <li class="dropdown">
                                                					<a href="#" class="dropdown-toggle bg-primary tour-one" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus-circle"></i> Anjouter <span class="caret"></span></a>
                                                					<ul class="dropdown-menu" >
                                                						<li><a href="#"><i class="fa fa-plus-square-o"></i> Customer</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square-o"></i> Employee</a></li>
                                                						<li><a href="#"><i class="fa fa-plus-square-o"></i> Estimate</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square-o"></i> Task</a></li>
                                                						<li><a href="#"><i class="fa fa-plus-square-o"></i> Team User</a></li>
                                                						<li role="separator" class="divider"></li>
                                                						<li><a href="#">Create Order</a></li>
                                                						<li role="separator" class="divider"></li>
                                                						<li><a href="#">Generate Report</a></li>
                                                					</ul>
                                                				</li> --> 
                                <!-- /.dropdown -->
                                <li><a href="#" class=""><i class="fa fa-bell"></i><span class="badge badge-danger">6</span></a></li>
                				<li><a href="#" class=""><i class="fa fa-comments"></i><span class="badge badge-warning">2</span></a></li>
                				<li class="dropdown tour-two">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $session->read('Auth.User.nom');  ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu profile-dropdown">
                                        <li class="profile-menu bg-gray">
                                            <div class="">
                                                <img src="http://placehold.it/60/c2c2c2?text=User" alt="<?php echo $session->read('Auth.User.nom');  ?>" class="img-circle profile-img">
                                                <div class="profile-name">
                                                    <h6><?php echo ucfirst($session->read('Auth.User.nom'));  ?>
                                                    <?php echo ucfirst($session->read('Auth.User.prenom'));  ?></h6>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </li>
                                        <li><a href="/admin/users/index"><i class="fa fa-cog"></i> Détails du compte</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="/admin/deconnection.html" class="color-danger text-center"><i class="fa fa-sign-out"></i> Déconnecter</a></li>
                                    </ul>
                                </li>
                                <!-- /.dropdown -->
                                <li><a href="#" class="hidden-xs hidden-sm open-right-sidebar"><i class="fa fa-ellipsis-v"></i></a></li>
                			</ul>
                            <!-- /.nav navbar-nav navbar-right -->
                		</div>
                		<!-- /.navbar-collapse -->
                    </div>
                    <!-- /.row -->
            	</div>
            	<!-- /.container-fluid -->
            </nav>

            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                    <div class="left-sidebar fixed-sidebar bg-black-300 box-shadow tour-three"> 
                        <div class="sidebar-content">
                            <div class="user-info closed">
                                <img src="http://placehold.it/90/c2c2c2?text=User" alt="<?php echo $session->read('Auth.User.nom');  ?>" class="img-circle profile-img">
                                <h6 class="title"><?php echo $session->read('Auth.User.nom');  ?> <?php echo $session->read('Auth.User.prenom');  ?></h6>
                                <small class="info"><?php echo $session->read('Auth.User.role');  ?></small>
                            </div>
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class=""><a href="/admin"><i class="fa fa-home"></i> <span>Accueil</span></a></li>

                                    <li class="nav-header">
                                        <span class="">Rubriques</span>
                                    </li>
                                    <li class="has-children">
                                        <a href="/admin/gestion-activites.html"><i class="fa fa-line-chart"></i> <span>Gestion activité</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="/admin/dossiers/index"><i class="fa fa-folder"></i> <span>Gestion des dossiers</span></a></li>
                                            <li><a href="/admin/projets/index"><i class="fa fa-check-square-o"></i> <span>Gestion des projets</span></a></li>
                                            <li><a href="/admin/gestion-temps.html"><i class="fa fa-calendar-check-o"></i> <span>Gestion des temps</span></a></li>
                                            <li><a href="/admin/planning.html"><i class="fa fa-bars"></i> <span>Planning</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="/admin/gestion-stocks.html"><i class="fa fa-truck"></i> <span>Gestion de stocks </span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li>
                                                <a href="/admin/vehicules/index"><i class="fa fa-car"></i> <span>Gestion Parc-Auto</span></a>
                                            </li>
                                            <li>
                                                <a href="/admin/materiels/index"><i class="fa fa-barcode"></i> <span>Inventaires</span></a>
                                            </li> 
                                            <li>
                                                <a href="/admin/produits/index"><i class="fa fa-shopping-cart"></i> <span>Catalogue de produits</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="/admin/gestion-rh.html"><i class="fa fa-users"></i> <span>Gestion RH</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="/admin/gestion-absences.html"><i class="fa fa-clock-o"></i> <span>Gestion des absences</span></a></li>
                                            <li><a href="/admin/users/index"><i class="fa fa-user"></i> <span>Gestion de profil</span></a></li>
                                            <li><a href="/admin/depenses/index"><i class="fa fa-credit-card"></i> <span>Gestion des indemnités</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <li class="">
                                            <a href="/admin/ged.html"><i class="fa fa-globe"></i></i> <span>GED</span></a>
                                        </li>
                                    </li>

                                    <li class="nav-header">
                                        <span class="">Gestion interne</span>
                                    </li>
                                    <li class="has-children">
                                        <a href="#"><i class="fa fa-clock-o"></i> <span>Instances</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="#"> <span>A valider</span></a></li>
                                            <li><a href="#"> <span>A transmettre</span></a></li>
                                            <li><a href="#"> <span>A prendre en charge</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#"><i class="fa fa-clock-o"></i> <span>Courrier</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="#"> <span>Départ du courrier</span></a></li>
                                            <li><a href="#"> <span>Arrivée du courrier</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#"><i class="fa fa-cog"></i> <span>Configuration</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="bt-affix.html"><i class="fa fa-line-chart"></i> <span>Gestion activité</span></a></li>
                                            <li><a href="bt-button-dropdown.html"><i class="fa fa-truck"></i> <span>Gestion de stocks</span></a></li>
                                            <li><a href="bt-button-groups.html"><i class="fa fa-users"></i> <span>Gestion RH</span></a></li>
                                            <li><a href="bt-buttons.html"><i class="fa fa-globe"></i> <span>GED</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- /.side-nav -->
                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>
                    <!-- /.left-sidebar -->
                    <?php echo $content_for_layout ; ?>                   
                    <!-- /.main-page -->

                    <div class="right-sidebar bg-white fixed-sidebar">
                        <div class="sidebar-content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>À propos <i class="fa fa-times close-icon"></i></h4>
                                        <p>ClicAdministration est un outil qui dispose de nombreux avantages.</p>
                                        <p>Il permet d’apporter un meilleur service aux utilisateurs. </p>
                                        <p>Il accompagne toute la gestion d’un service en réduisant les tâches administratives. </p>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>
                    <!-- /.right-sidebar -->

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->
        <!-- ========== COMMON JS FILES ========== -->
        <script src="/js/jquery/jquery-2.2.4.min.js"></script>
        <script src="/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="/js/bootstrap/bootstrap.min.js"></script>
        <script src="/js/pace/pace.min.js"></script>
        <script src="/js/lobipanel/lobipanel.min.js"></script>
        <script src="/js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="/js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="/js/main.js"></script>
        
        <script type="text/javascript" src="/_admin/jconfirmaction.jquery.js"></script>
        <script type="text/javascript">
            
            $(document).ready(function() {
                $('.ask').jConfirmAction();     
                
                

            });
            
        </script>
        
        <script>
            $(function(){
                $('input.flat-blue-style').iCheck({
                    checkboxClass: 'icheckbox_flat-blue'
                });
            });
        </script>

        <script src="/js/waypoint/waypoints.min.js"></script>
        <script src="/js/counterUp/jquery.counterup.min.js"></script>
        <script src="/js/amcharts/amcharts.js"></script>
        <script src="/js/amcharts/serial.js"></script>
        <script src="/js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="/js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="/js/amcharts/themes/light.js"></script>
        <script src="/js/toastr/toastr.min.js"></script>
        <script src="/js/icheck/icheck.min.js"></script>
        <script src="/js/bootstrap-tour/bootstrap-tour.js"></script>


        <!-- ========== PAGE JS FILES ========== -->
        <script type="text/javascript" src="/js/date-picker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="/js/date-picker/jquery.timepicker.js"></script>
        <script type="text/javascript" src="/js/date-picker/datepair.js"></script>
        <script type="text/javascript" src="/js/date-picker/moment.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

        <script>
           $('#datetimepicker9 .date_picker').datepicker({
                format: "dd/mm/yyyy",
                language: "fr",
                orientation: "bottom right",
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true
            });
            
        </script>
        <script>
           $('#datetimepicker2 .date_picker').datepicker({
                format: "dd/mm/yyyy",
                language: "fr",
                orientation: "bottom right",
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true
            });
            
        </script>

       
    </body>
</html>
