<span class="lbl_bleu">Envoyé à : </span><?php echo $message['Receiver']['email'] ; ?> <br/>
<span class="lbl_bleu">Objet : </span><?php echo $message['Message']['objet'] ; ?> <br/>
<span class="lbl_bleu">Message : </span><br/>
<p>
<?php echo $message['Message']['message'] ; ?>
</p>