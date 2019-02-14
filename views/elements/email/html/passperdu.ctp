<p>Bonjour <?php echo $user['username'];?> !</p>

<p>Vous avez perdu le mot de passe de votre compte sur <a href="http://localhost">SCE</a>.<br/>
Pour en obtenir un nouveau, cliquez sur le lien ci-dessous ou copiez-collez cette adresse dans votre navigateur.</p>

<a href="http://www.service-conseil-entreprise.fr/users/nouveaupass/?h=<?php echo $password_key; ?>&amp;id=<?php echo $user['id']; ?>">http://localhost/users/nouveaupass/?h=<?php echo $password_key;?>&amp;id=<?php echo $user['id'];?></a>

Amicalement,
SCE