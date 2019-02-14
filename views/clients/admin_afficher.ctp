<h2>Détail Client : </h2>


<h4>Information personnelle</h4>
<b>ID :</b> <?php echo  $client['Client']['id']  ; ?><br><br>
<b>Pseudo :</b> <?php echo $client['Client']['pseudo'] ; ?><br><br>
<b>Nom :</b> <?php echo $client['Client']['nom'] ; ?><br><br>
<b>Prénom :</b> <?php echo $client['Client']['prenom'] ; ?><br><br>
<b>Date naissance :</b> <?php echo $client['Client']['date_naissance'] ; ?><br><br>
<b>Statut :</b> <?php echo  $client['Client']['statut']  ; ?><br><br>
<b>Email :</b> <?php echo $client['Client']['email'] ; ?><br><br>
<b>Adresse :</b> <?php echo $client['Client']['adresse'] ; ?><br><br>
<b>Pays :</b> <?php echo $client['Client']['paysCli'] ; ?><br><br>
<b>Tél. :</b> <?php echo $client['Client']['tel'] ; ?><br><br>
<b>GSM. :</b> <?php echo $client['Client']['tel_port'] ; ?><br><br>

<h4>Information session</h4>
<b>Date creation :</b> <?php echo $client['Client']['created'] ; ?><br><br>
<b>Nbr de session :</b> <?php echo $client['Client']['nbSessCli'] ; ?><br><br>
<b>Nbr de consultation :</b> <?php echo $client['Client']['nbr_consultation'] ; ?><br><br>
<b>Newsletter :</b> <?php echo $client['Client']['newsletterCli'] ; ?><br><br>

<h4>Information d'achats</h4>
<b>Total d'achats :</b> <?php echo $client['Client']['totalAchats'] ; ?><br><br>
<b>Adresse de la livraison :</b> <?php echo $client['Client']['ad_livraison'] ; ?><br><br>
<b>Code Postal de la livraison :</b> <?php echo $client['Client']['cp_livraison'] ; ?><br><br>
<b>Ville de la livraison :</b> <?php echo $client['Client']['ville_livraison'] ; ?><br><br>
<b>Validation</b> <?php echo $client['Client']['validation'] ; ?><br><br>
