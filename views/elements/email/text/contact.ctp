Date : <?php echo date('d/m/Y H:i'); ?>
Envoyé par : <?php echo $data['Contact']['nom'].' '.$data['Contact']['prenom']; ?>
Adresse email : <?php echo $data['Contact']['email']; ?>
Message : <?php echo $data['Contact']['message']; ?>