<p>Merci de nous avoir contacté. Voici la copie de ce que va recevoir notre administrateur :</p>
<p>Date : <?php e(date('d/m/Y H:i')); ?></p> 
<p>Envoyé par : <?php e($data['Contact']['nom'].' '.$data['Contact']['prenom']); ?></p>
<p>Adresse email : <?php e($data['Contact']['email']); ?></p> 
<p>Message : <?php e($data['Contact']['message']); ?>