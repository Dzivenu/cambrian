<?php
Class CambrianView
{

  public $home = '/home';
  private $data = [];

  public function __construct($config) {
    $this->data['config'] = $config;
  }

  public function parse($url = '/home') {
    $this->data['url'] = $url;
    $this->includeFile('mod_core_base',['content'=>$this->getContent($url)]);
    return true;
  }

  public function includeFile($file,$d = []) {
    $this->data = array_merge($this->data,$d);
    include $this->getFile($file);
  }

  public function getFile($file) {
    $target = explode('_',$file);
    $filetypes = ['html'];
    foreach($filetypes as $type) {
      $userfile = '../layout/html/'.$file.'.'.$type;
      if($target[0] == 'mod') {
        $modulefile = '../modules/'.$target[1].'/layout/'.$type.'/'.$target[2].'.'.$type;
        if(file_exists($userfile)) {
          return $userfile;
        } elseif(file_exists($modulefile)) {
          return $modulefile;
        }
      }
    }
  }

  public function getContent($url) {
    $url = explode('/',$url);
    $path = '';
    foreach($url as $snip) {
      $path .= '/'.$snip;
    }

    if(file_exists('../pages'.$path.'/content.html'))
    {
      $content = file_get_contents('../pages'.$path.'/content.html');
    } else {
      $content = file_get_contents($this->getFile('mod_core_404'));
    }
    return $content;
  }

}