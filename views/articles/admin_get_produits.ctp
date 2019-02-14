<div id="liste-p">	
<style>
.produit{
	display:inline-block; 
    background: none repeat scroll 0 0 #5497E0;
    border: 1px solid transparent;
    border-radius: 3px 3px 3px 3px;
    color: #FFFFFF;
	margin:5px;
    text-decoration: none;
}
</style>
<?php
$langCode = Configure::read('Config.langCode');
foreach($produits as $p ) :
?>
<div class="produit" id="produit_<?php echo $p['Produit']['id'] ; ?>" >
<img src="/slir/w125-h157/uploads/produits/<?php echo $p["Produit"]["image"] ; ?>" title="<?php echo $p["Produit"]["nom"] ; ?>"/>
<center><?php echo $p["Produit"]["id"] ; ?></center>
<a href="#" class="delete" >supprimer</a>
</div>
<?php endforeach; ?>
</div>