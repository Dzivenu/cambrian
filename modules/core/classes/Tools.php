<?php
class CambrianTools
{
  private $config = [];

  public function __construct($config)
  {
    $this->config = $config;
  }

  public function debug($message)
  {
    if($this->config['debug']) {
      print_r($message);
    }
  }
  
}