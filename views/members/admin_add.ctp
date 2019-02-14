<h2>Ajouter image</h2>
<div class="content-box">
	<div class="content-box-content" style="display: block;">
		<div style="display: block;">
			<?php echo $form->create('Motoimage',array('enctype'=>'multipart/form-data','class'=>"niceform",'url'=>array('action'=>'add'))); ?>
				<?php echo $form->hidden('moto_id') ; ?>
				<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
					<!-- <input id="ActimageActivityId" type="hidden" name="data[Motoimage][activity_id]"> -->
					<p>
						<?php e($form->input("Motoimage.title", array("class"=>"text-input small-input",
																  "label"=>"Titre",
															      "id"=>"small-input"))); ?>
					</p>

					<p>             
						<?php echo $form->input('Motoimage.imagePre',array('type' => 'file', 'label' =>false));?>
					</p>
					
					<p>
						<input class="button" type="submit" value=" Ajouter " />
					</p>
					
				</fieldset>
				
				<div class="clear"></div><!-- End .clear -->
				
			</form>
		</div>
	</div>
</div>