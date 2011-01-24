
<?php


function connectDatabase() {
$user ="";
$password="";
$database = "test";
$con = mysql_connect("localhost", $user, $password);
if (! $con) {
	die ('Could not connect: '.mysql_error() );
}
mysql_select_db("test", $con);
return $con;
}

function milestones($top) {

$con = connectDatabase();

$sql = "select * from lensrank where rank < 100";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)) {
	$dict_lensrank[$row[1]] = $row[0];
	print $row[1]."\t".$row[0]."\n";
}

$sql = "select * from lensrank_best";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
	$dict_lensrank_best[$row[1]] = $row[0];	
}

foreach ($dict_lensrank as $key => $newrank) 
{
	if (array_key_exists($key, $dict_lensrank_best) ) {
		$oldrank = $dict_lensrank_best[$key];
		if ( ($newrank - $oldrank) <= 0) {
			print "better\n";
			$ranking = compareRank($newrank, $oldrank, $top);
			if ($ranking != 0) {
			$milestone_list[$key] = $ranking;
			}
			$result = mysql_query("select * from lensrank where lens_id=$key");
			$row = mysql_fetch_array($result);
		//	$time = strto($row[2]);
			print gettype($time)."\t".$time."\n";
			mysql_query("update lensrank_best set best_rank=$newrank, date_calculate=now()  where lens_id=$key");
			
		}
	}
	else {
		mysql_query("insert into lensrank_best (best_rank, lens_id, date_calculated) values ($newrank, $key, NULL)");
		// for the new entry, do you need to notify if its ranking is top?
	}
}

mysql_close($con);
return $milestone_list;

}

function compareRank ($newRank, $oldRank, $top) {

}
$top = array(100, 500, 100);
milestones($top);

?>
