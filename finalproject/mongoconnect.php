<?php

//$mongo = new MongoDB\Client('mongodb://root:123456@ds257589.mlab.com:57589/it635sql');
$id = 1;
try
{
	$mdb = new MongoDB\Driver\Manager("mongodb://root:123456@ds257589.mlab.com:57589/it635sql");	
	$insertrecord = new MongoDB\Driver\BulkWrite;
	$insertrecord->insert(['companyID' => 3, 'note' => "Adding a note from the script"]);
	$mdb->executeBulkWrite('it635sql.client', $insertrecord);
}
//echo $note;
catch(exception $e)
{
	print_r($e);
}
?>
