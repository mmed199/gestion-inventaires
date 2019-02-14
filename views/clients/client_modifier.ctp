
<?php
	$this->set('page_title', __("Modifier mes coordonnées",true) .' | ' . __('Espace client',true));
	$languages = Configure::read('Config.languages') ;
?>
<style>
.block-compte-left form label {display: inline-block;
    height: 25px;
    padding-right: 10px;
    text-align: right;
    width: 217px;}
.block-compte-left form select {margin-left: -5px;}
.block-compte-left form input[type="submit"] {margin-left: 230px;}
.email{width: 250px;}

</style>
<div class="block-compte-left">
<h1><?php echo __("Modifier mes coordonnées",true);?></h1>
<br>
<?php echo $form->create('Client'); ?>
<label class="lblClient">Civilité :</label>
<select name="data[Client][civilite]" >
<option value="" <?php if($this->data['Client']['civilite'] == "" ) echo 'selected'; ?> >Choisir...</option>
<option value="<?php __('Mr') ; ?>" <?php if($this->data['Client']['civilite'] == __("Mr",true) ) echo 'selected'; ?> >Mr</option>
<option value="<?php __('Mme') ; ?>" <?php if($this->data['Client']['civilite'] == __("Mme",true)) echo 'selected'; ?> >Mme</option>
<option value="<?php __('Mlle') ; ?>" <?php if($this->data['Client']['civilite'] == __("Mlle",true) ) echo 'selected'; ?> >Mlle</option>
</select>
<?php echo $form->input('nom',array('label'=>"Nom: ",'class'=>'validate[required]' )) ; ?>
<?php echo $form->input('prenom',array('label'=>"Prénom: ",'class'=>'validate[required]' )) ; ?>
<?php echo $form->input('email',array('label'=>"Adresse mail: ",'class'=>'validate[required] email' )) ; ?>
<?php echo $form->input('societe',array('label'=>"Société: " )) ; ?>
<?php echo $form->input('adresse',array('label'=>"Adresse: " )) ; ?>
<?php echo $form->input('ville',array('label'=>"Ville: " )) ; ?>
<?php echo $form->input('pays',array('label'=>"Pays: " )) ; ?>
<label class="lblClient">Langue par défaut: </label>
<select name="data[Client][lang]" >
<option value="" <?php if($this->data['Client']['lang'] == "" ) echo 'selected'; ?> >Choisir...</option>
<?php foreach($languages as $k=>$v): ?>
<option value="<?php echo $k ; ?>" <?php if($this->data['Client']['lang'] == $k ) echo 'selected'; ?> ><?php echo $k; ?></option>
<?php endforeach; ?>
</select>
<br><br>
<label class="lblClient"></label><?php echo $form->end(__('Enregistrer',true)) ; ?>
</div>