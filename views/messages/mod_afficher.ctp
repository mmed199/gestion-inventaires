Envoyé Par : <?php echo $message['Message']['nom'] ; ?> <br/>
Email: <?php echo $message['Message']['email'] ; ?> <br/>
Message : <br/>
<p>
<?php echo $message['Message']['message'] ; ?>
</p>
<br/>

<a href="/mod/messages/repondre/<?php echo $message['Message']['id'] ; ?>" title="Répondre" >
	<img src="/img/mod/repondre.png" > Répondre
</a>