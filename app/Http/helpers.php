<?php
	
	function randomStr($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	function lowerClean($str, $charset='utf-8') {
	    $str = htmlentities($str, ENT_NOQUOTES, $charset);
	    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
	    $str = preg_replace('#&[^;]+;#', '', $str);
	    $str = str_replace(' ', '_', $str);
	    return strtolower($str);
	}
	
	function routeClean($str, $delimiter='-') {
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	
		return $clean;
	}
	
	function days() {
		$output = [];
		for($i=1;$i<32;$i++) {
			array_push($output, $i < 10 ? '0'.$i : $i);
		}
		return $output;
	}
	
	function months() {
		$output = [];
		for($i=1;$i<13;$i++) {
			array_push($output, $i < 10 ? '0'.$i : $i);
		}
		return $output;
	}
	
	function years() {
		$output = [];
		for($i=date("Y")-100;$i<date("Y")+1;$i++) {
			array_push($output, $i < 10 ? '0'.$i : $i);
		}
		return $output;
	}
	
	function yearsFromNow() {
		$output = [];
		for($i=date("Y");$i<date("Y")+10;$i++) {
			array_push($output, $i < 10 ? '0'.$i : $i);
		}
		return $output;
	}
	
	function getDay($date) {
		$date = str_replace('/', '-', $date);
		$date = date('Y-m-d', strtotime($date));
		return date('d', strtotime($date));
	}
	
	function getMonth($date) {
		$date = str_replace('/', '-', $date);
		$date = date('Y-m-d', strtotime($date));
		return date('m', strtotime($date));
	}
	
	function getYear($date) {
		$date = str_replace('/', '-', $date);
		$date = date('Y-m-d', strtotime($date));
		return date('Y', strtotime($date));
	}
	
	function getDateClean($date) {
		$date = str_replace('/', '-', $date);
		$date = date('Y-m-d', strtotime($date));
		return $date;
	}
	
	
	function checkDirExists($dir) {
		if(!File::isDirectory($dir)) {
			File::makeDirectory($dir, 0777, true);
		}
	}
	
?>