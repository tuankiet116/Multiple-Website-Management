<?
require_once("../../../../classes/database.php");
require_once("../../../../functions/functions.php");
$lang_id = getValue("lang_id","int","GET",1);
$db_country = new db_query("SELECT cit_id,cit_name
										FROM city 
										WHERE cit_parent_id= 0 AND lang_id = " . $lang_id . "
										ORDER BY cit_order ASC,cit_name ASC
										");
?>
var regiondb = new Object()
var citylist = new Object()
<?
$cit_id = 0;
$str = '';
$strcit = 'citylist[0] = [{value:"a", text:"Chọn tỉnh/TP"}';
$str .= 'regiondb["a"] = [{value:"", text:"Chọn Quận/Huyện"}];';
$i=-1;
while($row=mysql_fetch_array($db_country->result)){
	$i++;
	$db_quan = new db_query("SELECT cit_id,cit_name
										FROM city 
										WHERE cit_parent_id= " . $row["cit_id"] . "
										ORDER BY cit_order ASC,cit_name ASC");
	
		if($cit_id != 0){
			 $str .= '];';
		}
		$strcit .= ',{value:"' . $row["cit_id"] . '", text:"' . $row["cit_name"] . '"}';
		
		$str .= 'regiondb[' . $row["cit_id"] . '] = [{value:"0", text:"Chọn Quận/Huyện"}';
		$cit_id = $row["cit_id"];
		
		while($quan = mysql_fetch_array($db_quan->result)){
		
			$str .= ',{value:"' . $quan["cit_id"] . '", text:"' . $quan["cit_name"] . '"}';
			
		}
		
	unset($db_quan);
}
$strcit .=  '];';
$str .= '];';
echo $str;
echo $strcit;
?>							 
function setCities(thanpho,quan,valuequan) {
    var newElem;
	 var chooser = document.getElementById(thanpho);
    var where = (navigator.appName == "Microsoft Internet Explorer") ? -1 : null;
    var cityChooser = document.getElementById(quan);
    while (cityChooser.options.length) {
        cityChooser.remove(0);
    }
    var choice = chooser.options[chooser.selectedIndex].value;
    var db = regiondb[choice];
	 if(choice === "") choice = 0;	
    if (choice != "") {
	 	 if(choice == "a"){
	 	  	cityChooser.disabled = true;
		 }else{
		 	cityChooser.disabled = false;
		 }
		 //alert(choice);
        for (var i = 0; i < db.length; i++) {
            newElem = document.createElement("option");
            newElem.text = db[i].text;
            newElem.value = db[i].value;
            cityChooser.add(newElem, where);
				if(valuequan == db[i].value) cityChooser.options[i].selected = true;
        }
    }
}
function setListCombo(thanpho,valuetp){
	 var newElem;
	 var cityId = document.getElementById(thanpho);
    var where = (navigator.appName == "Microsoft Internet Explorer") ? -1 : null;
	 var db = citylist[0];
	 while (cityId.options.length) {
		  cityId.remove(0);
	 }
	  for (var i = 0; i < db.length; i++) {
			newElem = document.createElement("option");
			newElem.text = db[i].text;
			newElem.value = db[i].value;
			cityId.add(newElem, where);
			if(valuetp == db[i].value) cityId.options[i].selected = true;
	  }
}