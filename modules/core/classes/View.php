<?php
Class CambrianView
{

  public $home = '/home';
  private $data = [];

  public function parse($url = '/home') {
    $this->includeFile('mod_core_base',['content'=>$this->getContent($url)]);
    return true;
  }

  public function includeFile($file,$d = []) {
    $target = explode('_',$file);
    $filetypes = ['html'];
    foreach($filetypes as $type) {
      $userfile = '../layout/html/'.$file.'.'.$type;
      if($target[0] == 'mod') {
        $modulefile = '../modules/'.$target[1].'/layout/'.$type.'/'.$target[2].'.'.$type;
        $this->data = array_merge($this->data,$d);
        if(file_exists($userfile)) {
          include $userfile;
        } elseif(file_exists($modulefile)) {
          include $modulefile;
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
      $content = 'FILE NOT FOUND';
    }
    return $content;
  }

}