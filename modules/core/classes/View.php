<?php
namespace Cambrian;

Class View
{

  public $home = '/home';
  private $pageConfig = [];
  private $data = [];

  public function __construct($config) {
    $this->data['config'] = $config;
  }

  public function parse($url = '/home') {
    $this->data['url'] = $url;
    $this->pageConfig = $this->getPageConfig($url);
    $this->includeFile(
      $this->data['config']['layout'],
      [
        'content'=>$this->getPageContent($url),
        'pageconfig'=>$this->pageConfig
      ]
    );
    return true;
  }

  public function includeFile($file,$d = []) {
    $this->data = array_merge($d,$this->data);
    include $this->getFile($file);
  }

  private function getFile($file) {
    $path = explode('/',$file);
    $len = count($path);
    if($len == 1) {
      $path = '';
    } else {
      $tmp = '';
      for($i = 0; $i < $len-1; $i++)
      {
        $tmp .= $path[$i].'/';
      }

      $file = $path[$len-1];
      $path = $tmp;
    }
    $target = explode('_',$file);
    $filetypes = ['html'];
    foreach($filetypes as $type) {
      $userfile = '../layout/html/'.$path.$file.'.'.$type;
      if($target[0] == 'mod') {
        $modulefile = '../modules/'.$target[1].'/layout/'.$type.'/'.$target[2].'.'.$type;
        if(file_exists($userfile)) {
          return $userfile;
        } elseif(file_exists($modulefile)) {
          return $modulefile;
        } else {
          return $this->getFile('mod_core_404');
        }
      }
    }
  }

  private function getPageContent($url) {
    $path = $this->getPath($url);
    if(file_exists('../pages'.$path.'/content.html'))
    {
      $content = file_get_contents('../pages'.$path.'/content.html');
    } else {
      $content = file_get_contents($this->getFile('mod_core_404'));
    }

    return $content;
  }

  private function getPageConfig($url) {
    $path = $this->getPath($url);
    $config = [];
    if(file_exists('../pages'.$path.'/config.php'))
    {
      include('../pages'.$path.'/config.php');
      
      if(isset($metadata)) {
        $config['metadata'] = $metadata;
      }

      if(isset($wrapperTemplate)) {
        $config['wrapperTemplate'] = $wrapperTemplate;
      }

      if(isset($bodyClass)) {
        $config['bodyClass'] = $bodyClass;
      }
    }

    return $config;
  }

  private function getPath($url)
  {
    $url = explode('/',$url);
    $path = '';
    foreach($url as $snip) {
      if($snip != '..') {
        $path .= '/'.$snip;
      }
    }

    return $path;
  }
}