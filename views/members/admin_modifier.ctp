<h2>Modifier le membre </h2>
<?php 
    $civilites =array('1'=>'Monsieur','2'=>'Madame','3'=>'Mademoiselle') ;
    $compte_types =array('0'=>'Particulier','1'=>'Professionnel') ;
    $attrs = $this->requestAction('/members/getCriteresRecherche') ;
    $categories = $attrs['categories'] ;
    $types = $attrs['types'] ;
	
?>
<div class="form">
            <?php echo $form->create('Member',array('id'=>'formID','class'=>"niceform",'type'=>'file')); ?>
                <fieldset>
                    <dl>
                        <dt><label for="nom">Civilité : </label></dt>
                        <dd>
                            <?php echo $form->input('civilite',array(
                                            'label'=>false,
                                            'type' => 'select',
                                            'options' => $civilites,
                                            'name'=>'data[Member][civilite]',
                                            ));?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="nom">Nom : </label></dt>
                        <dd><?php echo $form->input("Member.nom", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"25")); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="prenom">Prénom : </label></dt>
                        <dd><?php echo $form->input("Member.prenom", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"25")); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">E-mail : </label></dt>
                        <dd><?php echo $form->input("Member.email", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"40")); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="logo"></label></dt>
                        <dd>
                            <img alt="<?php echo $this->data['Member']['username'] ; ?>" style="width:200px;" class="img-polaroid" title="<?php echo $this->data['Member']['username'] ; ?>" src="<?php echo '/uploads/members/'.$this->data['Member']['logo'] ; ?>" >
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="logo">Logo : </label></dt>
                        <dd><?php echo $form->input('logo', array('type' => 'file','label' =>'' ));?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="type_compte">Type de compte : </label></dt>
                        <dd><?php echo $form->input('type_compte',array(
											'label'=>false,
											'type' => 'select',
											'options' => $compte_types,
											'name'=>'data[Member][type_compte]',
											));?>
                        </dd>
                    </dl>
                    <?php //echo $compte_types[0]; ?>
                    <?php if ($compte_types[0]="Professionnel") { ?>                    
                    <dl>
                        <dt><label for="societe">Nom de la société : </label></dt>
                        <dd><?php echo $form->input("Member.societe", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"70")); ?>
                        </dd>
                    </dl>                   
                    <dl>
                        <dt><label for="titre_annuaire">Titre annuaire des pro : </label></dt>
                        <dd><?php echo $form->input("Member.titre_annuaire", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"70")); ?>
                        </dd>
                    </dl>                  
                    <dl>
                        <dt><label for="description">Description : </label></dt>
                        <dd><?php echo $this->Form->textarea("Member.description", array("class"=>" validate[required] newfleurinput ","label"=>false,'div' =>false,'cols' => 50,'rows' => 8)); ?>
                        </dd>
                        <dd><br></dd>
                    </dl>   
                    <dl>
                        <dt><label for="rc">Numéro R.C : </label></dt>
                        <dd><?php echo $form->input("Member.rc", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"25")); ?>
                        </dd>
                    </dl> 
                    <dl>
                        <dt><label for="pcategory_id">Secteur d'activité : </label></dt>
                        <dd>
                            <?php echo $form->input('Member.pcategory_id',array(
                                                'type' => 'select',
                                                'options' =>$categories,
                                                'onChange'=>'updateTypes(this.value);',
                                                'name' => 'data[Member][pcategory_id]', 
                                                'label' =>false));?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for=""></label></dt>
                        <dd>Type : ( <?php echo $this->data['Ptype']['nom']; ?> )</dd>
                        <dd><br></dd>
                    </dl>
                    <dl>
                        <dt><label for="ptype_id">Type d'activité : </label></dt>
                        <dd>
                            <?php echo $form->input('Member.ptype_id',array(
                                                'type' => 'select',
                                                'options' =>$types, 
                                                'label' =>false));?>
                        </dd>
                    </dl>
                    <?php } ?>
					<dl>
                        <dt><label for="telephone">Téléphone bureau: </label></dt>
                        <dd><?php echo $form->input("Member.telephone", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"25")); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="mobile">Téléphone portable: </label></dt>
                        <dd><?php echo $form->input("Member.mobile", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"25")); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="adresse">Adresse : </label></dt>
                        <dd><?php echo $form->input("Member.adresse", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"100")); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="adresse">Adresse suite : </label></dt>
                        <dd><?php echo $form->input("Member.adresse_suite", array("class"=>" validate[required] newfleurinput ","label"=>false,"size"=>"100")); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="ville">Ville : </label></dt>
                        <dd>
                            <?php echo $form->input('Member.city_id',array("class"=>" validate[required] newfleurinput ",'type' => 'select','options' =>$villes, 'label' =>false));?>
                        </dd>
                    </dl>
                    <dl class="submit">
                     <?php echo $form->end("Modifier"); ?>
                     </dl>                    
                </fieldset> 
         </form>
 </div> 
<script type="text/javascript" language="javascript">
    function updateTypes(pcategory_id){
        $.ajax({
            url:'/members/getTypeByCategorieId/'+pcategory_id,
            dataType: "text" ,
            success: function(data) {
                $('#MemberPtypeId').empty();
                $('#MemberPtypeId').html(data);         
            }
        }) ;
    }
</script>