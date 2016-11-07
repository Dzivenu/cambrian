<?php
function setDebug($d) {
  if($d) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
  } else {
    ini_set('display_errors', 0);
    error_reporting(0);
  }

  return $d;
}

function setModules($m) {
  if(empty($m) || $m == []) {
    $m = ['core'];
  } elseif($m == 'all') {
    $m = [];
    // @todo load modules from folders available in /modules
    $m = ['csscrush','email','form','navigation'];
  }

  return $m;
}

function processConfig($file = 'main') {
    require_once '../../config/'.$file.'.php';

  if(!isset($debug)) {
		$debug = 0;
	}
	$debug = setDebug($debug);

	if(!isset($modules)) {
	  $modules = 'core';
	}
	$modules = setModules($modules);

  print_r($modules);
}

processConfig();