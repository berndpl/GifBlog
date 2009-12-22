<?php    
include_once "config.inc.php";
include_once "data.inc.php";



if (isset($_GET['page'])){
	$start = ($_GET['page']-1)*$itemsperpage;
	$entries = new ListEntry ($start,$itemsperpage-1,$path); 
	//$entries = new ListEntry (4,25,$path); 
} else {
	$entries = new ListEntry (0,9999,$path); 
//	echo "ho".$itemsperpage;
}	
//print_r($entries->content);	

$mem;
for ($i = 0; $i < count($entries->content); $i++){
	 	echo "\n".'<div class="entry">'."\n";
		echo '	<img src="'.$entries->content[$i]->imagepath.'" alt="'.$entries->content[$i]->title.'" />'."\n";
	 	if ($entries->content[$i]->date!=$mem){
	 		echo '	<div class="date">'.$entries->content[$i]->date.'</div>'."\n";
	 	}
	 	if (strpos($entries->content[$i]->title,'blank') === false){
	 		echo '	<div class="title">'.$entries->content[$i]->title.'</div>'."\n";
	 	}
	    if (get_class($entries->content[$i])=='SoundEntry'){
			$filenamestart=split("/",$entries->content[$i]->soundpath);
			$filenameuse = $filenamestart[1]; 
            $filename=explode(".",$filenameuse);
			echo '	<div class="sound">';
			echo '<a href="'.$entries->content[$i]->soundpath.'" class="soundcontrol-play" id="'.$filename[0].'" onclick=\'playthis("'.$entries->content[$i]->soundpath.'");\'>play sound</a>';
			echo '</div>'."\n";
		}
	 	echo '</div>'."\n";
	 	$mem = $entries->content[$i]->date;             
}  
    


?>                                   

