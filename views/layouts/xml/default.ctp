<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$page_title = (!isset($page_title))?"Elwards":$page_title ;
$page_keywords = (!isset($page_keywords))?"Elwards":$page_keywords ;
$page_description = (!isset($page_description))?"Elwards":$page_description ;
?>
<title><?php echo $page_title ; ?></title>
<meta name="keywords" content="<?php echo $page_keywords ; ?>" />
<meta name="description" content="<?php echo $page_description ; ?>" />
       <?php echo $html->css("main"); ?>
	   <?php echo $html->css("menu"); ?>
	   <?php echo $html->css("jquery.fancybox-1.3.4"); ?>
	   	   <link rel="stylesheet" type="text/css" href="/css/jquery-ui-1.8.16.custom.css" /> 
		   <link rel="stylesheet" type="text/css" href="/formwizard/examples/css/ui-lightness/jquery-ui-1.8.2.custom.css" /> 
	   <?php echo $html->css("abdii_style"); ?>
	   <?php echo $html->css("elwards"); ?>
       <?php echo $html->css("slideshow"); ?>
	   <?php echo $html->charset("utf-8"); ?>
	   <?php echo $html->script("menu-principale"); ?>
	   <?php echo $html->script("goo-analytics"); ?>
	   <link rel="icon" href="/img/favicon.png" />

    <script type="text/javascript" src="/formwizard/js/jquery-1.4.2.min.js"></script>		
    <script type="text/javascript" src="/js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="/formwizard/js/jquery.form.wizard.js"></script>
	    <script type="text/javascript">
			$(function(){
				$("#commanderForm").formwizard({ 
				 	focusFirstInput : true,
				 	formOptions :{
						success: function(data){$("#status").fadeTo(500,1,function(){ $(this).html("You are now registered!").fadeTo(5000, 0); })},
						beforeSubmit: function(data){$("#data").html("data sent to the server: " + $.param(data));},
						dataType: 'json',
						resetForm: true
				 	}	
				 }
				);
  		});
    </script>
	   <?php echo $html->script("/js/fancybox/jquery.fancybox-1.3.4.pack"); ?>
	   <?php echo $html->script("main"); ?>
	   <?php echo $html->script("jquery.cycle.all.min");?>
	   <?php echo $html->script("popup"); ?>
     <script src="/js/plus.js"></script>
  <script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
	$("a#image").fancybox();
  });
  </script>

