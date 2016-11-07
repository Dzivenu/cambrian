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

    require_once('classes/Tools.php');
    $t = new CambrianTools($this->config);

    require_once('classes/View.php');
    $v = new CambrianView($t);
    $v->parse();
  }

  
}