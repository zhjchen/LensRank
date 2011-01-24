
<?php
class SimpleClass {
	public $var = 'a default value';
	public function displayVar() {
		print $this->var."\n";
	}
	
	function foo () {
		$var = "another vaule\n";
		print $var."\n";
	}
}
$a = new SimpleClass();
$a -> displayVar();
SimpleClass::foo();
print gettype($a)."\n";

$instance = new SimpleClass();
$assigned = & $instance;  // note here. this is copy. not clone

$instance->var = "have new value";
print $assigned-> displayVar();

var_dump($assigned);
$instance = null;
print $assigned -> displayVar();

?>
