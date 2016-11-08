<?php
class CambrianCSSCrush
{
  public function __construct($params) {
    csscrush_file($params['input_file'],['output_dir'=>$params['output_dir'],'output_file'=>$params['output_file']]);
  }
}

require_once '../vendors/css-crush/CssCrush.php';
$cssc = new CambrianCSSCrush($this->config['modules']['csscrush']););