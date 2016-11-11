<?php
namespace Cambrian\Modules;

class Navigation
{
  public $pages = [];

  public function __construct($links) {
    $result = [];
    $pages = self::getArray();
    foreach($links as $link) {
      if(isset($link['page']))
      {
        if(isset($pages[$link['page']])) {
          if(isset($link['title'])) {
            $pages[$link['page']]['title'] = $link['title'];
          }
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
    $pages = \Cambrian\Files::readDir('../pages');
    foreach($pages as $key=>$value) {
      if($value['type'] == 'dir') {
        $content = \Cambrian\Files::readDir('../pages/'.$key);
        foreach($content as $k=>$v) {
          if($k == 'content.html') {
            $result[$key]['href'] = '/'.$key;
            if(!isset($result[$key]['title'])) {
              $result[$key]['title'] = $key;
            }
          }
          if($k == 'config.php') {
            include('../pages/'.$key.'/config.php');
            if(isset($pageconfig['navigationTitle'])) {
              $result[$key]['title'] = $pageconfig['navigationTitle'];
            }
          }
        }
      }
    }

    return $result;
  }
}