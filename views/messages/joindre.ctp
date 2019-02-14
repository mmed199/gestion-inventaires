<?php 
	$site_name = Configure::read('site_name');
	$this->set('page_title',"Nous rejoindre |  " . $site_name) ; 
	//$this->set ('meta_robots',"noindex,follow");
?>
<?php echo $html->script(array('jquery.valid8','nous-rejoindre')); ?>
<div id="main">
	<h2 class="pagetitle"><?php __d('messages',"Nous rejoindre") ; ?></h2>
	<div id="main-block">
        <div id="contact">
			<h2>
				<img style="float: right; height: 201px; width: 300px;" src="http://www.Services4all.be/uploads/images/Services4all-joindre2.png" alt="">
			</h2>
			<h2>
				<img width="341" height="152" style="float: left;" src="http://www.Services4all.fr/img/Services4all/contact-liste-bijoux-Services4all.jpg" alt="liste bijou catalogue Services4all">
			</h2>
			<br><br>
			<br><br>
			<br><br>
			<br><br>
			<br><br>
			<br><br>
			<h2><?php __d('messages',"Devenir agent commercial") ; ?></h2>
			<br><br>
			<p><?php __d('messages',"Exercer un métier qui vous plaît !") ; ?> <?php __d('messages',"A temps partiel ou à temps complet,") ; ?> <?php __d('messages',"c'est vous qui choisissez !") ; ?>
				<strong>Services4all & Co</strong>
				<?php __d('messages',"recherche toute l'année des agents commerciaux dans toute la France.") ; ?> <?php __d('messages',"Formation assurée (sur les produits, les techniques de vente etc..)") ; ?>
			</p>
			<br><br>
			<p><?php __d('messages',"Nos bijoux sont généralement distribués dans les boutiques spécialisées comme les coiffeurs,") ; ?> <?php __d('messages',"les bijouteries, les boutiques d’accessoires de mode mais aussi dans les ventes par réunion.") ; ?></p>
			<br><br>
			<h2><?php __d('messages',"Poste et missions") ; ?></h2>
			<br><br>
			<p><?php __d('messages',"Votre principale mission est d'assurer la relation client et développer") ; ?> <?php __d('messages',"le volume de nos ventes avec la construction de votre réseau local.") ; ?>  <?php __d('messages',"Vous serez notamment en charge de :") ; ?></p><br>
			<ul>
				<li>> <?php __d('messages',"Cibler les entreprises, et/ou les commerces spécialisés dans votre région.") ; ?></li>
				<li>
					> <?php __d('messages',"Prospecter sur RDV.") ; ?>
					<img style="float: right; width: 200px; height: 150px;" src="http://www.Services4all.be/uploads/images/Services4all-joindre3.png" alt="">
				</li>
				<li>> <?php __d('messages',"Réaliser l'ensemble des tâches administratives liées à votre activité commerciale.") ; ?></li>
				<li>> <?php __d('messages',"Assurer les réunions bijoux/ventes expos ainsi que le suivi client avec vos boutiques.") ; ?> </li>
			</ul>
			<br />
			<p><?php __d('messages',"Envoyer son CV") ; ?></p>
			<?php echo $form->create('Message',array('id'=>'MessageJoindreForm','enctype'=>'multipart/form-data','url'=>array('action'=>'joindre')));	?>
				<div class="formulaire">
					<?php if( !$this->Session->check('Auth.Member.id') ) : ?>
					<?php e($form->input('prenom', array("class" => "validate[required] input-150",'label' =>__d('messages',"Prénom :",true), 'size' => 70))); ?>
					<?php e($form->input('nom', array("class" => "validate[required] input-150",'label' =>__d('messages',"Nom :",true)." <span class='red'>*</span>" , 'size' => 70))); ?>
					<?php echo $form->input("email", array("class"=>"validate[custom[email]]  inputl","label"=>__d('messages',"Adresse e-mail :",true)." <span class='red'>*</span>","placeholder"=>"")); ?>
					<?php else: ?>
					<?php e($form->hidden('nom', array('value'=>$this->Session->read('Auth.Member.nom') ))); ?>
					<?php e($form->hidden('prenom', array('value'=>$this->Session->read('Auth.Member.prenom') ))); ?>
					<?php echo $form->hidden("email", array('value'=>$this->Session->read('Auth.Member.email')  )); ?>
					<?php endif; ?>
					<div>
					<label for="message"><?php __d('messages',"Votre message :") ; ?> <span class="red">*</span></label>
					<?php e($form->textarea('message', array("class" => "validate[required]", 'cols' => 48, 'rows' => 11))); ?> 
					<?php e($form->input('document', array("type"=>"file", "class" => "validate[required] input-150",'label' =>__d('messages',"Document à joindre (CV,...) :",true)." <span class='red'>*</span>"))); ?>
					
					<div class="error"></div>
					<center>
						<div style="margin-bottom: 105px; margin-top: 25px;" id="creercompte_btn"><a href="#" onclick="$('#MessageJoindreForm').submit();" ><?php __d('messages',"Envoyer") ; ?></a></div>
					</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


