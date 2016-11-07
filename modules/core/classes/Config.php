<?php
Class CambrianConfig
{

  private $config = [];

  public function __construct($config) {
    $this->config = $config;
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
      $installed = CambrianFiles::readDir('../modules');
      foreach($installed as $module => $data) {
        if($data['type'] == 'dir') {
          $m[] = $module;
        }
      }
    }

    $this->loadModules($m);
    return $m;
  }

  function loadModules($m) {
    foreach($m as $module) {
      if($module != 'core') {
        $file = '../modules/'.$module.'/'.$module.'.php';
        if(file_exists($file)) {
          require_once $file;
        }
      }
    }
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

    return $this->config;
  }
}