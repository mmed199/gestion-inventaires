<?php 
	$site_url = Configure::read('site_url');
	$site_name = Configure::read('site_name');
?>
<div style="width:800px;">
	<div style="display:block; width:600px; margin:30px auto; text-align:justify;">
		<p>Bonjour <?php echo $absence['Member']['prenom'] ; ?> <?php echo $absence['Member']['nom'] ; ?>,</p>
		<p class="justify">Votre demande de <?php echo $absence['Typeabsence']['title']; ?> de l'année <?php echo $absence['Annee']['titre']; ?> à été 
			<?php if($absence['Absence']['decision']==3) {?> <!-- Refusée = 3 / Accord Partiel = 2  / Accordée = 1 / En cours de tratement = 0 par default -->

                <span class='label label-danger label-wide'> refusée </span>

                <?php }else if ($absence['Absence']['decision']==2) { ?>

                <span class='label label-warning label-wide'> accordée partiellement </span>
               <br> <strong>Remarque de la décision :</strong><br>
                <span><?php echo $absence['Absence']['remarque'] ; ?></span>
                
                <?php }else if ($absence['Absence']['decision']==1) { ?>
               
                <span class='label label-success label-wide'> accordée </span>
                
            <?php } ?> 
		.</p>
		<br>
		<p>Vous pouvez accéder à votre espace utilisateur :</p>
		<p><a href='<?php echo $site_url;?>'><?php echo $site_url;?></a></p>
		<br>
		<p>
		-- 
		<br>
		Cordialement,
		<br>
		<a href='<?php echo $site_url;?>'><?php echo $site_name;?></a>
		</p>
	</div>
</div>