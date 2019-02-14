<?php $site_url = Configure::read("site_url"); ?>
<div class="navbar">
	<div class="navbar-inner">
		<ul class="nav">
			<li>
				<a href="<?php echo $site_url; ?>/mon-compte.html"><span><i class="icon-home"></i> Accueil</span></a>
			</li>
			<li class="divider-vertical"></li>
			<li>
				<a title="Mon profil" href="/mon-profil.html">
					<span><i class="icon-user"></i> Mon profil</span>
				</a>
			</li>
			<li class="divider-vertical"></li>
			<li>
				<a title="Mes annonces" href="/mes-annonces.html">
					<span><i class="icon-asterisk"></i> Mes annonces</span>
				</a>
			</li>
			<li class="divider-vertical"></li>
			<li>
				<a title="Messages" href="/messages.html">
					<span><i class="icon-list-alt"></i> Messages</span>
				</a>
			</li>
			<li class="divider-vertical"></li>
			<li>
				<a title="Mes favoris" href="/mes-favoris.html">
					<span><i class="icon-star"></i> Mes favoris</span>
				</a>
			</li>
			<li class="divider-vertical"></li>
			<li>
				<a title="Parrainage" href="/parrainage.html">
					<span><i class="icon-globe"></i> Parrainage</span>
				</a>
			</li>
			<!-- 
			<li>
				<a title="Adresses" href="#">
					<img class="icon" alt="Adresses" src="/img_all/icon-membre/addrbook.png">
					Mes adresses
				</a>
			</li>
			<li>
				<a title="Informations" href="#">
					<img class="icon" alt="Informations" src="/img_all/icon-membre/userinfo.png">
					Mes informations personnelles
				</a>
			</li>
			 -->
		</ul>
	</div>
</div>