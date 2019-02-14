<?php
	$site_url = Configure::read('site_url');
	$titre_pro = $pro['Member']['societe'] ;
	$titre_annuaire = $pro['Member']['titre_annuaire'] ;
	$vue = $pro['Member']['vue'] ;
	$description = $pro['Member']['description'] ;
	$annonce_count = count($pro['Member']['annonce_count']);
	$cheminLogo = "";
	$cheminLogo = "/uploads/members/".$pro['Member']['logo'];	
	$id_pro = $pro['Member']['id'];
	$categorie_nom = $pro['Pcategory']['nom'];
	$type_nom = $pro['Ptype']['nom'] ;
	$type_slug	= $pro['Ptype']['slug'] ;
	$categorie_slug	= $pro['Pcategory']['slug'] ;
	$pro_slug = $pro['Member']['slug'];
	$pro_ville = $pro['City']['nom'];
	$pro_url = $site_url."/annuaire-des-professionnels/".$categorie_slug."/".$type_slug."/".$pro_slug."-".$id_pro.".html";
?>	

<!-- Breadcrumb -->
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" href="/" title="retour &agrave; Accueil" rel="tooltip"><i class="icon-home"></i></a>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page"><a href="/annuaire-des-professionnels" title="Annuaire des professionnels" rel="tooltip">Annuaire des professionnels</a></span>
		<span class="navigation-pipe" >&gt;</span>
		<span class="navigation_page"><?php echo $titre_pro ; ?></span>
	</div>
