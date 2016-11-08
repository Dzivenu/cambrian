<?php
namespace Cambrian;

Class Config
{

  public $config = [];

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

    return $this->loadModules($m);
  }

  function loadModules($m) {
    $loaded = [];
    foreach($m as $module=>$params) {
      if($module != 'core') {
        $file = '../modules/'.$module.'/'.ucfirst($module).'.php';
        if(file_exists($file)) {
          $loaded[$module] = $params;
          $this->config['modules'] = $loaded;
          require_once $file;
        }
      }
    }

    return $loaded;
  }

  function processConfig($file) {
    require_once '../config/'.$file.'.php';

    if(!isset($debug)) {
      $debug = 1;
    }
    $this->config['debug'] = $this->setDebug($debug);

    if(!isset($modules)) {
      $modules = [];
    }
    $this->config['modules'] = $this->setModules($modules);

    if(!isset($layout)) {
      $layout = 'mod_core_base';
    }
    $this->config['layout'] = $layout;

    return $this->config;
  }
}