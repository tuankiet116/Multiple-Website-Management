// Check IE6, IE7 Browser
var isIE6	= (navigator.userAgent.toLowerCase().indexOf("msie 6") == -1 ? false : true);
var isIE7	= (navigator.userAgent.toLowerCase().indexOf("msie 7") == -1 ? false : true);

function windowPrompt(data){

	$(document.getElementById("wPrompt")).remove();
	$(document.getElementById("wPromptOverlay")).remove();

	var wPromptOpts	= {
		version		: 20151006,
		background	: "#FFF",
		padding		: 10,
		width			: "auto",
		height		: "auto",
		maxWidth		: false,
		maxHeight	: false,
		title			: "",
		content		: "",
		fixed			: true,
		href			: null,
		ajax			: false,
		iframe		: false,
		overlay		: true,
		overlayClose: true,
		close			: true,
		alert			: false,
		confirm		: false,
		class_overlay	: "",

		onOpen		: null,
		onShow		: null,
		onComplete	: null,
		onCleanup	: null,
		onClosed		: null
	};

	var optsAlert	= {
		value			: "Đồng ý",
		callback		: null
	};

	var optsConfirm= {
		valueTrue	: "Đồng ý",
		valueFalse	: "Hủy bỏ",
		callback		: null
	};

	if(arguments.length == 2){
		wPromptOpts.title	= arguments[0];
		data	= arguments[1];
	}

	// Extend data
	if(typeof(data) == "object"){

		$.extend(wPromptOpts, data);
		if(wPromptOpts.alert != false || wPromptOpts.confirm != false){
			// Khi alert, confirm cho close mặc định = false
			if(typeof(data.close) == "undefined") wPromptOpts.close = false;
		}
	}

	// Extend alert
	if(typeof(wPromptOpts.alert) == "object") $.extend(optsAlert, wPromptOpts.alert);
	else if(typeof(wPromptOpts.alert) == "function") optsAlert.callback = wPromptOpts.alert;

	// Extend confirm
	if(typeof(wPromptOpts.confirm) == "object") $.extend(optsConfirm, wPromptOpts.confirm);
	else if(typeof(wPromptOpts.confirm) == "function") optsConfirm.callback = wPromptOpts.confirm;

	// Get DOM element
	domEleWindowPrompt	= function(){
		var domEle	= $("#wPrompt, #wPromptOverlay");
		domEle		= $.extend(domEle, {wPrompt: $(document.getElementById("wPrompt")), wPromptOverlay: $(document.getElementById("wPromptOverlay"))});
		return domEle;
	};

	// Alert function
	alertWindowPrompt		= function(){
		closeWindowPrompt();
		if(typeof(optsAlert.callback) == "function") optsAlert.callback();
	};

	// Confirm function
	confirmWindowPrompt	= function(confirm){
		closeWindowPrompt();
		if(typeof(optsConfirm.callback) == "function") optsConfirm.callback(confirm);
	};

	// Close function
	closeWindowPrompt		= function(){
		if(typeof(wPromptOpts.onCleanup) == "function") wPromptOpts.onCleanup(domEleWindowPrompt());
		$(document.getElementById("wPrompt")).remove();
		$(document.getElementById("wPromptOverlay")).remove();
		if(typeof(wPromptOpts.onClosed) == "function") wPromptOpts.onClosed();
	};

	// Width, Height temp
	var widthTemp	= 2 * wPromptOpts.padding;
	var heightTemp	= widthTemp;

	if(typeof(data) == "object"){
		// Ajax
		if(wPromptOpts.ajax && wPromptOpts.href != null) wPromptOpts.content	= $.ajax({ url: wPromptOpts.href, async: false }).responseText;
		// Iframe
		else if(wPromptOpts.iframe && wPromptOpts.href != null) wPromptOpts.content	= '<iframe class="wPromptIframe" name="wPromptIframe" frameborder="0" src="' + wPromptOpts.href + '" onload="window.frames[\'wPromptIframe\'].document.body.style.marginRight=\'3px\'"></iframe>';
		// Function
		else if(typeof(wPromptOpts.content) == "function") wPromptOpts.content = wPromptOpts.content();
	}
	else if(typeof(data) == "function") wPromptOpts.content = data();
	else wPromptOpts.content = data;

	// Width
	if(wPromptOpts.width != "auto"){
		if(String(wPromptOpts.width).indexOf("%") !== -1)	wPromptOpts.width	= parseInt(wPromptOpts.width)/100 * ($(window).width() - widthTemp);
		wPromptOpts.width	= parseInt(wPromptOpts.width) + "px";
	}
	// Height
	if(wPromptOpts.height != "auto"){
		if(String(wPromptOpts.height).indexOf("%") !== -1)	wPromptOpts.height= parseInt(wPromptOpts.height)/100 * ($(window).height() - heightTemp);
		wPromptOpts.height= parseInt(wPromptOpts.height) + "px";
	}

	// onOpen
	if(typeof(wPromptOpts.onOpen) == "function") wPromptOpts.onOpen();

	var html	= '';
	if(wPromptOpts.overlay) html += '<div id="wPromptOverlay"' + (wPromptOpts.overlayClose ? ' style="cursor: pointer;" onclick="closeWindowPrompt()"' : '') + '></div>';
	html += '<div id="wPrompt" class="' + wPromptOpts.class_overlay + '"' + (!wPromptOpts.fixed || isIE6 ? ' style="position: absolute;"' : '') + '>';
		if(wPromptOpts.close) html += '<a title="Đóng" class="wPromptClose" href="javascript:;" onclick="closeWindowPrompt()"></a>';
		html += '<div class="wPromptWrapper" style="background:' + wPromptOpts.background + '; padding: ' + wPromptOpts.padding + 'px; width:' + wPromptOpts.width + ';">';
			html += '<div class="wPromptLoadedContent" style="width:100%; height:' + wPromptOpts.height + ';">';
				if(wPromptOpts.iframe && wPromptOpts.href != null) html += wPromptOpts.content;
				else{
					if(wPromptOpts.title != "") html += '<div class="wPromptTitle">' + wPromptOpts.title + '</div>';
					cssIcon	= '';
					if(wPromptOpts.alert != false)	cssIcon = ' wPromptAlert';
					if(wPromptOpts.confirm != false) cssIcon = ' wPromptConfirm';
					html += '<div class="wPromptContent' + cssIcon + '"><i></i>';
					html += wPromptOpts.content;
					if(wPromptOpts.alert != false){
						html += '<div class="wPromptAlertButton"><input type="button" class="wPromptInputButton" value="' + optsAlert.value + '" onclick="alertWindowPrompt()" /></div>';
					}
					if(wPromptOpts.confirm != false){
						html += '<div class="wPromptConfirmButton">';
							html += '<input type="button" class="wPromptInputButton wPromptInputButtonTrue" value="' + optsConfirm.valueTrue + '" onclick="confirmWindowPrompt(true)" /> &nbsp;';
							html += '<input type="button" class="wPromptInputButton wPromptInputButtonFalse" value="' + optsConfirm.valueFalse + '" onclick="confirmWindowPrompt(false)" />';
						html += '</div>';
					}
					html += '</div>';
				}
			html += '</div>';
			html += '<div class="wPromptClear"></div>';
		html += '</div>';
	html += '</div>';

	var domEle	= $(html);
	$("body").prepend(domEle);
	// onShow
	if(typeof(wPromptOpts.onShow) == "function") wPromptOpts.onShow(domEleWindowPrompt());

	var wPromptDomEle	= $(document.getElementById("wPrompt"));

	// Max width
	if(wPromptOpts.maxWidth !== false){
		if(String(wPromptOpts.maxWidth).indexOf("%") !== -1)	wPromptOpts.maxWidth	= parseInt(wPromptOpts.maxWidth)/100 * ($(window).width() - widthTemp);
		wPromptOpts.maxWidth	= parseInt(wPromptOpts.maxWidth);
		if(wPromptDomEle.find(".wPromptLoadedContent").width() > wPromptOpts.maxWidth){
			wPromptDomEle.find(".wPromptWrapper, .wPromptLoadedContent").width(wPromptOpts.maxWidth);
		}
	}

	// Max height
	if(wPromptOpts.maxHeight !== false){
		if(String(wPromptOpts.maxHeight).indexOf("%") !== -1)	wPromptOpts.maxHeight= parseInt(wPromptOpts.maxHeight)/100 * ($(window).height() - heightTemp);
		wPromptOpts.maxHeight= parseInt(wPromptOpts.maxHeight);
		if(wPromptDomEle.find(".wPromptLoadedContent").height() > wPromptOpts.maxHeight){
			wPromptDomEle.find(".wPromptLoadedContent").height(wPromptOpts.maxHeight);
		}
	}

	if(wPromptOpts.alert != false || wPromptOpts.confirm != false) domEle.find(".wPromptInputButton:first").focus();

	wPromptDomEle.css({
		top: function(){
			offsetTop	= parseInt(($(window).height() - $(this).find(".wPromptLoadedContent").height() - heightTemp) / 2);
			if(offsetTop < 0) offsetTop = 0;
			if(!wPromptOpts.fixed || isIE6) offsetTop += $(window).scrollTop();
			return offsetTop + "px";
		},
		left: function(){
			offsetLeft	= parseInt(($(window).width() - $(this).find(".wPromptLoadedContent").width() - widthTemp) / 2);
			if(offsetLeft < 0) offsetLeft = 0;
			return offsetLeft + "px";
		}
	});

	// Fix width in IE6, IE7
	if(wPromptOpts.width == "auto" && (isIE6 || isIE7)){
		domEle.find(".wPromptWrapper").width(domEle.find(".wPromptLoadedContent").width());
	}

	// onComplete
	if(typeof(wPromptOpts.onComplete) == "function") wPromptOpts.onComplete(domEleWindowPrompt());

}