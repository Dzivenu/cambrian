<?php
#$debug = 1;

/**
 * active modules 
 *
 * ['modulename'=>['param1'=>1]] for a selection of modules in /modules
 *
 * you need to care for dependencies of modules yourself
 * @todo module management
 */
$modules = [
  'navigation'=>true,
  'csscrush'=>[
    'input_file'=>'../layout/css/main.css',
    'output_dir'=>'../public/css',
    'output_file'=>'style'
  ]
];

#$layout = 'mod_core_base';
