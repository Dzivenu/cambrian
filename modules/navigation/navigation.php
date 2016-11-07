<?php
class CambrianNavigationModule
{

  public static function createArray($add) {
    $result = [];
    $pages = CambrianFiles::readDir('../pages');
    foreach($pages as $key=>$value) {
      if($value['type'] == 'dir') {
        $content = CambrianFiles::readDir('../pages/'.$key);
        foreach($content as $k=>$v) {
          if($k == 'content.html') {
            $result[] = [
              'href'=>'/'.$key,
              'title'=>$key
            ];
          }
        }
      }
    }

    $result = array_merge($add,$result);
    return $result;
  }
}