</head>
<body>
	<div id="wrapper" >
		<div id="header">
			<div id="languages">
				<table>
					<tr valign="top">
						<td>
							<a href="/en"  title="English"><img src="/img/anglais.gif" border="0"></a>
						</td>
						<td>
							<a href="/fr"  title="Français"><img src="/img/francais.gif" border="0"></a>
						</td>
						
					</tr>
				</table>
				
			</div>
			<div id="premier-menu">
				<table width="100%"><tr valign="top" align="right"><td>
				<ul id="menu_horizontal">	
					<li><?php echo $i18n->link(__("Nous contacter",true),'/messages/contact') ; ?></li>
                                         <!--
					<li><a href="/admin">Votre panier</a></li>
					<li><a href="#" id="login-button">Accédez à votre compte</a></li>
                                          -->
					<li><?php echo $i18n->link(__("Avis des clients",true),'/avis-des-clients.html') ; ?></li>
					<li><?php echo $i18n->link(__("Qui sommes-nous ?",true),'/qui-sommes-nous.html') ; ?></li>
					<li><?php echo $i18n->link(__("Accueil",true),'/index.php') ; ?></li>
				</ul>
				</td><td>
				<div align="right">
							<table style="width: 141px;" align="" border="0" cellpadding="0" cellspacing="0">
										<tbody><tr align="center"><td></td></tr><tr align="center" valign="top"><td style="padding-top: 3px; background-image: url(&quot;/img/cartouche_numero.jpg&quot;);" height="21">
										<span style="font-weight: bold;">&nbsp;&nbsp; </span><span style="font-size: 12px; font-weight: bold;"><span style="font-family: Arial,helvetica,sans-serif;color: #444444;">09 52 00 13 43*</span></span><br></td></tr><tr>
										<td style="vertical-align: top;">
											<span style="font-size: 8px; font-family: Verdana,Arial,Helvetica,sans-serif;color: rgb(128, 99, 6);">*numéro non surtaxé</span></td></tr> </tbody>
										</table>
										
						</div>
				</td></tr></table>
			</div> 
			<div id="header-center">
				<div id="logo">
					<?php echo $i18n->link(
										$html->image("/img/logo.png",
													  array("title"=>"Elwards",
															) ), 
										"/",array("escape"=>false)
										);  
					?>
					
					
					<div class="logo-texte">
                                                 <center>						
						<b><?php echo  __("Livraison de fleurs et cadeaux Spécialiste du Maghreb");?></b>
                                                </center>
					</div>
					
				</div>
				<!-- end div#logo -->
				<div id="promo_haut_1">
					<object    classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
							codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,42,0"
							width="439" height="120" align="right">
							<param name="movie" value="/swf/ban-fr.swf">
							<param name="quality" value="high">
							<param name="wmode" value="">
							<param name="seamlesstabbing" value="false">
							<param name="allowscriptaccess" value="samedomain">
							<embed
							  src="/swf/ban-fr.swf"
							  wmode="" 
							  width="439" height="120" align="left" background="white"
							  type="application/x-shockwave-flash"
							  pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"
							  quality="high"
							  seamlesstabbing="false"
							  allowscriptaccess="samedomain"
							 > 
							  <noembed>
							  </noembed>
							</embed>
						  </object>		
					
				</div> 
				<div class="promo_haut_2">
							<object    classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
							codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,42,0"
							width="250" height="120" align="right">
							<param name="movie" value="/swf/2_rose.swf">
							<param name="quality" value="high">
							<param name="wmode" value="transparent">
							<param name="seamlesstabbing" value="false">
							<param name="allowscriptaccess" value="samedomain">
							<embed
							  src="/swf/2_rose.swf"
							  wmode="transparent" 
							  width="250" height="120" align="left" background="white"
							  type="application/x-shockwave-flash"
							  pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"
							  quality="high"
							  seamlesstabbing="false"
							  allowscriptaccess="samedomain"
							 > 
							  <noembed>
							  </noembed>
							</embed>
						  </object>		
				</div>	
			</div>
			<div id="menu-principal">
				<div style="background:#FFFFFF;"> 
					<div class="mainmenu">
						<span class="left"></span>
						<ul class="top">
							<!-- class sepecial active
							-->
							  <li class="topli">
								  <?php echo $i18n->link(__("Accueil",true),'/',array('class'=>"top_link ","titre"=>__("Page d'acceuil",true))) ; ?>
							  </li>
						  
						  					  
						  <li class="topli">
						     <?php echo $i18n->link(__("Fleurs",true),'/',array('class'=>"top_link ","titre"=>__("Bouquets de fleurs",true))) ; ?>
						   <ul class="sub">
							  <li class="subli">
								<?php echo $i18n->link(__("Fleurs Algérie",true),'/bouquet-fleurs/algerie',array('class'=>"sub_link ","titre"=>__("Fleurs Algérie",true))) ; ?>
							  </li>
							  <li class="subli">
								<?php echo $i18n->link(__("Fleurs Maroc",true),'/bouquet-fleurs/algerie',array('class'=>"sub_link ","titre"=>__("Fleurs Maroc",true))) ; ?>
							  </li>
							  <li class="subli">
								<?php echo $i18n->link(__("Fleurs Tunisie",true),'/bouquet-fleurs/tunisie',array('class'=>"sub_link ","titre"=>__("Fleurs Tunisie",true))) ; ?>
							  </li>
						   </ul>
						  </li>
						  <li class="topli"> 
								<?php echo $i18n->link(__("Evénements",true),'/bouquet-fleurs/evenement',array('class'=>"top_link ","titre"=>__("Evénements",true))) ; ?>
						  <ul class="sub">
							  <?php  $evenements = $this->requestAction(array(
													"controller"=>"evenements",
													"action"=>"evenementslist"
												));
								?>
							<?php foreach( $evenements as $e ) : ?>
							   <li  class="subli ">
									<?php echo $i18n->link($e['Evenement']['title'],"/bouquet-fleurs/evenement/".$e['Evenement']['id'],array("class"=>"sub_link ","titre"=>$e['Evenement']['title'])) ; ?>
								</li>
							<?php endforeach ; ?>
						  </ul>
						  </li>
						  <li class="topli">
							  <?php echo $i18n->link(__("Tous nos bouquets",true),"/",array('class'=>"top_link ","titre"=>__("Tous nos bouquets",true))) ; ?>

						   </li>
						  <li class="topli">
						   <?php echo $i18n->link(__("Collection prestige",true),"/collection-prestige.html",array('class'=>"top_link ","titre"=>__("Collection prestige",true))) ; ?>
						  </li>
						  <li class="topli">
						  <li class="topli">
							 <?php echo $i18n->link(__("Plantes",true),"/plantes.html",array('class'=>"top_link ","titre"=>__("Plantes",true))) ; ?>

						  </li>
						  <li class="topli">
							<a class="top_link " title="Chocolats et gourmandises" target="_self" href="#">
								<span>Chocolats et gourmandises</span>
							</a>
							<ul class="sub">
							  <li class="subli ">
								  <?php echo $i18n->link(__("Chocolats",true),"/chocolat.html",array("class"=>"sub_link ","title"=>__("Chocolats",true))) ; ?>

							  </li>			
							  <li class="subli ">
								 <?php echo $i18n->link(__("Dragées",true),"/dragee.html",array("class"=>"sub_link ","titre"=>__("Dragées",true))) ; ?>

							  </li>
							</ul>
						  </li>
						  <li class="topli">
							  <a class="top_link " title="<?php echo  __("Corbeille de fruits");?>" target="_self" href="#">
								  <span>Corbeille de fruits</span>
							  </a>
							  <ul class="sub">
								  <li class="subli ">
									<?php echo $i18n->link(__("Corbeille de fruits frais",true),"/corbeille-fruits-frais.html",array("class"=>"sub_link ","titre"=>__("Corbeille de fruits frais",true))) ; ?>
                                  </li>
								  <li class="subli ">			
									<?php echo $i18n->link(__("Corbeille de fruits secs",true),"/corbeille-fruits-secs.html",array("class"=>"sub_link ","titre"=>__("Corbeille de fruits secs",true))) ; ?>
 
								  </li>
							</ul>
						  </li>
						 
						</ul>
						<span class="right"></span>
					</div>
				</div>
			</div>
		<!-- end div#menu-principal -->
		</div>
	<!-- end div#header -->
	<div id="page">
		<div id="content">
					<?php echo $content_for_layout; ?>
		</div>
		<br/><br/>
		<div id="footer">
			<div id="footer-content">
				<?php  echo $this->element("bas_page"); ?>
			</div> 
			<div id="menu_bas" >
					<br/>
					<ul id="menu_bas_ul">
						<li><?php echo $i18n->link(__("Newsletter",true),'/newsletter.html') ; ?></li>
						<li><?php echo $i18n->link(__("Nos blogs",true),'/blog.html') ; ?></li>
						<li><?php echo $i18n->link(__("Nos partenaires",true),'/partenaires') ; ?></li>
						<li><?php echo $i18n->link(__("Conditions générale de vente",true),'/conditions-generale-de-vente.html') ; ?></li>				
					</ul>				
			</div>
		</div>
		<!-- end div#footer -->
			
	</div>
	<!-- end div#page -->
		
