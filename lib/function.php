<?php
function str_limit($string,$limit_length,$add_string){
	$full_length=strlen($string);
	for($k=0; $k<$limit_length-1; $k++){
		if(ord(substr($string, $k, 1))>127) $k++;
	}
	if ($full_length > $limit_length){
		$final_string=substr($string, 0, $k).$add_string;
	} else {
		$final_string=$string;
	}
	return $final_string;
}
?>