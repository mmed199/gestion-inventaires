<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$langCode = Configure::read('Config.langCode');
$default_description=__("Elwards est le seul site de livraison des fleurs et des cadeaux dans toutes les villes et villages d’Algérie, de Tunisie et du Maroc. Nous pouvons assurer toutes vos livraisons de fleurs et cadeaux en Algérie, en Tunisie et au Maroc le jour même ou sous 24 heures maxi. ",true) ;
$page_title = (!isset($page_title))?__("Livraison de fleurs en Algérie, Maroc et Tunisie",true):ucfirst($page_title) ;

if($langCode == "fr"){
	if (!isset($page_keywords))
		$page_keywords =  "Livraison fleurs Maroc, cadeaux Maroc, Livraison fleurs algerie, cadeaux algerie, 
					Livraison fleurs tunise, cadeaux tunisie, fleuriste maroc, fleuriste algerie, fleuriste tunisie, fleurs à Casablanca, fleurs à Rabat, fleurs à Tanger, fleurs à Marrakech, fleurs à Fes, fleurs agadir, Tunis, carthage, envoyer fleurs, patisserie, bouquet fleurs, chocolat, corbeille fruits,commander fleurs maroc, commander fleurs alégrie, commander fleurs tunisie";
}
if($langCode == "en"){
	if (!isset($page_keywords))
		$page_keywords =  "Morocco flower delivery, gifts Morocco, Algeria Send Flowers, gifts Algeria,
				Send flowers tunisia, tunisia gifts, florist Morocco, Algeria florist, florist tunisia, flowers in Casablanca, Rabat flowers, flowers in Tangier, Marrakesh flowers, flowers in Fez, Agadir flowers, Tunis, Carthage, send flowers, pastries, flowers bouquet , chocolate, fruit basket, order flowers Morocco, order flowers alégrie, order flowers tunisia";
}
if($langCode == "it"){
	if (!isset($page_keywords))
		$page_keywords =  "Marocco consegna di fiori, regali Marocco, Algeria Send Flowers, regali Algeria,
		Invia fiori tunisia, tunisia doni, fioraio Marocco, Algeria fiorista, fioraio tunisia, fiori in Casablanca, Rabat fiori, fiori in Tangeri, Marrakech fiori, fiori a Fez, Agadir fiori, Tunisi, Cartagine, inviare fiori, dolci, fiori, bouquet , cioccolato, cesto di frutta, fiori ordine Marocco, alégrie ordinare fiori, ordinare fiori tunisia";
}
if($langCode == "es"){
	if (!isset($page_keywords))
		$page_keywords =  "Marruecos, la entrega de flores, regalos Marruecos, Argelia Flores envío, regalo de Argelia,
		Enviar flores túnez, túnez regalos, floristería Marruecos, Argelia, florería floristería túnez, flores en Casablanca, Rabat flores, flores en Tánger, Marrakech flores, flores en las flores de Fez, Agadir, Túnez, Cartago, enviar flores, pasteles, ramo de flores , el chocolate, cesta de frutas, flores orden Marruecos, flores alégrie orden, el orden flores túnez";
}



$page_description = (!isset($page_description))?$default_description:$page_description ;
?>
<title><?php echo $page_title ; ?></title>
<meta name="description" lang="<?php echo $langCode;?>" content="<?php echo $page_description ; ?>" />
<meta name="keywords" content="<?php echo $page_keywords ; ?>" />

<?php if (isset ($page_noindex))
	echo $page_noindex;
if (isset ($page_url_canonical))
	echo '<link rel="canonical" href="'.$page_url_canonical.'" />' ;
?>
	
	
	
 <link rel="icon" href="/img/favicon.png" />	
 <?php echo $html->charset("utf-8"); ?>
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/css/menu.css" />
	<link rel="stylesheet" type="text/css" href="/css/elwards.css" />
			
    <?php  $html->css(array("jquery.fancybox-1.3.4",
								"jquery-ui-1.8.16.custom.css",
								"jquery-ui-1.8.2.custom"
							), 'stylesheet', array('inline' => false ));
	?>		
	 <?php $javascript->link("/formwizard/js/jquery-1.4.2.min.js",false) ; ?>
	 <?php $javascript->link("jquery-ui-1.8.16.custom.min",false) ; ?>
	 
	 <?php  $javascript->link(array("menu-principale","main"), false);  ?>

	 <?php echo $asset->scripts_for_layout()  ;    ?>  