</div>
<!-- end div#wrapper -->
<p id="copyright">
<span style="font-size:11px;">
								Copyright &copy; 2011 Elwards. <?php echo  __("Tous droits réservés");?>. <?php echo  __("Crée par");?> <a href="http://www.as-net.fr" target="_blank" title="www.as-net.fr" rel="history">AS-Net.fr</a>
</span>
</p>
    <div id="popupContact">  
        <a href="#" id="popupContactClose">x</a>  
        <div id="loginArea">  
			<h1>Se connecter</h1>  
			<?php
			$session->flash('Auth');
			echo $form->create('Member', array('id'=>'formID', 'class'=>'formular','action'=>'login'));
			echo $form->input('email', array('class'=>'validate[required,custom[email]]','label'=>'Email : '));
			echo $form->input('password', array('type'=>'password','class'=>'validate[required] minSize[6]', 'label'=>'Mot de passe : '));
			echo $form->end('Connexion');
			?>
			<a href="#" id="recover-button" >Compte oublié ? </a>

        </div>  
    </div>  
	<div class="popup">
	  <?php echo $this->Session->flash();
        	echo $i18n->link($html->image("/img/small_cross.png"),"javascript:closepopup();",array("escape"=>false,"class"=>"cross"));
	   ?>
	</div>
    <div id="backgroundPopup"></div>  </body>
</html>
