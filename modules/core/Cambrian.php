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
    require_once 'classes/Config.php';
    $c = new CambrianConfig($this->config);
    $this->config = $c->processConfig($configFile);
  }

  function debug($message)
  {
    if($this->config['debug']) {
      print_r($message);
    }
  }
}