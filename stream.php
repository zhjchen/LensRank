
<?php
fwrite(STDOUT, "pick some colors (enter the letter and press return)\n");
$colors = array( 'a'=>'Red', 'b'=>'Black', 'c'=>"Blue");

fwrite(STDOUT, "Enter 'q' to quit\n");
foreach ($colors as $choice => $color) {
	fwrite(STDOUT, "\t$choice: $color\n");
}

do {
	do {  $selection = fgetc(STDIN);}
	while(trim($selection) =='');
	if (array_key_exists($selection, $colors) ) {
		fwrite(STDOUT,"You picked {$colors[$selection]}\n" );
	} 
} while($selection != 'q');

exit(0);

?>
