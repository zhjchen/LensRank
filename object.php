<?php
function __autoload ($class_name) {
  require '../'.$class_name.'.php';
}
$obj1 = new Test();
var_dump($obj1);
print $obj1->var."\n";
?>
