$(document).ready(function() {

	//Select all anchor tag with rel set to tooltip
	$('a[rel=tooltip]').mouseover(function(e) {

		//Grab the title attribute's value and assign it to a variable
		var tip = $(this).attr('title');

		//Remove the title attribute's to avoid the native tooltip from the browser
		$(this).attr('title','');

		//Append the tooltip template and its value
		$(this).append('<div id="tooltip"><div class="tipHeader"></div><div class="tipBody">' + tip + '</div><div class="tipFooter"></div></div>');

		//Show the tooltip with faceIn effect
		//$('#tooltip').fadeIn('500');
		//$('#tooltip').fadeTo('10',0.9);

	}).mousemove(function(e) {

		//Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
		$('#tooltip').css('top', e.pageY + 25 );
		$('#tooltip').css('left', e.pageX - 30 );

	}).mouseout(function() {

		//Put back the title attribute's value
		$(this).attr('title',$('.tipBody').html());

		//Remove the appended tooltip template
		$(this).children('div#tooltip').remove();

	});
	$('.tooltip').mouseover(function(e) {

		//Grab the title attribute's value and assign it to a variable
		var tip = $(this).attr('title');

		//Remove the title attribute's to avoid the native tooltip from the browser
		$(this).attr('title','');

		//Append the tooltip template and its value
		$(this).append('<div id="tooltip"><div class="tipHeader"></div><div class="tipBody">' + tip + '</div><div class="tipFooter"></div></div>');

		//Show the tooltip with faceIn effect
		//$('#tooltip').fadeIn('500');
		//$('#tooltip').fadeTo('10',0.9);

	}).mousemove(function(e) {

		//Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
		$('#tooltip').css('top', e.pageY + 25 );
		$('#tooltip').css('left', e.pageX - 30 );

	}).mouseout(function() {

		//Put back the title attribute's value
		$(this).attr('title',$('.tipBody').html());

		//Remove the appended tooltip template
		$(this).children('div#tooltip').remove();

	});

});

// Create the tooltips only on document load
function checkall(total){

	if(document.getElementById("check_all").checked==true){
		for(i=1;i<=total;i++){
			try{
				document.getElementById("record_"+i).checked = true;
			}
			catch(e){}
		}
	}else{
		for(i=1;i<=total;i++){
			try{
				document.getElementById("record_"+i).checked = false;
			}
			catch(e){}
		}
	}
};
function deleteall(total){
	var total_footer = document.getElementById("total_footer").innerHTML;
	var listid = '0';
	var selected = false;
	for(i=1;i<=total;i++){
		if(document.getElementById("record_"+i).checked == true){
			id 		= 	document.getElementById("record_"+i).value;
			listid 	+= ','+id;
			total_footer = total_footer - 1;
			selected = true;
		}
	}

	if(selected===true){
		$.ajax({
			type: "POST",
			url: "delete.php",
			data: "record_id="+listid,
			success: function(data){
		  		alert( data.msg );
		  		if( parseInt(data.status) == 1 ){
					for(i=1;i<=total;i++){
						if(document.getElementById("record_"+i).checked == true){
							id 		= 	document.getElementById("record_"+i).value;
							$("#tr_"+id).hide('slow');
						}
					}
					document.getElementById("total_footer").innerHTML = total_footer;
		  		}
			},
			dataType:"json"
		 });
	}
}
function deleteone(id){
	$.ajax({
		type: "POST",
		url: "delete.php",
		data: "record_id="+id,
		success: function(data){
			if(data.status == 1){
				$("#tr_"+id).hide('slow');
			}else{
				alert(data.msg);
			}
		},
		dataType:"json"
	 });
}
function loadAjax2(id){
   $.post(
      "ajax2.php",
      {id : id},
      function(data){
         if(data != ""){
            $("#infomation").html(data);
            $("#infomation").css("display", "block");
         }
      },
      "html"
   );
}
function usp_cancel(id){

	$.ajax({
		type: "POST",
		url: "cancel.php",
		data: "record_id="+id,
		success: function(data){

		  	alert( data.msg );
		  	if( parseInt(data.status) == 1 ){
				$("#tr_"+id).remove();
				var total_footer = document.getElementById("total_footer").innerHTML;
				total_footer = total_footer - 1;
				document.getElementById("total_footer").innerHTML = total_footer;
		  	}
		},
		dataType:"json"
	 });
}
function resetpass(id){
	$.ajax({
		type: "POST",
		url: "resetpass.php",
		data: "record_id="+id,
		success: function(msg){
		  if(msg!=''){
		  	alert( msg );
		  }
		}
	 });
}
function sent_email(id){
	window.location.href = "sent_email.php?record_id=" + id;
}
function loadpage(obj){
		$('#listing').load(obj.href);
}
function update_check(obj){
	obj.innerHTML = '<img src="../../resource/images/grid/indicator.gif" border="0">';
	$(obj).load(obj.href + '&checkbox=1');
	return false;
}

function resetcache(id){
	$.ajax({
		type: "POST",
		url: "resetcache.php",
		data: "record_id="+id,
		success: function(msg){
		  if(msg!=''){
		  	alert( msg );
		  }
		}
	 });
}