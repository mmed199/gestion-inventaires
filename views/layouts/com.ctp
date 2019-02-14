<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$nom_site = "Kidsdressing";
?>
<title>Administration | <?php echo $nom_site;?> </title>
<link rel="stylesheet" type="text/css" href="/_admin/style.css" />
<link rel="stylesheet" type="text/css" href="/_admin/admin.css" />
<script type="text/javascript" src="/_admin/clockp.js"></script>
<script type="text/javascript" src="/_admin/clockh.js"></script> 
<script type="text/javascript" src="/js/jQuery.js"></script>
<script type="text/javascript" src="/_admin/ddaccordion.js"></script>
<script type="text/javascript" src="/js/admin.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='/_admin/images/plus.gif' class='statusicon' />", "<img src='/_admin/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
	<script type="text/javascript" src="/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<script type="text/javascript">
		function atachFancybox(){
		$(".ajax").fancybox({
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'ajax',				
			});
		}
		$(document).bind("ajaxComplete", function(){
		   atachFancybox() ;
		 });
		$(document).ready(function() {
			atachFancybox() ;
		});
	</script>

<script type="text/javascript" src="/_admin/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>

<script language="javascript" type="text/javascript" src="/_admin/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="/_admin/niceforms-default.css" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/css/images/favicon.png" type="image/x-icon" />
</head>
<body>
<div id="main_container">

	<div class="header">
    <div class="logo"><a href="/admin/"><img src="/logo_va.png" alt="" title="" border="0" height="50px"/></a></div>
    
    <div class="right_header">Bienvenue <?php echo $session->read('Auth.User.nom');  ?>, <a href="/" target="_blank" >Voir le site</a> 
	| <a href="/admin/messages/" class="messages">(<?php echo $session->read('Auth.User.message_count') ; ?>) Messages</a> <br/>
	| <a href="/admin/users/logout" class="logout">Se déconnecter</a></div>
    <div id="clock_a"></div>
    </div>
    
    <div class="main_content">
    
                    <div class="menu">
                    <ul>
                    <li><a class="_current" href="/admin/">Accueil</a></li>
					<li><a href="#">Commandes<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
							<li><a href="/admin/commandes">Afficher tous</a></li>
							<li><a href="/admin/commandes/notValide">En attente de validation</a></li>
							<li><a href="/admin/commandes/modifieeNonValide">Modifiées en attente de validation</a></li>
							<li><a href="/admin/commandes/validee">Validées</a></li>
                        </li>                  
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
					<li><a href="#">Produits<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
							<li><a href="/admin/produits">Afficher tous</a></li>
							<li><a href="/admin/commandes/notValide">En attente de validation</a></li>
							<li><a href="/admin/commandes/modifieeNonValide">Modifiées en attente de validation</a></li>
							<li><a href="/admin/commandes/validee">Validées</a></li>
                        </li>                  
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <li><a href="#">Messages<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><a href="/admin/messages/recus" title="Liste des messages reçus">Reçus</a></li>
                        <li><a href="/admin/messages/envoyes" title="Liste des messages envoyés">Envoyés</a></li>
                        <li><a href="/admin/messages/nouveau" title="Envoyer un message">Nouveau</a></li>
                        </ul>
						
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
					<li><a href="/admin/users/statistics">Statistiques<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
						<li><a href="/admin/statistics/suivi-conversion">Suivi conversion</a></li>
						<li><a href="/admin/statistics/suivi-panier">Suivi panier</a></li>
						<li><a href="/admin/statistics/graphs">Graphe</a></li>
						</ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
					<li><a href="/admin/clients/">Clients<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><a href="/admin/clients/" title="">Afficher tous</a></li>
                        </li>                  
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <!--<li><a href="#">Gestion de l'aide--><!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                    <!--  <ul>
                        <li><a href="/admin/aides" title="">liste des questions</a></li>
                        <li><a href="/admin/caides" title="">Liste des catégories</a></li>
						<li><a href="/admin/caides/ajouter" title="">Nouvelle catégorie</a></li>
						<li><a href="/admin/aides/ajouter" title="">Nouvelle question</a></li>
                       </ul>-->
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    <!--</li> -->
					<li><a href="/admin/newsletters/" >Newsletter<!--[if IE 7]><!--></a><!--<![endif]-->
					 <!--[if lte IE 6]><table><tr><td><![endif]-->
                    <ul>
						<li><a href="/admin/newsletters/new" title="">Nouveau</a></li>
                      	<li><a href="/admin/newsletters" title="">Liste newsletter</a></li>
                        <li><a href="/admin/abonnes" title="/admin/abonnes/">Liste des abonnés</a></li>
						<li><a href="/admin/abonnes/importer" title="Importer des adresse E-mail">Importer des Emails</a></li>
                    </ul>
					<li><a href="#">Configuration<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
						<li><a href="/admin/users">Utilisateurs</a></li>
						<li><a href="/admin/codepromos">Codes promo</a></li>
						<li><a href="/admin/marques">Marques</a></li>
                        <li><a href="/admin/categories">Catégories</a></li>
						<li><a href="/admin/types">Types produits</a></li>
						<li><a href="/admin/couleurs">Couleurs</a></li>
						<li><a href="/admin/tailles">Tailles</a></li>
						<!--
						<li><a href="/admin/regions">Régions</a></li>
						<li><a href="/admin/departements">Départements</a></li>
						<li><a href="/admin/communes">Communes</a></li>
						-->
						</ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
					<li><a href="/admin/users/moncompte">Mon compte<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><a href="/admin/users/editMonCompte" title="">Modifier mes informations</a></li>
                        <li><a href="/admin/users/modifierMotPasse" title="">Changer mot de passe</a></li>
						</ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
										
				   </ul>
              </div> 
                    
                    
                    
                    
    <div class="center_content">  
    
    
    <!--
    <div class="left_content">
    
    		
              
            
          
    </div>  
    -->
    <div class="right_content">            
	<?php echo $session->flash() ; ?>        
	<?php echo $content_for_layout; ?>
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">
    
    	<div class="left_footer">Administration | <a href="/" target="_blank" ><?php echo $nom_site;?></a></div>
    	<div class="right_footer"><a href="/" target="_blank" ></div>
    
    </div>

</div>		
</body>
</html>