</div>
<!-- /Breadcrumb -->
<?php echo $session->flash() ; ?>
<div id="primary_block" class="clearfix">
	<!--ADD CUSTOM CLOUD ZOOM!!!-->
	<!-- Call quick start function. -->
	<!-- right infos-->
	<div class="row">
		<div id="pb-right-column" class="span3">
			<h1 class="pb-right-colum-h"><?php echo $titre_pro ; ?></h1>
			<!-- product img-->			
			<div id="image-detail">	
            	<?php if($pro['Member']['verified']==1 ){ ?>
				<img src="/img/verified-pro.png" alt="Vérifié" rel="tooltip" data-placement="left" data-original-title="Vérifié" class="icon-verified-detail">					
				<?php }; ?> 				
				<span>
					<img alt="<?php echo $titre_pro ; ?>" class="img-polaroid" title="<?php echo $titre_pro ; ?>" src="<?php echo $cheminLogo ; ?>" >
             	</span>
			</div>    
			<ul id="usefull_link_block" class="clearfix" >			
				<li id="favoriteproducts_block_extra_add" class="add favorite">
					<i class="icon-heart-empty"></i>Ajouter à mes favoris
				</li>
				<li id="favoriteproducts_block_extra_added" class="favorite">
					<i class="icon-heart"></i>Retirer de mes favoris
				</li>
				<li id="favoriteproducts_block_extra_removed" class="favorite">
					<i class="icon-heart-empty"></i>Ajouter à mes favoris
				</li>
				<li id="left_share_fb">
					<a href="http://www.facebook.com/sharer.php?u=<?php echo $pro_url;?>&amp;t=<?php echo $titre_pro; ?>" target="_blank"><i class="icon-facebook-sign"></i>Partager sur Facebook</a>
				</li>
				<li class="sendtofriend">
					<a id="send_friend_button" href="#send_friend_form"><i class="icon-envelope"></i>Envoyer à un ami</a>
				</li>	
				<li class="print"><a href="javascript:print();"><i class="icon-print"></i>Imprimer cette fiche</a></li>
			</ul>
			<section id="ads_block_right" class="block products_block column_box">
				<div class="block_content toggle_content">
					<script type="text/javascript"><!--
						google_ad_client = "ca-pub-3687705350117181";
						/* pub left product */
						google_ad_slot = "3498234357";
						google_ad_width = 200;
						google_ad_height = 200;
						//-->
						</script>
						<script type="text/javascript"
						src="//pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>
				</div>
			</section>  
		</div>
		<!-- left infos-->
		<div id="pb-left-column" class="span5">
			<h1><?php echo $titre_pro ; ?></h1>
			<?php if(!empty($titre_annuaire)){ ?>
				<span class="titre_annuaire"><?php echo $titre_annuaire;?></span>
			<?php }; ?>
			<div id="short_description_block">
				<div id="short_description_content" class="rte align_justify">
					<p class="lead">
						<?php echo $description; ?>
					</p>
				</div>							
				<div id="short_description_content" class="rte align_justify">
					<div class="div-transparent type-pro">
						<?php  if (!empty($pro['Ptype']['nom'])) { ?>
		    				<span class="small-menu"><?php echo $pro['Ptype']['nom']; ?>  <?php if(!empty($pro['City']['nom']) ) : ?>/  <i class="icon-map-marker"></i> <?php echo $pro['City']['nom']; ?><?php endif; ?></span>	
		    			<?php }  ?>	
					</div>
				</div>									
			<!---->
			</div>
			<div> 	
			<!-- Reponse form-->				  
				
				<script text="javascript">

					$('document').ready(function(){
						$('#devis_button').fancybox({
							autoScale : true,
							'hideOnContentClick': false
						});

						$('#submitDevis').click(function(){
							var datas = [];
							$('#fancybox-content').find('input').each(function(index){
								var o = {};
								o.key = $(this).attr('name');
								o.value = $(this).val();
								if (o.value != '')
									datas.push(o);
							});
							if (datas.length < 3)
							{
								$('#form_error').text("Vous n\'avez pas rempli les champs requis");
							}
						});
					});

				</script>
				<div class="row_1">						
                    <p id="add_to_cart" class="buttons_bottom_block">
                        <a id="devis_button" href="#devis_form" class="exclusive button btn_add_cart"><i class="icon-share-alt"></i> Demander un devis</span></a>
                    </p>
    			</div>
				<div style="display: none;">
					<div id="devis_form">
						<?php echo $this->Form->create('Devi', array('id'=>'buy_block','url' => array('controller' => 'members', 'action' => 'demande_devis', $id_pro), "enctype" => "multipart/form-data"));?>
							<!-- hidden datas -->
							<p class="hidden">
								<?php echo $this->Form->input('Devi.pro_id', array('type' => 'hidden', 'value' => $id_pro));?>
							</p>  
							<h1 class="title clearfix">Demander un devis</h1>
				            <div class="row-fluid">
					            <div class="span6 titled_box">
					            	<h2 class="product_name"><span><?php echo $titre_pro; ?></span></h2>
					                <div class="product clearfix">
					                    <img class="img-polaroid" style="width: 138px;" src="<?php echo $cheminLogo ; ?>" alt="<?php echo $titre_pro; ?>" />
					                    <div class="product_desc">
					                        <?php echo $description ; ?>
					                    </div>
					                </div>
								</div>
					            <div class="span6">
									<div class="send_friend_form_content">
										<div id="form_error"></div>
										<div class="form_container titled_box">
											<p class="text">
												<label for="nom">Votre nom <sup class="required">*</sup> :</label>
												<?php echo $this->Form->input('Devi.nom',array('label' =>false,'div' =>false,'type' => 'text'));?>
											</p>
											<p class="text">
												<label for="telephone">Votre téléphone :</label>
												<?php echo $this->Form->input('Devi.telephone',array('label' =>false,'div' =>false,'type' => 'text'));?>
											</p>
											<p class="text">
												<label for="email">Votre Adresse e-mail <sup class="required">*</sup> :</label>
												<?php echo $this->Form->input('Devi.email',array('label' =>false,'div' =>false,'type' => 'text'));?>
											</p>
											<p class="text">
												<label for="message">Message <sup class="required">*</sup> :</label>
												<?php echo $this->Form->textarea('Devi.message',array('label' =>false,'div' =>false,'cols' => 45, 'rows' => 5));?>
											</p>
										</div>	
									</div>
					            </div>
				            </div>
				            <div id="new_comment_form_footer" class=" sendfrend_footer" style="margin-top:15px;">
			                    <p class="fl required"><sup>*</sup> Champs requis</p>
			                    <p class="fr ">
			                    	<button class="btn btn-inverse" onclick="$.fancybox.close();" />Annuler</button>
									<button id="submitDevis" class="btn btn-inverse" name="submitDevis" type="submit" onclick="$('#buy_block').submit();" />Envoyer</button>
				                    <!--input id="sendEmail" class="btn btn-inverse" name="sendEmail" type="submit" value="Envoyer" /-->
			                    </p>
			                    <div class="clearfix"></div>
			                </div>
						</form> 
					</div>
				</div>
				<!-- end Reponse form-->
            </div>  
            <!-- Out of stock hook -->
            <div id="product_comments_block_extra">            	
            	<div class="comments_advices">
            		<h5><span>Contacter : </span></h5>
		    			<?php 
			    		if ($pro['Member']['type_compte']==0){  ?>
			    			<em><?php echo nl2br($pro['Member']['prenom']) ; ?> <?php echo nl2br($pro['Member']['nom']);?>.</em>
			    		<?php 
			    		}if ($pro['Member']['type_compte']==1){
			    			if (!empty($pro['Member']['societe'])) { ?>
			    				<br><em><?php echo nl2br($pro['Member']['societe']);?></em><br>
			    			<?php } ?>
			    			<?php  if (!empty($activite_nom)) { ?>
			    				<br><em>Activité : <?php echo nl2br($activite_nom);?></em><br>	
			    			<?php }  ?>
							<?php 
			    		} ?>
		    			<?php if (!empty($pro['Member']['mobile'])) { ?>
		    				<span><i class="icon-phone"></i> : </span><em><?php echo nl2br($pro['Member']['mobile']);?></em><br>
		    			<?php } ?>
		    			<?php if (!empty($pro['Member']['telephone'])) { ?>
		    				<span><i class="icon-phone"></i> : </span><em><?php echo nl2br($pro['Member']['telephone']);?></em><br>
		    			<?php } ?>
		    			<?php if (!empty($pro['Member']['adresse'])) { ?>
	    					<span><i class="icon-envelope"></i> : </span> <em><?php echo nl2br($pro['Member']['adresse']);?></em><?php if (!empty($pro['Member']['adresse_suite'])) { ?> - <em><?php echo nl2br($pro['Member']['adresse_suite']); } ?></em><?php if (!empty($pro['City']['nom'])) { ?> - <?php echo nl2br($pro['City']['nom']); } ?><br>	
	    				<?php } ?>
			    	
			    </div>
			</div>      
			<p id="oosHook" style="display: none;">				 
				<script type="text/javascript">
				$(function(){
					$('a[href=#idTab5]').click(function(){
						$('*[id^="idTab"]').addClass('block_hidden_only_for_screen');
						$('div#idTab5').removeClass('block_hidden_only_for_screen');

						$('ul#more_info_tabs a[href^="#idTab"]').removeClass('selected');
						$('a[href="#idTab5"]').addClass('selected');
					});
				});
				</script>
				<div id="product_comments_block_extra">
					<div class="comments_advices">
						<a class="open-comment-form"  href="#new_comment_form">Donnez votre avis</a>
					</div>
				</div>
				<!--  /Module ProductComments -->
			</p>
			<div class="addsharethis">
				<div class="addsharethisinner" style="display: block;">
					<span class='st_twitter_hcount' displayText='Tweet'></span>
					<span class='st_googleplus_hcount' displayText='Google +'></span>
					<span class='st_pinterest_hcount' displayText='Pinterest'></span>
					<span class='st_facebook_hcount' displayText='Facebook'></span>
					<script type="text/javascript">var switchTo5x=true;</script>
					<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
					<script type="text/javascript">stLight.options({publisher: "37d51690-e52b-4348-9b61-369ee94fcf19", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
				</div>
			</div>				
		</div>
	</div>
</div>
<!-- dans la même catégorie -->
<div class="clear"></div>
<div class="extra-box-product">
	<?php if(!empty($demandes_pro) || !empty($offres_pro) || !empty($demandes_pro) || /*!empty($emplois_pro)||*/ !empty($vacances_pro) ) : ?>
	<section class="page_product_box blockproductscategory">
		<h3>Dernières annonces <?php echo $titre_pro ; ?> :<span class="icon-toggle"></span></h3>
    	<div id="block-category-slider" class="carusel-inner responsive toggle_content">
    		<ul id="carouselproduct" class="carousel-ul">
    			<?php foreach ($demandes_pro as $d) : ?>
			    <li class="item">
                    <a href="<?php echo $site_url."/demandes/".$d['Dcategory']['slug'] ."/".$d['Dtype']['slug'] ."/";?>
									<?php if(!empty($d['Demande']['slug'])) { ?>
									<?php echo $d['Demande']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $d['Demande']['id'].".html";?>" class="lnk_img" title="<?php echo $d["Demande"]["nom"] ?>"><img class="img-polaroid" style="height: 100px;" src="<?php echo "/uploads/demandes/".$d["Demande"]["image"]; ?>" alt="<?php echo $d["Demande"]["nom"] ?>" /></a>
                    <a class="product_link" href="<?php echo $site_url."/demandes/".$d['Dcategory']['slug'] ."/".$d['Dtype']['slug'] ."/";?>
									<?php if(!empty($d['Demande']['slug'])) { ?>
									<?php echo $d['Demande']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $d['Demande']['id'].".html";?>" title="<?php echo $d["Demande"]["nom"] ?>"><?php echo $d["Demande"]["nom"] ?></a>
                </li>
                <?php endforeach; ?>
                <?php foreach ($offres_pro as $o) : ?>
			    <li class="item">
                    <a href="<?php echo $site_url."/offres/".$o['Dcategory']['slug'] ."/".$o['Dtype']['slug'] ."/";?>
									<?php if(!empty($o['Demande']['slug'])) { ?>
									<?php echo $o['Demande']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $o['Demande']['id'].".html";?>" class="lnk_img" title="<?php echo $o["Demande"]["nom"] ?>"><img class="img-polaroid" style="height: 100px;" src="<?php echo "/uploads/demandes/".$o["Demande"]["image"]; ?>" alt="<?php echo $o["Demande"]["nom"] ?>" /></a>
                    <a class="product_link" href="<?php echo $site_url."/offres/".$o['Dcategory']['slug'] ."/".$o['Dtype']['slug'] ."/";?>
									<?php if(!empty($o['Demande']['slug'])) { ?>
									<?php echo $o['Demande']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $o['Demande']['id'].".html";?>" title="<?php echo $o["Demande"]["nom"] ?>"><?php echo $o["Demande"]["nom"] ?></a>
                </li>
                <?php endforeach; ?>
                <?php foreach ($emplois_pro as $e) : ?>
			    <li class="item">
                    <a href="<?php echo $e['Job']['link']; ?>" class="lnk_img" title="<?php echo $e["Job"]["titre"] ?>"></a>
                    <a class="product_link" href="<?php echo $e['Job']['link']; ?>" title="<?php echo $e["Job"]["titre"] ?>"><?php echo $e["Job"]["titre"] ?></a>
                </li>
                <?php endforeach; ?>                
                <?php foreach ($vacances_pro as $v) : ?>
			    <li class="item">
                    <a href="<?php echo $site_url."/vacances/";?>
									<?php if(!empty($v['Vacance']['slug'])) { ?>
									<?php echo $v['Vacance']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $v['Vacance']['id'].".html";?>" class="lnk_img" title="<?php echo $v["Vacance"]["titre"] ?>"><img class="img-polaroid" style="height: 100px;" src="<?php echo "/uploads/vacances/".$v["Vacance"]["image"]; ?>" alt="<?php echo $v["Vacance"]["titre"] ?>" /></a>
                    <a class="product_link" href="<?php echo $site_url."/vacances/";?>
									<?php if(!empty($v['Vacance']['slug'])) { ?>
									<?php echo $v['Vacance']['slug']."-" ;?>
									<?php } else { ?>
									<?php echo "" ; ?>
									<?php } ?>
									<?php echo $v['Vacance']['id'].".html";?>" title="<?php echo $v["Vacance"]["titre"] ?>"><?php echo $v["Vacance"]["titre"] ?></a>
                </li>
                <?php endforeach; ?>
			</ul>
        </div>
	</section>
	<?php endif; ?>
	<section id="last_page_product" class="page_product_box toggle_frame">
		<h3 href="#idTab5" class="idTabHrefShort">Commentaires<span class="icon-toggle"></span></h3>
		<div id="more_info_sheets" class="toggle_content toggle_content_comment">
		   <script type="text/javascript">
				var productcomments_controller_url = '#';
				var confirm_report_message = "Êtes-vous sur de vouloir signaler ce commentaire ?";
				var secure_key = "$id";
				var productcomments_url_rewrite = '0';
			</script>
			<div id="idTab5">
				<div id="product_comments_block_tab">
					<p class="align_center">
						<a id="new_comment_tab_btn" class="open-comment-form" href="#new_comment_form">Soyez le premier à donner votre avis !</a>
					</p>						
				</div>
			</div>
			<!-- Fancybox -->
			<div style="display: none;">
				<div id="new_comment_form">
					<form action="#">
						<h1 class="title"><span>Donner votre avis</span></h1>
			            <div class="row-fluid">
			            	<div class="span6 titled_box">
				                <div class="product clearfix">
				                	<h2 class="product_name"><span><?php echo $titre_pro ; ?></span></h2>
				                    <img src="/uploads/produits_all/7-small_default.jpg" alt="<?php echo $titre_pro ; ?>" />
				                    <div class="product_desc">
				                        <?php echo $description ; ?>
				                    </div>
				                </div>
							</div>
			                <div class="span6 titled_box">
			                    <div class="new_comment_form_content">
			                        <h2><span>Donner votre avis</span></h2>
			        
			                        <div id="new_comment_form_error" class="error" style="display: none;">
			                            <ul></ul>
			                        </div>
				        			 <ul id="criterions_list">
			                            <li>
			                                <label>Quality:</label>
		                                    <div class="star_content">
		                                        <input class="star" type="radio" name="criterion[1]" value="1" />
		                                        <input class="star" type="radio" name="criterion[1]" value="2" />
		                                        <input class="star" type="radio" name="criterion[1]" value="3" checked="checked" />
		                                        <input class="star" type="radio" name="criterion[1]" value="4" />
		                                        <input class="star" type="radio" name="criterion[1]" value="5" />
		                                    </div>
		                                    <div class="clearfix"></div>
		                                </li>
			                        </ul>	                                
			                        <label for="comment_title">Titre: <sup class="required">*</sup></label>
			                        <input id="comment_title" name="title" type="text" value=""/>
			        
			                        <label for="content">Commentaire: <sup class="required">*</sup></label>
			                        <textarea id="content" name="content"></textarea>
			        				<label>Votre nom: <sup class="required">*</sup></label>
			                        <input id="commentCustomerName" name="customer_name" type="text" value=""/>	
			                    </div>
			                </div>
			             </div>
			             <div id="new_comment_form_footer" class=" sendfrend_footer">
		                    <input id="id_product_comment_send" name="id_product" type="hidden" value='3'></input>
		                    <p class="fl required"><sup>*</sup> Champs requis</p>
		                    <p class="fr ">
		                        <button id="submitNewMessage" class="btn btn-inverse" name="submitMessage" type="submit">Envoyer</button>
		                        <input class="btn btn-inverse" type="button" value="Annuler" onclick="$.fancybox.close();" />
		                    </p>
		                    <div class="clearfix"></div>
		                </div>
					</form><!-- /end new_comment_form_content -->
				</div>
			</div>
			<!-- End fancybox -->
		</div> 	
	</section> 
</div>