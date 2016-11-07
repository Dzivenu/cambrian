<?php
class Cambrian
{

  private $config = [
    'debug'=>false,
    'modules'=>[]
  ];

  public function __construct($configFile = 'main')
  {
    require_once 'classes/Config.php';
    require_once 'classes/Files.php';
    $c = new CambrianConfig($this->config);
    $this->config = $c->processConfig($configFile);

    require_once('classes/View.php');
    $v = new CambrianView();
    if(!isset($_GET['url'])) {
      $param = '/home';
    } else {
      $param = $_GET['url'];
    }
    $v->parse($param);
  }

  public function debug($message)
  {
    if($this->config['debug']) {
      print_r($message);
    }
  }

  
}