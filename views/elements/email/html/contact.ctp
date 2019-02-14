<p>Merci de nous avoir contact&eacute;. Voici la copie de ce que va recevoir notre administrateur :</p>
<p>Date : <?php echo date('d/m/Y H:i'); ?></p> 
<p>Envoyé par : <?php echo $data['Contact']['nom'].' '.$data['Contact']['prenom']; ?></p>
<p>Adresse email : <?php echo $data['Contact']['email']; ?></p> 
<p>Message : <?php echo nl2br($data['Contact']['message']); ?></p>