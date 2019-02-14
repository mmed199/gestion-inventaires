 <div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Gestion des indemnités</h2>
                <p class="sub-title">La gestion des indemnites pour les utlisateurs.</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="/admin"><i class="fa fa-home"></i>Accueil</a> </li>
                    <li><a href="/admin/gestion-rh.html">Gestion RH</a> </li>
                    <li><a href="/admin/gestion-dépenses.html">Gestion des dépenses</a> </li>
                    <li class="active">Gestion des indemnités</li>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
	    <div class="container-fluid">

	        <div class="row">
	            <div class="col-md-6">
	                <div class="panel">
	                    <div class="panel-heading">
	                        <div class="panel-title">
	                            <h5>Indemnité</h5>
	                        </div>
	                    </div>
	                    <div class="panel-body">
	                    <!-- Pour afficher les messages d'erreur -->
	                    <?php echo $session->flash() ; ?>

							<?php echo $form->create('Indemnite',array(
																	'url'=>array('action'=>'ajouter'),
																	'class'=>'col-md-10 col-md-offset-1',
																	));?>




















								
	                        	<div class="form-group">
	                        		<select>
										<?php foreach ($members as $m) :?>
										<tr>


 <td><?php echo $m['Member']['id'] ; ?></td>
                                                                <td><?php echo $m['Member']['cin'] ; ?></td>
                                                                <td><?php echo $m['Member']['nom'] ; ?><?php echo $m['Member']['prenom'] ; ?></td>
                                                                <td><?php echo $m['Member']['grade'] ; ?></td>
                                                                <td><?php echo $m['Division']['nom'] ; ?></td>
                                                                <td>
<?php echo ($m['Member']['status'] == 0 ?"<span class='label label-warning label-wide'> En cours </span>"  : "<span class='label label-success label-wide'> Terminé </span>" ); ?>


  </td>
 
                                                                <td>
                                                                    <a href="/admin/members/afficher/<?php echo $m['Member']['id'] ; ?>" title ="Afficher"> 

</td>
</tr>
<?php echo '<option>'. $m['Member']['cin']. ' - '. $m['Member']['nom']. ' '. $m['Member']['prenom']. '</option>'; ?>
                                          
                                       <?php endforeach ;?>
                                   
										</select>


   
                                     </div>
				                <div class="form-group">
									<label for="date_debut">Date début:</label>
									<div id="datetimepicker9" class="input-group date">
										<?php echo $form->input('Indemnite.date_debut',array(
																							'label'=>false,
																							'type'=>"text",
																							'class'=>'form-control date_picker',
																							'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
				                <div class="form-group">
									<label for="date_fin">Date fin:</label>		
									<div id="datetimepicker9" class="input-group date">
										<?php echo $form->input('Indemnite.date_fin',array(
																						'label'=>false,
																						'type'=>"text",
																						'class'=>'form-control date_picker',
																						'div'=>false) ) ; ?>
										<span class="input-group-addon" style="">
											<span class="fa fa-calendar"> </span>
										</span>
									</div>
								</div>
				                <div class="form-group">
									<label for="commentaire">objet:</label>
									<div class="panel-body">
										<?php echo $form->input('Indemnite.objet',array(
																							'label'=>false,
																							'rows'=>'10',
																							'cols'=>'80',
																							'class'=>'form-control',
																							'id'=>'editor1',
																							'div'=>false) ) ; ?>
									</div>
									
								
	                        	<button class="btn btn-primary pull-right mt-10" type="submit"> Ajouter </button>
	                        </form>

	                        <!-- /.col-md-12 -->
	                       </div>
	                    </div>
	                </div>
	            </div>
	            <!-- /.col-md-6 -->
	        </div>
	        <!-- /.row -->
	    </div>
	    <!-- /.container-fluid -->
	</section>
	<!-- /.section -->
</div>
 <script>
   $('#datetimepicker9 .date_picker').datepicker({
        format: "dd/mm/yyyy",
        language: "fr",
        orientation: "bottom right",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });
    
</script>