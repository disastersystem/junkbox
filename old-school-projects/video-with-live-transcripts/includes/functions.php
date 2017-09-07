<?php

/**
 * The purpose of this function is to simplify the syntax a bit,
 * and never forget to include ENT_QUOTES.
 * ENT_QUOTES converts both double and single quotes.
 */
function safe_output($str) {
	return htmlentities($str, ENT_QUOTES);
}

/**
 * The purpose of this function is to simplify the syntax a bit.
 * And it also makes sure we never forget to call exit;
 */
function redirect($page) {
	header("Location: " . $page);
	exit;
}

/**
 * Functions that stringifies an array.
 */
function array_to_string($array) {
	$a = "";
	$num = count($array);

	$i = 0;
	foreach($array as $extension) {
		if ($i == $num - 1) {
			$a .= $extension . ".";
		} else {
			$a .= $extension . ", ";
		}
		$i++;
	}
	return $a;
}
