<?php 
	$this->set ('page_title','Vendre vos articles de vêtement marque enfant sur Kidsdressing – Mode enfant');
	$this->set ('page_description',"Vendre vos articles : vêtements, chaussures et accessoires pour enfant sur Kidsdressing le spécialisite de mode enfant");
?>
<div id="main">
	<h2 class="pagetitle">Vendre un article :</h2>	
	<div style="color: #333333; font-size: 13px;text-align: justify;">
		<p>
		Chez Kidsdressing, nous proposons la vente de vêtement enfant, accessoires et décoration chambre enfant. 
		Vous pouvez utiliser Kidsdressing comme un depot vente vetement enfant ou pour la vente privée enfant. La communauté Kidsdressing comprend plus de 5000 membres, tous passionnés par la mode enfantine. La communaute comprend maman, <b>boutique vetement enfant</b>, <b>magasin vetement enfant</b>, <b>depot vente vetement enfant</b> et <b>créateur de mode enfant</b>. Plus de 60 pros et créateurs proposent leurs dernières collection ou bien des vêtements de marque enfant, la décoration chambre enfant et les accessoires de mode.
		</p>
		<br>
		<p>
		Pour cela rien de plus simple! Apres avoir crée votre profil vous pouvez soumettre vos articles qui seront vérifiés et validés par notre équipe.
		Les articles peuvent être neufs ou d'occasion parmi les 200 marques proposés par Kidsdressing.
		</p>
		<br>
		<p>
		Les magasins et boutique vetement enfant et créateurs mode enfantine peuvent ajoutés plusieurs tailles, couleurs, quantités pour un même article.
		Si une type de vetement, accessoire, chaussure ou décoration vient à manquer, nous vous invitons à nous contacter sur contact@kidsdressing.com.
		</p>
	</div>
	<div id="connexion-col-1">
    	<div id="connexion-col-1-row-1">
        	<h3 class="pink">Vous avez déjà un compte Kids Dressing</h3>
			<?php echo $form->create('Member',array('url'=>array('action'=>'connexion'))); ?>
				<p><?php echo $form->label('email',"E-mail :",array('div'=>false,'style'=>'width:110px;display:inline-block')) ;  ?>
					<?php echo $form->input('email',array('label'=>false,'class'=>'inputl','div'=>false,'style'=>'display:inline-block') ) ; ?>
				</p>
                <p>
					<?php echo $form->label('password',"Mot de passe :",array('style'=>'width:110px;display:inline-block')) ;  ?>
					<?php echo $form->input('password',array('label'=>false,'div'=>false,'style'=>'display:inline-block') ) ; ?>
				</p>
                <div class="error">				</div>				
	            <div id="connexion_btn"><?php echo $form->submit(" Valider ") ; ?></div>
                <p id="oubli-lnk"><a href="/mot-de-passe-oublie.html">Vous avez oublié votre mot de passe ?</a></p>
				<?php echo $form->end() ; ?>
            </form>
        </div>
    	<div id="connexion-col-1-row-2">
        	<a href="/parrainage.html"><img src="/img/parrainage-block.png" alt="Parrainez vos amis !"></a>
        </div>
    </div>
    <div id="connexion-col-2">
    	<div id="connexion-col-2-row-1">
        	<h3 class="pink">Créez votre compte gratuitement !</h3>
            <p><img src="/img/etoile.png" alt="*"> Profitez de nos services : Commandes, parrainages,...</p>
            <p><img src="/img/etoile.png" alt="*"> Achetez &amp; Vendez vos produits en toute confiance</p>
            <div id="creercompte_btn"><a href="/inscription.html">Créer un compte</a></div>
        </div>
    	<div id="connexion-col-2-row-2">
        	<img src="/img/suiveznous-block.png" alt="Suivez-nous !">
            <a id="lnk-fb" href="http://www.facebook.com/kidsdressingfan" target="_blank">Facebook</a>
            <a id="lnk-tw" href="http://www.twitter.com/kidsdressing" target="_blank">Twitter</a>
            <a id="lnk-gg" href="https://plus.google.com/u/0/117575652998997103808/posts" target="_blank">Google</a>
            <a id="lnk-yt" href="http://www.youtube.com/user/KidsDressing" target="_blank">Youtube</a>
        </div>
    </div>
    <div class="clear"></div>
</div>