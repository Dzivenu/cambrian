<?php
class CambrianNavigationModule
{
  public $data = [];

  public function __construct($data) {
    $this->data = $data;
    $this->createArray();
  }

  public static function createArray() {
    $pages = CambrianFiles::readDir('../pages');
    foreach($pages as $key=>$value) {
      if($value == 'dir') {
        $content = CambrianFiles::readDir('../pages/'.$key);
        foreach($content as $k=>$v) {
          echo $k; 
          echo $v;
        }
      }
    }
  }
}