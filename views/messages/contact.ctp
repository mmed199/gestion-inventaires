<?php 
	$site_name = Configure::read('site_name');
	$this->set('page_title',"Nous contacter ~ " . $site_name) ; 
	$this->set ('meta_robots',"noindex,follow");
?>
<?php echo $html->script(array('jquery.valid8','nous-contacter')); ?>

 
<!-- 
<div class="loader_page">
  <aside id="left_column" class="span3 column" style=" display:none"> </aside>
  <div id="center_column" class="center_column span9 clearfix"> -->

  <div class="breadcrumb">
    <div class="breadcrumb_inset">
      <a class="breadcrumb-home" rel="tooltip" title="" href="/" data-original-title="retour à Accueil"><i class="icon-home"></i></a>
      <span class="navigation-pipe">></span>
      <span class="navigation_page">Contact</span>
    </div>
  </div>
  <h1>
    <span>Service client - Contactez-nous</span>
  </h1>
  <?php echo $session->flash() ; ?>
  <p class="title-pagecontact">
    <i class="icon-comment-alt"></i> Vous avez une question, une suggestion... vous cherchez une information ? <br>
    N'hésitez pas à nous contacter en remplissant le formulaire ci-dessous. <br>
    Nous nous engageons à vous répondre dans les plus brefs délais.
  </p>
  <div class="comment-field">
    <?php echo $form->create('Message',array('action'=>'contact','id' => 'submitMessage','class'=>'form-horizontal')); ?>      
      <h2>
       <span>Envoyez un message</span>
      </h2>
      <div class="control-group span6">
        <label class="control-label" for="objet">Objet<sup> * </sup>:</label>
        <div class="controls input-min-large">
          <?php echo $form->input('objet',array(
                            'label' =>false,
                            'type' => 'text',
                            'size' => '40',
                            'class'=>'input-xxlarge',
                            ));?>
        </div>
      </div>
      <?php if( !$this->Session->check('Auth.Member.id') ) : ?>
      <div class="control-group span6">
        <label class="control-label" for="nom">Votre nom<sup> * </sup>:</label>
        <div class="controls input-min-large">
          <?php echo $form->input('nom',array(
                            'label' =>false,
                            'type' => 'text',
                            ));?>
        </div>
      </div>
      <div class="control-group span6">
        <label class="control-label" for="email">Votre adresse e-mail<sup> * </sup>:</label>
        <div class="controls input-xxlarge">
          <?php echo $form->input('email',array(
                            'label' =>false,
                            'type' => 'text',
                            ));?>
        </div>
      </div>
      <?php else: ?>
        <?php e($form->hidden('nom', array('value'=>$this->Session->read('Auth.Member.nom') ))); ?>
        <?php echo $form->hidden("email", array('value'=>$this->Session->read('Auth.Member.email')  )); ?>
      <?php endif; ?>      
      <div class="control-group span6">
        <label class="control-label" for="message">Message<sup> * </sup>:</label>
        <div class="controls input-min-large">
          <?php echo $form->input('message',array(
                            'label' =>false,
                            'type' => 'text',
                            'cols' => '10',
                            'rows' => '6',
                            ));?>
        </div>
      </div>
      <p class="cart_navigation required submit">
        <input id="submitMessage" class="exclusive" type="submit" onclick="$(this).fadeOut('slow');" value="Envoyer" name="submitMessage">
        <span>
          <sup>*</sup>
          Champs obligatoires
        </span>
      </p>
      <p class="text">
        Si vous êtes un professionnel et que vous souhaitez créer un partenariat avec Services4all, écrivez-nous à : <a href="mailto:contact@services4all.fr">contact@services4all.ma</a>.
      </p>    
  </form>
</div>