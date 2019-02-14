<?php
class CkHelper extends AppHelper
{
	var $helpers = array('Html', 'Javascript');
 
	function replace($fieldName, $options = array())
	{
		$defaults = array(
 			'customConfig' => '/js/ckeditor/app.config.js',
 			'loadFinder' => true
 		);
 
		$options = array_merge($defaults, $options);
 
	 	$fieldId = $this->domId($fieldName);
 
	 	$loadFinder = $options['loadFinder'];
 
	 	unset($options['loadFinder']);
 
		$script = "\tvar ck_$fieldId = CKEDITOR.replace('$fieldId', '$this->Javascript->object($options)');";
		if($loadFinder)
		{
			$script .= "\n\tCKFinder.setupCKEditor(ck_$fieldId, '/js/ckfinder/');";
		}
 
		return $this->Html->scriptBlock($script);
	}
}
?>