<?php
Class CambrianView
{

  private $data = []

  public function parse() {
    $this->includeFile('mod_core_base');
    return true;
  }

  public function includeFile($file,$data = []) {
    $target = explode('_',$file);
    $filetypes = ['html'];
    foreach($filetypes as $type) {
      $userfile = '../layout/html/'.$file.'.'.$type;
      if($target[0] == 'mod') {
        $modulefile = '../modules/'.$target[1].'/layout/'.$type.'/'.$target[2].'.'.$type;
        $this->data = $data;
        if(file_exists($userfile)) {
          include $userfile;
        } elseif(file_exists($modulefile)) {
          include $modulefile;
        }
      }
    }
  }

}