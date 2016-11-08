<?php
class CambrianNavigationModule
{
  public $pages = [];

  public function __construct($links) {
    $result = [];
    $pages = self::getArray();
    foreach($links as $link) {
      if(isset($link['page']))
      {
        if(isset($pages[$link['page']])) {
          $result[] = $pages[$link['page']];
        }
      } else {
        $result[] = $link;
      }
    }

    $this->pages = $result;
    return $result;
  }

  private function getArray() {
    $result = [];
    $pages = CambrianFiles::readDir('../pages');
    foreach($pages as $key=>$value) {
      if($value['type'] == 'dir') {
        $content = CambrianFiles::readDir('../pages/'.$key);
        foreach($content as $k=>$v) {
          if($k == 'content.html') {
            $result[$key] = [
              'href'=>'/'.$key,
              'title'=>$key
            ];
          }
        }
      }
    }

    return $result;
  }
}
print_r($this->config);