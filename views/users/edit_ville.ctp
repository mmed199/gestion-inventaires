<?php 
if(empty($villes))
	echo $this->Form->input('ville', array('label' => false, 'size' => 40));
else
	echo $this->Form->select('ville', $villes, null, array('escape' => false));?>