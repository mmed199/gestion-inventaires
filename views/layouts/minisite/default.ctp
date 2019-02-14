<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	
	<head>
		
		<title><?php echo $title_for_layout; ?></title>
		<link rel="shortcut icon" href="/images/site/favicon.ico" type="image/x-icon">
	
		<?php echo $html->charset(); ?> 
		<?php echo $html->script('jquery'); ?>
		<?php echo $html->script('zoombox'); ?>
		<?php echo $html->script('jquery.jgrowl'); ?>
		<?php echo $html->css('zoombox'); ?>
		<?php echo $html->css('jgrowl'); ?>
		<?php echo $html->script('jquery'); ?>
		<?php echo $html->script('minisite/gps.jquery'); ?>
		<?php echo $html->script('zoombox'); ?>
		<?php //en ligne ABQIAAAAQV96e2SJmWohYTU01vp0ThSplMh7tMNv-XrYb6yw8L7CY4ewtBTgj6Q1MuRnP5wRZEMkf9PcT9mArw ?>
		<?php //localhost ABQIAAAAQV96e2SJmWohYTU01vp0ThT2yXp_ZAY8_ufC3CFXhHIE1NvwkxRqvwmvUYDVy2-I4GIEnGTof_5ptg ?>
		
		<?php 
		//la feuille css du minisite
		echo $this->element('sites/css2');
		?>
		
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAQV96e2SJmWohYTU01vp0ThSplMh7tMNv-XrYb6yw8L7CY4ewtBTgj6Q1MuRnP5wRZEMkf9PcT9mArw" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$("#map").googleMap().load();
				
				/*$('.menu_principal ul li').click(function() { 
					//alert($(this).parent());
					$(this).attr('class', 'hover').siblings().attr('class', 'normal');
					
					$('.contenu').children().hide();
					$('#_'+$(this).attr('id')).slideDown();
				});
				
				$("input[type=text], textarea").focus(function(){
				  $(this).css("border","1px solid #0575f4");	
				}).blur(function(){
				  $(this).css("border","1px solid #00aff0");
				});*/


			});
		</script>
	</head>

	<body>
		
		<?php echo $content_for_layout; ?>

	</body>

</html>