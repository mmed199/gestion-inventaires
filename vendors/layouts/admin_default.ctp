<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Page administration | <?php echo $boutique;?></title>
<link rel="stylesheet" type="text/css" href="/css/admin_style.css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/ddaccordion.js"></script>
<link rel="stylesheet" type="text/css" href="/formwizard/examples/css/ui-lightness/jquery-ui-1.8.2.custom.css" /> 
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
	togglehtml: ["suffix", "<img src='/images/plus.gif' class='statusicon' />", "<img src='/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
 <script type="text/javascript" src="/js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="/js/jquery.jclock-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>
<script type="text/javascript">
$(function($) {
    $('.jclock').jclock();
});
</script>
<?php if(Configure::read('debug') == 0 ) echo $javascript->link('crawler') ; ?>

<script language="javascript" type="text/javascript" src="/js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="/css/niceforms-default.css" />

</head>
<body>
<div id="main_container">

	<div class="header">
    <div class="logo"><a href="#"><img src="/img/logo.png" alt="" title="" border="0" width="100px" height="50px"/></a></div>
    
    <div class="right_header">Bienvenue <?php echo $session->read('Auth.User.fname') ; ?>,
      <?php echo $html->link("Voir le site","/")  ;?> | 
	  <a href="/admin/messages" class="messages">(<?php echo $session->read('Auth.User.message_count') ; ?>) Messages</a> | <br/>
	  <?php echo $html->link("Se déconnecter",array('controller'=>'users','action'=>'logout','admin'=>false) ,array('class'=>'logout' ) ) ;?>
	</div>
    <div class="jclock"></div>
    </div>
    
    <div class="main_content">
    
                    <div class="menu">
                    <ul>
                    <li><a href="/admin">Accueil</a></li>
					<!-- class="current" --> 
					 <li><a href="#">Commandes<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                       <ul>
						<li><a href="/admin/orders" title="Liste des commandes">Liste des commandes</a></li>
                        <li><a href="/admin/orders/paid" title="Commandes encours">Commandes payées</a></li>                       
					   <li><a href="/admin/orders/encours" title="Commandes encours">Commandes encours</a></li>
                       </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
					<li><a href="/admin/produits">Produits</a></li>
					</li>
                    <li><a href="/admin/messages">Messages<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
						  <li><a href="/admin/messages">Boîte de réception</a></li>
						<li><a href="/admin/messages/envoyes">Messages envoyés</a></li>
						<li><a href="/admin/messages/nouveau">Nouveau message</a></li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
					 <li><a href="/admin/evenements">Evénements<!--[if IE 7]><!--></a><!--<![endif]-->
					
					<li><a href="/admin/tcadeaux">Types des cadeaux<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
							<li><a href="/admin/tcadeaux/" title="">Liste des types de cadeaux</a></li>
							</li>
							<li><a href="/admin/tcadeaux/ajouter" title="">Nouveau type</a></li>
							</li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
					
					<li><a href="/admin/clients">Clients<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                      	<li><a href="/admin/clients/index" title="">Liste des clients</a></li>
						<li><a href="/admin/clients/ajouter" title="">Nouveau</a></li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                   
                    
                    <li><a href="/admin/temoignages/index">Témoignages</a></li>
										
					<li><a href="/admin/newsletters/" >Newsletter<!--[if IE 7]><!--></a><!--<![endif]-->
					 <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
						<li><a href="/admin/newsletters/new" title="">Nouveau</a></li>
                      	<li><a href="/admin/newsletters" title="">Liste newsletter</a></li>
                        <li><a href="/admin/abonnes" title="/admin/abonnes/">Liste des abonnés</a></li>
                        </ul>
                    
					
					<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					
					<li><a href="/admin/partenaires">Partenaires<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
							<li><a href="/admin/partenaires/" title="">Liste des partenaires</a></li>
							</li>
							<li><a href="/admin/partenaires/ajouter" title="">Nouveau partenaire</a></li>
							</li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
					
					<li><a href="/admin">Paramétrage<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
							<li><a href="/admin/marques/" title="">Marques</a></li></li>
							<li><a href="/admin/categories/" title="">Catégories</a></li></li>
							<li><a href="/admin/types/" title="">Types produits</a>	</li>
							<li><a href="/admin/createurs/" title="">Créateurs</a></li>
							<li><a href="/admin/couleurs/" title="">Couleurs</a></li>
							<li><a href="/admin/etats/" title="">Etats</a></li>
							<li><a href="/admin/settings/viderLeCache" title="">Vider le cache</a>
							</li>
                        </ul>
					<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					
					
					
					
					
                    </ul>
                    </div> 
                    
                    
                    
                    
    <div class="center_content">  
    
    
    
    <div class="left_content">
			
               
			
    </div>  
    
    <div class="right_content">   
	    <?php echo $session->flash() ; ?>
         <?php echo $content_for_layout; ?>    
     
		<!--
		<br/>
		<br/>
		<img src="/img/arrow.png"/> : Afficher &nbsp;&nbsp;
		<img src="/images/add.png"/> : Nouveau &nbsp;&nbsp;
		<img src="/images/user_edit.png"/> : Editer  &nbsp;&nbsp;
		<img src="/images/trash.png"/> : Supprimer &nbsp;&nbsp;
		-->
		
	 </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">
    
    	<div class="left_footer">IN ADMIN PANEL | Powered by <a href="http://indeziner.com">INDEZINER</a></div>
    	<div class="right_footer"><a href="http://indeziner.com"><img src="/images/indeziner_logo.gif" alt="" title="" border="0" /></a></div>
    
    </div>
	<div class="crawler_info" >
		
	</div>
</div>		
</body>
</html>