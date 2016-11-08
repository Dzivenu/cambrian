<?php
namespace Cambrian;

class Files
{
  public static function readDir($path) {
    $results = [];
    if(is_dir($path))
    {
      if($handle = opendir($path))
      {
        while(($file = readdir($handle)) !== false)
        {
          $exclude = ['.','..'];
          if(!in_array($file, $exclude)) {
            $results[$file] = [];
            if(is_dir($path.'/'.$file)) {
              $results[$file]['type'] = 'dir';
            } else {
              @$results[$file]['type'] = filetype($file);
            }
          }
        }

        closedir($handle);
      }
    }

    return $results;
  }
}