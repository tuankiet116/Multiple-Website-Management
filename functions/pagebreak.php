<?
function generatePageBarPro($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous='<', $next='>', $first='<<', $last='>>', $break_type=1, $page_space=3, $page_name=",page-"){

	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;

	$start_page = $current_page - $page_space;
	if($start_page <= 0) $start_page = 1;

	$end_page = $current_page + $page_space;
	if($end_page > $num_of_page) $end_page = $num_of_page;

	// Remove XSS
	$url = str_replace('\"', '"', $url);
	$url = str_replace('"', '', $url);

	// Pagebreak bar
	$page_bar = "<div class='block_pagebreak'>";

	// Write prefix on screen
	if($page_prefix != "") $page_bar .= '<font class="' . $normal_class . '">' . $page_prefix . '</font> ';

	$href			= $url;//"javascript:;";
	// Write frist page

	if($break_type == 1){
		if(($current_page > 1) && ($num_of_page > 1)){
			$page_bar .=  '<a href="' . $href . '" iPage = "1" class="page_break ' . $normal_class . '" >' . $first . '</a> ';
		}
	}

	// Write previous page
	if($break_type == 1 || $break_type == 2){
		if(($current_page > 1) && ($num_of_page > 1)){
			if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
				$page_dot_before = $start_page - 1;
				if($page_dot_before < 1) $page_dot_before = 1;
				$href 	= $url . $page_name . $page_dot_before;
				$page_bar .= '<a id="pg_'. $page_dot_before .'" href="' . $href . '" iPage = "' . $page_dot_before . '" class="page_break ' . $normal_class . '">..</a> ';
			}
		}
	}

	// Write page numbers
	if($break_type == 1 || $break_type == 2 || $break_type == 3){
		$start_loop	= $start_page;
		if($break_type == 3) $start_loop = 1;
		$end_loop	= $end_page;
		if($break_type == 3) $end_loop = $num_of_page;
		for($i=$start_loop; $i<=$end_loop; $i++){
			$href 	= $url . $page_name . $i;
			if($i != $current_page){
				$page_bar .= ' <a id="pg_'. $i .'" href="' . $href . '" iPage = "' . $i . '" class="page_break ' . $normal_class . '">' . $i . '</a> ';
			}
			else{
				$page_bar .= ' <a id="pg_'. $i .'" href="' . $href . '" iPage = "' . $i . '" class="page_break ' . $selected_class . '">' . $i . '</a> ';
			}
		}
	}

	// Write next page
	if($break_type == 1 || $break_type == 2){
		if(($current_page < $num_of_page) && ($num_of_page > 1)){

			if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
				$page_dot_after	= $end_page + 1;
				$href					= $url . $page_name . $page_dot_after;
				$page_bar .= '<a href="' . $href . '" iPage = "' . $page_dot_after . '" class="page_break ' . $normal_class . '">...</a> ';
			}
		}
	}

	// Write last page
	if($break_type == 1){
		if(($end_page < $num_of_page) && ($num_of_page > 1)){
			$href			= $url . $page_name . $num_of_page;
			$page_bar 	.= ' <a href="' . $href . '" iPage = "' . $num_of_page . '" class="page_break ' . $normal_class . '" >' . $last . '</a>';
		}
	}

	$page_bar 	.= '</div>';
	// Return pagebreak bar
	return $page_bar;

}
function generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous='<', $next='>', $first='<<', $last='>>', $break_type=1, $page_rewrite=0, $page_space=3, $obj_response='', $page_name="page"){

	$page_query_string	= "&" . $page_name . "=";
	// Nếu dùng ModRewrite thì dùng dấu , để phân trang
	if($page_rewrite == 1) $page_query_string = ",";

	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;

	$page_space = $page_space;

	$start_page = $current_page - $page_space;
	if($start_page <= 0) $start_page = 1;

	$end_page = $current_page + $page_space;
	if($end_page > $num_of_page) $end_page = $num_of_page;

	// Remove XSS
	$url = str_replace('\"', '"', $url);
	$url = str_replace('"', '', $url);

	if($break_type < 1) $break_type = 1;
	if($break_type > 4) $break_type = 4;

	// Pagebreak bar
	$page_bar = "";

	// Write prefix on screen
	if($page_prefix != "") $page_bar .= '<font class="' . $normal_class . '">' . $page_prefix . '</font> ';

	// Write frist page
	if($break_type == 1){
		if(($start_page != 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . '1' . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . '1';
			$page_bar .=  '<a href="' . $href . '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $first . '</a> ';
		}
	}

	// Write previous page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page > 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page - 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page - 1);
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $previous . '</a> ';
			if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
				$page_dot_before = $start_page - 1;
				if($page_dot_before < 1) $page_dot_before = 1;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_before . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_before;
				$page_bar .= '<a href="' . $href . '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">..</a> ';
			}
		}
	}

	// Write page numbers
	if($break_type == 1 || $break_type == 2 || $break_type == 3){
		$start_loop = $start_page;
		if($break_type == 3) $start_loop = 1;
		$end_loop	= $end_page;
		if($break_type == 3) $end_loop = $num_of_page;
		for($i=$start_loop; $i<=$end_loop; $i++){
			if($i != $current_page){
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $i . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $i;
				$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $i . '</a> ';
			}
			else{
				$page_bar .= ' <font class="' . $selected_class . '">' . $i . '</font> ';
			}
		}
	}

	// Write next page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page + 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page + 1);
			if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
				$page_dot_after = $end_page + 1;
				if($page_dot_after > $num_of_page) $page_dot_after = $num_of_page;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_after . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_after;
				$page_bar .= '<a href="' . $href . '" class="' . $normal_class . '">..</a> ';
			}
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $next . '</a> ';
		}
	}

	// Write last page
	if($break_type == 1){
		if(($end_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $num_of_page . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . $num_of_page;
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $last . '</a>';
		}
	}

	// Return pagebreak bar
	return $page_bar;

}
?>