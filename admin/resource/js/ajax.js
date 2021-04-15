// JavaScript Document
//var http_request	= false;
//var show_id			= false;
function makeRequest(url, obj_response, method, parameters) {
	var http_request	= false;
	var show_id			= document.getElementById(obj_response);
	if (!show_id) {
		//alert('Cannot find object response data !');	
		return false;
	}
	if(url == ""){
		return false;
	}
	show_id.innerHTML	= '<table id=\"load_data\" class=\"load_data\" width=\"100%\"><tr><td><div>Dữ liệu đang tải về... !</div><div><img border=\"0\" vspace=\"5\" src=\"/images/loading.gif\" /></div></td></tr></table>';
	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		http_request	= new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			//set type accordingly to anticipated content type
			http_request.overrideMimeType('text/html');
		}
	} else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject('Msxml2.XMLHTTP');
		} catch (e) {
			try {
				http_request = new ActiveXObject('Microsoft.XMLHTTP');
			} catch (e) {}
		}
	}
	if (!http_request) {
		alert('Cannot create XMLHTTP instance');
		return false;
	}
	
	http_request.onreadystatechange=	function(){
													if (http_request.readyState == 4) {
														if (http_request.status == 200) {
															//alert(http_request.responseText);
															show_id.innerHTML = http_request.responseText;
														} else {
															//alert('There was a problem with the request.');
															return false;
														}
													}
												}
	if(method == 'GET'){
		http_request.open('GET', url, true);
		http_request.send('');
	}
	else if(method == 'POST'){
		http_request.open('POST', url, true);
		http_request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		http_request.setRequestHeader('Content-length', parameters.length);
		http_request.setRequestHeader('Connection', 'close');
		http_request.send(parameters);
	}
}

function submitFormByAjax(file_action, obj_response, method, arrObject){
	if(typeof(arrObject) !== 'object'){
		alert('Array object is do not match !');
		return false;
	}
	var parameters	= '';
	for(i=0; i<arrObject.length; i++){
		parameters = parameters + arrObject[i] + '=' + encodeURI(document.getElementById(arrObject[i]).value);
		if(i < arrObject.length-1) parameters = parameters + '&';
	}
	if(method == 'GET') file_action = file_action + '?' + parameters;
	makeRequest(file_action, obj_response, method, parameters);
}

function load_data(file_action, obj_response){
	makeRequest(file_action, obj_response, 'GET', '')
}

function getData(dataSource, divID){
	var XMLHttpRequestObject = false;
	var myobj = document.getElementById(divID);
	if (!myobj){
		return;
	}
	if(dataSource == ""){
		return false;
	}
	myobj.innerHTML	= 'Đang kiểm tra tài khoản... !';
	if (window.XMLHttpRequest) {
		XMLHttpRequestObject = new XMLHttpRequest();
	} 
	else if (window.ActiveXObject) {
		XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	if(XMLHttpRequestObject) {
		XMLHttpRequestObject.open("GET", dataSource);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 &&	XMLHttpRequestObject.status == 200) {
				myobj.innerHTML = XMLHttpRequestObject.responseText;
			}
		}
	XMLHttpRequestObject.send(null);
	}
}


