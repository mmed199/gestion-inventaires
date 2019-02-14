<div class="inscription">
<div class="titre_violet">Inscription</div>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="50%" align="left">
			<div class="bloc">
				<div class="titre">
					Je suis un particulier
				</div>
				<div class="texte">
					<p>SIMPLE, RAPIDE, PRATIQUE, ECONOMIQUE</p>
					Retrouvez toute l'année les soldes, déstockages, bons plans, promotions et bonnes affaires offerts par les boutiques de votre ville et région.
					<ul>
						<li>Achetez 24h/14 et 7j/7 </li>
						<li>Grands choix de bons produits, shopping facile</li>
						<li>Disponibilité immédiate des produits</li>
						<li>Pas de file d'attente</li>
						<li>Achetez rapidement sans sortir de chez vous</li>
					</ul>
				</div>
				<div class="bouton"><?php echo $html->link('Je m\'inscris', array('controller' => 'users', 'action' => 'register'));?></div>
			</div>
		</td>
		<td align="right">
			<div class="bloc">
				<div class="titre">
					Je suis un professionnel
				</div>
				<div class="texte">
					<p>Développez votre entreprise sur le web grâce à notre outil e-commerce très simple :</p>
					<ul>
						<li>Soyez présent 24h/24 et référencé sur Internet</li>
						<li>Dynamisez vos ventes</li>
						<li>Développez votre notoriété</li>
						<li>Trouvez de nouveaux clients</li>
						<li>Fidélisez vos clients</li>
						<li>Générez plus de contacts</li>
						<li>Offrez plus de services</li>
						<li>Gérez votre image de marque</li>
						<li>Rejoignez un réseau de commerçants locaux et nationaux</li>
					</ul>
					<p>Bénéficiez de l'accompagnement d'un animateur conseil dans votre région pour améliorer les performances commerciales de votre entreprise</p>
				</div>
				<div class="bouton"><?php echo $html->link('Je m\'abonne', array('controller' => 'abonnements', 'action' => 'etape1'));?></div>
			</div>
		</td>
	</tr>
</table>

</div>