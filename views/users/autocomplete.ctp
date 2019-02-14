<ul>
<?php foreach($code_postal as $cp): ?> 
	 <li><?php echo $cp['FranceVille']['cp']/*.' '.$cp['FranceVille']['nom'].', '.$cp['FranceDepartement']['nom_departement'];*/?></li>
<?php endforeach;?> 
</ul>