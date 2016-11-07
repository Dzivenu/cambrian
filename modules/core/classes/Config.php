<?php
Class CambrianConfig extends Cambrian
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
      $this->readdirectory('../modules');
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

    return $this->config;
  }

  public function readdirectory($path) {
    if(is_dir($path))
    {
      if($handle = opendir($path))
      {
        while(($file = readdir($handle)) !== false)
        {
          echo "<li>File: ";
          echo $file;

          echo "<ul><li>Type: ";
          echo is_dir($file);
          echo "</li></ul>\n";
        }
        closedir($handle);
      }
    }
  }
}