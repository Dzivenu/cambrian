<?php
/**
 *
 * Start the magic
 *
 **/
$before = microtime(true);
require_once('../modules/core/Cambrian.php');
$cambrian = new Cambrian\Cambrian();
if($cambrian->config['debug'] == true):
  $after = microtime(true);
  echo ($after-$before) . " sec";
endif;