<?php 
	$site_name =Configure::read("site_name");
	$this->set ('page_title','Mo profil ~ ' . $site_name );
?>
<div class="breadcrumb">
	<div class="breadcrumb_inset">
		<a class="breadcrumb-home" rel="tooltip" title="" href="/" data-original-title="retour à Accueil">
		<i class="icon-home"></i>
		</a>
		<span class="navigation-pipe">></span>
		<span class="navigation_page">Mon compte</span>
	</div>
</div>	
<br>	
<!-- Menu member -->
<?php echo $this->element('members/nav-member') ; ?>
<!-- /Menu member -->
<?php echo $session->flash() ; ?>
<h1>
	<span><h6>Mon profil</h6></span>
</h1>
<div id="center_column" class="center_column span9 clearfix">		
	<div class="titled_box">
		<div id="pb-right-column" class="span2">									
			<div id="image-detail">					
				<span>
					<img alt="<?php echo $member['Member']['username'] ; ?>" class="img-polaroid" title="<?php echo $member['Member']['username'] ; ?>" src="<?php echo '/uploads/members/'.$member['Member']['logo'] ; ?>" >
             	</span>
             	<div class="link-editLogo"><a href="/member/members/edit_photo/<?php echo $member['Member']['id'] ; ?>"><i class="icon-edit" title="Modifier mon image"> Modifier mon image</i></a></div>
			</div> 
		</div> 
		<div id="pb-left-column" class="span5">
			<div id="detail_block">          		       				
    			<blockquote> 	
					<p><em><b><?php echo  ($member['Member']['civilite'] == 1 ? 'M.': ( $member['Member']['civilite'] == 2? 'Mme':'Mlle'));?> <?php echo $member['Member']['nom']; ?> <?php echo $member['Member']['prenom']; ?></b></em></p>  
				</blockquote>
				<blockquote> 
					<p><b>Type de compte : </b><em><?php  
											if ($member['Member']['type_compte']==0){ echo 'Particulier' ;}
											if ($member['Member']['type_compte']==1){ echo 'Professionnel' ;}
										     ?></em></p> 
				</blockquote>
				<blockquote> 
					<p><b>Adresse e-mail : </b><em><?php echo $member['Member']['email'] ; ?></em></p> 
				</blockquote>
				<?php if ($member['Member']['type_compte']==1){ ?>
				<blockquote> 
					<p><b>Société : </b><em><?php echo nl2br($member['Member']['societe']);?> -R.C : <?php if(!empty($member['Member']['rc'])){ ?><?php echo $member['Member']['rc'];?><?php }else echo "--" ;?> / <?php echo $member['City']['nom']?>-</em> <?php if($member['Member']['verified']==0){ ?><a href="/mon-profil/verifier/<?php echo $member['Member']['id'] ; ?>.html"><span id="link-verifier"><i class="icon-forward"></i> Vérifier <i class="icon-question-sign"></i></span></a><?php }; ?></p> 
				</blockquote>
				<blockquote> 
					<p><b>Secteur d'activité : </b><em><?php echo nl2br($member['Ptype']['nom']);?> (<?php echo nl2br($member['Pcategory']['nom']);?>)</em></p> 
				</blockquote>
				<blockquote> 
					<p><b>Titre annuaire des pro. : </b><em><?php echo nl2br($member['Member']['titre_annuaire']);?></em></p> 
				</blockquote>
				<blockquote> 
					<p><b>Description : </b><br><em><?php echo nl2br($member['Member']['description']);?></em></p> 
				</blockquote>
				<?php } ?>
				<blockquote> 
					<p><b>Téléphone : </b><em><?php echo $member['Member']['telephone'] ; ?></em></p> 
				</blockquote>
				<blockquote> 
					<p><b>GSM : </b><em><?php echo $member['Member']['mobile'] ; ?></em></p> 
				</blockquote>
				<blockquote> 
					<p><b>Adresse : </b><em><?php echo $member['Member']['adresse'] ; ?> <?php echo $member['Member']['adresse_suite'] ; ?> - <?php echo $member['City']['nom'] ; ?> </em></p> 
				</blockquote>
				<span class="link-editProfil"><a href="/member/members/editProfil/<?php echo $member['Member']['id'] ; ?>"><i class="icon-edit" title="Modifier ou compléter vos informations de profil">  Modifier ou compléter vos informations de profil</i></a></span>
			</div>
		</div>
	</div>
</div>