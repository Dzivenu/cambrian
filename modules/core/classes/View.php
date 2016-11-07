<?php
Class CambrianView
{

  public function parse() {
    $this->includeFile('mod_core_base');
    return true;
  }

  public function includeFile($file) {
    $target = explode('_',$file);
    $filetypes = ['html'];
    foreach($filetypes as $type) {
      $userfile = '../layout/'.$file.'.'.$type;
      if($target[0] == 'mod') {
        $modulefile = '../modules/'.$target[1].'/layout/'.$type.'/'.$target[2].'.'.$type;
        if(file_exists($userfile)) {
          include $userfile;
        } elseif(file_exists($modulefile)) {
          include $modulefile;
        }
      }
    }
  }

}