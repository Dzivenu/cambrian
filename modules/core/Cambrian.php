<?php
class Cambrian
{

  private $config = [
    'debug'=>false,
    'modules'=>['core','navigation']
  ];

  public function __construct($request)
  {
    global $config;
  }

  function setDebug($d) {
    if($d) {
      ini_set('display_errors', 1);
      error_reporting(E_ALL);
    } else {
      ini_set('display_errors', 0);
      error_reporting(0);
    }

    $config['debug'] = $d;
    return $d;
  }

  function setModules($m) {
    if(empty($m) || $m == []) {
      $m = $config['modules'];
    } elseif($m == 'all') {
      $m = [];
      // @todo load modules from folders available in /modules
      $m = ['csscrush','email','form','navigation'];
    }

    $config['modules'] = $m;
    return $m;
  }

  function processConfig($file = 'main') {
      require_once '../config/'.$file.'.php';

    if(!isset($debug)) {
  		$debug = 0;
  	}
  	$debug = $this->setDebug($debug);

  	if(!isset($modules)) {
  	  $modules = 'core';
  	}
  	$modules = $this->setModules($modules);

    print_r($modules);
  }
}