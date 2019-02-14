<div class="inscription_merci">
	<div class="titre_violet">Abonnement confirmé</div> 

	<p><span>Bonjour <?php echo $this->Session->read('Auth.User.username');?> et bienvenue sur SCE !</span></p>
	<br/>
	Dès à présent vous pouvez 
	<ul>
		<li>compléter votre profil en vous rendant sur la page <?php echo $html->link('Mon compte', array('controller' => 'users', 'action' => 'edit'));?></li>
		<li>créer et administrer votre site internet vitrine en vous rendant sur la page <?php echo $html->link('Mon site internet vitrine', array('controller' => 'sites', 'action' => 'index'));?></li>
		<li>Accéder au <?php echo $html->link('SCE Club', array('controller' => 'sceclub' , 'action' => 'index'));?>, le comité d'entreprise virtuelle</li>
		<li>Mettre des produits en vente sur SCE, et faire de l'e-commerce grâce à Paypal</li>
	</ul>

</div>