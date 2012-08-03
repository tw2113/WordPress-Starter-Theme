<?php

/**
 * Parses query string into array.
 *
 * @param mixed $args - should be a string like: key=value&key=value
 * @return array
 */
function parseAStr($args=''){
	if(is_array($args)){
		return $args;
	}elseif($args != ''){ // if the data is sent as a URL query string.
		parse_str($args, $args);
		unset($args['arr']);
		return $args;
	}
	return array();
}

/**
 * Echos or returns and string based on input.
 *
 * @param mixed $string
 * @param bool $echo
 * @return mixed
 */
function recho($string, $echo=false){
	if($echo === true){
		echo $string;
	}
	return $string;
}
?>
