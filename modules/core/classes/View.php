<?php
Class CambrianView
{
  private $t;

  public function construct($t) {
    $this->t = $t;
  }
  
  public function parse() {
    include '../modules/core/layout/html/base.html';
    return true;
  }
}