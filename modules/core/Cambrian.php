<?php
class Cambrian
{

  private $config = [
    'debug'=>false,
    'modules'=>['core','navigation']
  ];

  public function __construct($configFile = 'main')
  {
    global $config;
    $this->processConfig($configFile);
  }

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
      $m = $this->config['modules'];
    } elseif($m == 'all') {
      $m = [];
      // @todo load modules from folders available in /modules
      $m = ['csscrush','email','form','navigation'];
    }

    return $m;
  }

  function processConfig($file) {
      require_once '../config/'.$file.'.php';

    if(!isset($debug)) {
  		$debug = 0;
  	}
  	$this->config['debug'] = $this->setDebug($debug);

  	if(!isset($modules)) {
  	  $modules = $this->config['modules'];
  	} else {
  	  $this->config['modules'] = $this->setModules($modules);
    }

    $this->debug($this->config);
  }

  function debug($message)
  {
    if($this->config['debug']) {
      print_r($message);
    }
  }
}