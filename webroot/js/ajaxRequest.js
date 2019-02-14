function loadData(strCmd, strDivName, strParam)
{
	var objXMLHR;
	if (window.XMLHttpRequest) objXMLHR = new XMLHttpRequest();
	else if (window.ActiveXObject) objXMLHR = new ActiveXObject('Microsoft.XMLHTTP'); 
	objXMLHR.open('POST', "/ajaxRequest.php", true);
	objXMLHR.onreadystatechange = function()
	{
		if (objXMLHR.readyState == 4 && objXMLHR.status == 200)
		{
			//alert(objXMLHR.responseText);
			document.getElementById(strDivName).innerHTML = objXMLHR.responseText;
			parseScript(objXMLHR.responseText);
		}
	}
	objXMLHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	if(strParam == '') objXMLHR.send('cmd='+encodeURIComponent(strCmd));
	else objXMLHR.send('cmd='+encodeURIComponent(strCmd)+'&'+strParam);
}

function addItemCaddy (strCmd, strDivName, strParam)
{
	var retour = "";
	var objXMLHR;
	if (window.XMLHttpRequest) objXMLHR = new XMLHttpRequest();
	else if (window.ActiveXObject) objXMLHR = new ActiveXObject('Microsoft.XMLHTTP'); 
	objXMLHR.open('POST', "/ajaxRequest.php", true);
	objXMLHR.onreadystatechange = function()
	{
		if (objXMLHR.readyState == 4 && objXMLHR.status == 200)
		{
			//alert(objXMLHR.responseText);
			document.getElementById(strDivName).innerHTML = objXMLHR.responseText;
			//retour =  objXMLHR.responseText;
			//alert (retour);
			parseScript(objXMLHR.responseText);
			//return retour;
		}
	}
	objXMLHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	if(strParam == '') objXMLHR.send('cmd='+encodeURIComponent(strCmd));
	else objXMLHR.send('cmd='+encodeURIComponent(strCmd)+'&'+strParam);
}
function parseScript(_source) {
	var source = _source;
	var scripts = new Array();
	
	// Strip out tags
	while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
		var s = source.indexOf("<script");
		var s_e = source.indexOf(">", s);
		var e = source.indexOf("</script", s);
		var e_e = source.indexOf(">", e);
		
		// Add to scripts array
		scripts.push(source.substring(s_e+1, e));
		// Strip from source
		source = source.substring(0, s) + source.substring(e_e+1);
	}
	
	// Loop through every script collected and eval it
	for(var i=0; i<scripts.length; i++) {
		try {
			eval(scripts[i]);
		}
		catch(ex) {
			// do what you want here when a script fails
		}
	}
	
	// Return the cleaned source
	return source;
}

function showContactArea()
{
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "formatselect,fontselect,fontsizeselect,|,undo,redo,|,link,unlink,anchor,image",
		theme_advanced_buttons2 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,insertdate,inserttime,|,forecolor,backcolor",
		theme_advanced_buttons3 : "preview",
		//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "/data/js/template_list.js",
		external_link_list_url : "/data/js/link_list.js",
		external_image_list_url : "/data/js/image_list.js",
		media_external_list_url : "/data/js/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
}

var f = '';
function imprime()
{
	var Headers = '<!DOCTYPE HTML PUBLIC ><HTML><HEAD><title>Facture de kidsdressing.com</title><style type="text/css">#imprimer {display:none;}</style><link rel="stylesheet" type="text/css" href="./data/css/style.css" media="screen" /></HEAD><BODY style="color:black; background-color:white; padding:5px;" onload="window.print();window.close()">';
	var Footers = '</body></html>';
	var zi = '<hr>'+document.getElementById('ZoneImpr').innerHTML+'<hr>';
	var f = window.open('', 'ZoneImpr', 'height=700, width=700, toolbar=1, menubar=1, scrollbars=1, resizable=1, status=0, location=0, left=10, top=10');
	f.document.write (Headers + zi + Footers);
	f.document.close();
	return;
}