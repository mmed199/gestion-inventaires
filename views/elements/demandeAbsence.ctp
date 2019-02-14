<div style="font-size: 26px; float: right;">
	
		Oujda, le <?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['created'])) ; ?>
	
</div>
<div style="font-size: 26px; margin: 300px 0 20px 0;">
	<p>
		ROYAUME DU MAROC <br>
		MINISTERE DE L’INTERIEUR<br>
		WILAYA DE LA REGION DE L’ORIENTAL<br>
		PREFECTURE OUJDA ANGAD<br>
		SECRETARIAT GENERAL<br>
		DRH
	</p>
	<center>
</div >

	
<div >
	<h3 >Demande <?php echo $absence['Typeabsence']['title']; ?> - <?php echo $absence['Annee']['titre']; ?> </h3>

</div>
</center>
<div style="display:block; width:600px; margin:30px auto; text-align:justify;">
	<div>
		<p>  Nom: <?php echo $absence['Member']['nom']; ?> </p>
		<p>  Prénom: <?php echo $absence['Member']['prenom']; ?> </p> 
		<p>  Grade: <?php echo $absence['Member']['grade']; ?></p> 
		<p>  Division: <?php echo $div['Division']['nom']; ?></p>
		<p>  Je souhaiterais bénéficier de mon <?php echo $absence['Typeabsence']['title']; ?></p>
		<p>  à partir du 
			<strong><?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['date_debut'])) ; ?></strong> au <strong><?php echo strftime( "%d/%m/%Y" , strtotime($absence['Absence']['date_fin'])) ; ?>
			</strong>
		</p> 
		<p>  Durée: <strong><?php echo  $absence['Absence']['duree']  ; ?></strong>  jours.</p>
	</div>
</div>
<div style="display:block; width:200px; margin:30px auto; text-align:justify;">
	<p>
		Accord de Mr. le Chef de la Division <?php echo $div['Division']['abreviation']; ?>.<br>
	</p>
</div>
<div style="display:block; width:200px; margin:30px auto; text-align:justify;">
	<p>
		Accord de Mr. le Chef de la Division DRH. <br>
	</p>
</div>
<div style="display:block; width:200px; margin:30px auto; text-align:justify;">
	<p>
		Accord de Mr. le Wali. <br>
	</p>
</div>


	   
   