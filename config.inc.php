<?php

//VIEW
$path_file = pathinfo($_SERVER["SCRIPT_FILENAME"]);
$mediafolder = '/pub';
$path = $path_file ['dirname'].$mediafolder;

$itemsperpage = 10;
$to = 9999; //max entries to show

?>
