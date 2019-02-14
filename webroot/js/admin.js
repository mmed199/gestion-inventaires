//fonction de demande de confirmation de suppression
function confirmDelete(element,id,url)
{
	if(confirm('Voulez vous vraiment supprimer '+element+' '+ id + ' ?'))
	{
		window.location.replace(url);
	}
}

//fonctions ajax pour la gestion des produits
function updateSaison(refProd, saison)
{
	var objXMLHR;
	if (window.XMLHttpRequest) objXMLHR = new XMLHttpRequest();
	else if (window.ActiveXObject) objXMLHR = new ActiveXObject('Microsoft.XMLHTTP'); 
	objXMLHR.open('POST', "/ajaxRequestAdm.php", true);
	objXMLHR.onreadystatechange = function()
	{
		if (objXMLHR.readyState == 4 && objXMLHR.status == 200)
		{
			//alert(objXMLHR.responseText);
			//document.getElementById(strDivName).innerHTML = objXMLHR.responseText;
			//parseScript(objXMLHR.responseText);
			if ($.trim (objXMLHR.responseText) != "ok")
			alert ((objXMLHR.responseText));
		}
	}
	objXMLHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	objXMLHR.send('action=update_saison&id='+refProd+'&saison='+saison);
}

function updateTag(refProd, tag)
{
	var objXMLHR;
	if (window.XMLHttpRequest) objXMLHR = new XMLHttpRequest();
	else if (window.ActiveXObject) objXMLHR = new ActiveXObject('Microsoft.XMLHTTP'); 
	objXMLHR.open('POST', "/ajaxRequestAdm.php", true);
	objXMLHR.onreadystatechange = function()
	{
		if (objXMLHR.readyState == 4 && objXMLHR.status == 200)
		{
			//alert(objXMLHR.responseText);
			//document.getElementById(strDivName).innerHTML = objXMLHR.responseText;
			//parseScript(objXMLHR.responseText);
			if ($.trim (objXMLHR.responseText) != "ok")
				alert (objXMLHR.responseText);
			//alert (objXMLHR.responseText);
		}
	}
	objXMLHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	objXMLHR.send('action=update_tag&id='+refProd+'&tag='+tag);
}

function deleteProd(id)
{
	if(confirm("Voulez vous vraiment supprimer l'article : "+ id + ' ?'))
	{
		var objXMLHR;
		if (window.XMLHttpRequest) objXMLHR = new XMLHttpRequest();
		else if (window.ActiveXObject) objXMLHR = new ActiveXObject('Microsoft.XMLHTTP'); 
		objXMLHR.open('POST', "/ajaxRequestAdm.php", true);
		objXMLHR.onreadystatechange = function()
		{
			if (objXMLHR.readyState == 4 && objXMLHR.status == 200)
			{
				if ($.trim(objXMLHR.responseText) != "ok")
					alert (objXMLHR.responseText);
				else{
					$("#td_stat"+id).empty().html('<img src="/data/img/rond_r.png" />');
					
					$("#img_stat"+id).attr("src","/data/img/rond_r.png");    
					
				}
			}
		}
		objXMLHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		objXMLHR.send('action=del_prod&id='+id);
	}
}




function updateSaisontemp(strCmd, strDivName, strParam)
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
			//document.getElementById(strDivName).innerHTML = objXMLHR.responseText;
			//parseScript(objXMLHR.responseText);
		}
	}
	objXMLHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	if(strParam == '') objXMLHR.send('cmd='+encodeURIComponent(strCmd));
	else objXMLHR.send('cmd='+encodeURIComponent(strCmd)+'&'+strParam);
}

function sendNews(){
			$.ajax({
			url: "/admin/newsletters/send",
			type: "GET",
			success: function(data){
			    //si 1 : il ya  des newsletter à envoyer
				if(data == 1 ) setTimeout('sendNews()', 5000);
				}
		});

}
setTimeout ('sendNews()', 5000); 

function sendMmessages(){
			$.ajax({
			url: "/admin/mmessages/send",
			type: "GET",
			success: function(data){
			    //si 1 : il ya  des newsletter à envoyer
				if(data == 1 ) setTimeout('sendMmessages()', 5000);
				}
		});

}
setTimeout ('sendMmessages()', 5000); 