</head>
<body dir="<?php if($langCode =="ar" ) echo 'rtl' ; ?>">
	<div id="wrapper" >
		<div id="header">
			<div id="header-menu-h">
				<div id="languages">
					<table>
						<tr valign="top"> 							
							<td> 
								<a href="http://www.elwards.com/fr/"  title="Français"><img src="/img/fr.gif" alt="Livraison de fleurs et cadeaux en Algérie, Maroc et Tunisie"/></a>
							</td>
							<td>
								<a href="http://www.elwards.com/en/"  title="English"><img src="/img/en.gif" alt="Delivery of flowers and gifts in Algeria, Morocco and Tunisia"/></a>
							</td>
							<td>
								<a href="http://www.elwards.com/it/"  title="italiano"><img src="/img/it.png" alt="Consegna dei fiori e regali in Algeria, Marocco e Tunisia"/></a>
							</td>
							<td>
								<a href="http://www.elwards.com/es/"  title="español"><img src="/img/es.png" alt="Entrega de flores y regalos en Argelia, Marruecos y Túnez"/></a>
							</td>
						</tr>
					</table>
					
				</div>
				<div id="menu-haut" >
					<ul id="menu_horizontal">	
						<li><a href="http://www.elwards.com/<?php echo ($langCode  . "/".Inflector::slug(__('Accueil',true),'-').".html") ; ?>"><?php echo __("Accueil",true);?></li>
						<li><a href="http://www.elwards.com/blog"  target="_blank" alt="Blog Elwards">Blog</a></li>
						<li><a href="http://www.elwards.com/<?php echo ($langCode  . "/".Inflector::slug(__('avis des clients',true),'-').".html") ; ?>"><?php echo __("Avis des clients",true);?></li>
						<li><a href="http://www.elwards.com/<?php echo ($langCode  . "/".Inflector::slug(__('qui sommes nous',true),'-').".html") ; ?>"><?php echo __("Qui sommes-nous ?",true);?></li>
						<li><a href="http://www.elwards.com/<?php echo ($langCode  . "/messages/contact") ; ?>"><?php echo __("Nous contacter",true);?></li>
					</ul>
				</div>
				<div id='header-phone'>
					<table style="width: 141px;" border="0" cellpadding="0" cellspacing="0">
					    <tbody>
							<tr align="center" valign="top">
								<td style="background-image: url(/img/cartouche_numero.jpg);">
									&nbsp;&nbsp; 
									<span style="font-weight: bold;font-size: 10px; color: #444444;">+33 9 52 00 13 43*</span>
								</td>
							</tr>
							<tr>
							   <td align="center" >
									<span  style="font-size: 8px; color: rgb(128, 99, 6);">*<?php __("numéro non surtaxé") ; ?></span>
								</td>
							</tr> 
						</tbody>
					</table>
										
			   </div>
			</div> 
			<?php
				echo $this->element("header-pub"); 			
			?>			
			<!-- #header-center -->
			<?php
				echo $this->element("menu-principal"); 			
			?>	
			
		<!-- end div#menu-principal -->
		</div>
	<!-- end div#header -->
		<div id="page">
			<div id="content">
				<!-- <balise id="hautdepage"></balise> -->
						<?php echo $content_for_layout; ?>
			</div>
		<br/><br/>
		<div id="footer">
				<div id="footer-content">
					<?php  
						//si affichage des villes on n'affiche pas le bas de page
						if (!isset ($zone) ){
							if( ( isset($page_name) && ($page_name=="evenement" || $page_name=="pterm" ) )   ) //|| ( $langCode !="fr" && $langCode !="en" )
									echo $this->element("nuage_keywords", array('cache' => array('time' => '+1 day','key'=>'nuage_keywords')));
						   elseif (!isset($pays_id) )   
								echo $this->element("bas_page"); 
						   elseif (isset ($no_affiche_bas_page))
								echo "";
							else
								echo $this->element("bas_page",array('pays_id' =>$pays_id ,'parent_id'=>$parent_id)); 
						}			
					?>
				</div> 
				
				<br/>
			
 			<div id="menu_bas" >
					<br/> 
					<ul id="menu_bas_ul">
						<?php if (isset($lien_wikipedia))
							echo "<li><a href='$lien_wikipedia' alt='ville " . (isset ($zone)?$zone:(isset($ville)?$ville:""))." Wikipedia' target='_blank' >Wikipedia</a></li>";
						?>
						<li><a href="http://www.elwards.com/<?php echo $langCode."/".__('newsletters',true) ; ?>"><?php echo __("Newsletter",true);?></a></li>
						<li><a href="http://www.elwards.com/<?php echo $langCode."/".__('nos-blogs',true) ; ?>.html"><?php echo __("Nos blogs",true);?></a></li>
						<li><a href="http://www.elwards.com/<?php echo $langCode."/".__('partenaires',true) ; ?>.html"><?php echo __("Nos partenaires",true);?></a></li>
						<li><a href="http://www.elwards.com/<?php echo $langCode."/".__('mention-legale',true) ; ?>.html"><?php echo __("Mention légale",true);?></a></li>				
						<li><a href="http://www.elwards.com/<?php echo $langCode."/".__('conditions-generale-de-vente',true) ; ?>.html"><?php echo __("Conditions générales de vente",true);?></a></li>
					</ul>	
					
			</div>
			<br/>
		</div>
		<!-- end div#footer -->
			
	</div>
	<!-- end div#page -->

<p id="copyright">
<span style="font-size:11px;">
								<?php __("Copyright") ; ?> &copy; 2011 Elwards. <?php echo  __("Tous droits réservés");?>. &nbsp;&nbsp;&nbsp;&nbsp; <?php __("Site réalisé par ") ; ?> <a href="http://www.as-net.fr" target="_blank" alt="AS Net <?php __("société de création des sites internet") ; ?>">As Net</a>
</span>
</p>
	<div class="popup">	
	<?php echo $html->link($html->image("/img/small_cross.png"),"javascript:closepopup();",array("escape"=>false,"class"=>"cross"));?>
	<div class="flashMessage" ><?php echo $this->Session->flash(); ?></div>
	</div>	
</div>
<!-- end div#wrapper -->
	<?php echo $javascript->link(array("jquery.cycle.all.min",
								'/js/fancybox/jquery.fancybox-1.3.4.pack.js',
								"/js/formwizard/jquery.form.wizard-".$langCode.".js"
								)
							) ; ?>
	<?php echo $html->script('goo-analytics') ; ?>
	</body>
</html>
