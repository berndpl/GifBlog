<?php 
include "config.inc.php";
include "lib.inc.php";

$b = new bench; 
$b->start(); 
$x = new images($path.'pub/');
?>

		<?php

		$allimages = $x->show('hoch',true);
		echo json_encode($allimages);
		
/*
		foreach ($allimages as $image){
			echo '<div class="image"><img src="'.$image["imagepath"].'" alt="'.$image["name"].'" />';
			if ($image['dateshow']!=$mem){
				echo '<div class="date">'.$image['dateshow'].'</div>';
			}
			if (strpos($image['name'],'blank') === false){
			echo '<div class="title">'.$image['name'].'</div>';
			}
			echo '</div>';
			$mem = $image['dateshow'];
		}
*/