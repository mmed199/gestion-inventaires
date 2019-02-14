<h2>Modifier informations client</h2>
<div class="form">
            <?php echo $form->create('Client',array('id'=>'formID','class'=>"niceform",'enctype'=>'multipart/form-data','url'=>array('action'=>'modifier'))); ?>

                <fieldset>
                    <dl>
                        <dt><label for="email">Nom :</label></dt>
                        <dd><?php echo $form->input("Client.nom", array("label"=>false)); ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Prénom :</label></dt>
                        <dd><?php echo $form->input("Client.prenom", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Date naissance :</label></dt>
                        <dd>
							<?php echo $form->input('Client.date_naissance',array("class"=>" validate[required] newfleurinput ",'label'=>false,'type'=>'text','id'=>'calendar1','readonly'=>'readonly'));?>
							<img src="/_admin/images/calendar/cal.gif" style="cursor: pointer;" onclick="javascript:NewCssCal('calendar1','yyyyMMdd','dropdown',false)" />	
						</dd>
                    </dl>
					<dl>
                        <dt><label for="email">Téléphone :</label></dt>
                        <dd><?php echo $form->input("Client.tel", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Statut :</label></dt>
                        <dd><?php echo $form->input("Client.statut", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Adresse :</label></dt>
                        <dd><?php echo $form->input("Client.adresse", array("label"=>false)); ?>
                        </dd>
                    </dl> 
					<dl>
                        <dt><label for="email">Pays :</label></dt>
                        <dd><?php echo $form->input("Client.paysCli", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="email">Tél. :</label></dt>
                        <dd><?php echo $form->input("Client.tel", array("label"=>false)); ?>
                        </dd>
                    </dl> 
					<dl>
                        <dt><label for="email">GSM :</label></dt>
                        <dd><?php echo $form->input("Client.tel_port", array("label"=>false)); ?>
                        </dd>
                    </dl>
					<br/>
                    
                     <dl class="submit">
                     <?php echo $form->end(" Modifier "); ?>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
 </div>
 