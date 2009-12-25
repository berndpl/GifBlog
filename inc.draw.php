<?php    
include_once "inc.config.php";
include_once "inc.data.php";

if (isset($_GET['page'])){
	$start = ($_GET['page']-1)*$itemsperpage;
	$entries = new ListEntry ($start,$itemsperpage-1,$path);  
} else {
	$entries = new ListEntry (0,$itemsperpage-1,$path); 
}	

$mem;
for ($i = 0; $i < count($entries->content); $i++){
	 	echo "\n".'<div class="entry">'."\n";
		echo '	<img src="'.$entries->content[$i]->imagepath.'" alt="'.$entries->content[$i]->title.'" />'."\n";
	 	if ($entries->content[$i]->date!=$mem){
	 		echo '	<div class="date">'.$entries->content[$i]->date.'</div>'."\n";
	 	}
	 	if (strpos($entries->content[$i]->title,'blank') === false){
	 		echo '	<div class="title">';
	 	}
	
	
	    if (get_class($entries->content[$i])=='SoundEntry'){
			$filenamestart=split("/",$entries->content[$i]->soundpath);
			$filenameuse = $filenamestart[1]; 
            $filename=explode(".",$filenameuse);
			echo '	<span class="sound">';
			echo '<a href="'.$entries->content[$i]->soundpath.'" class="soundcontrol" id="'.$entries->content[$i]->soundpath.'">'.$entries->content[$i]->title.'</a><img src="js/headphone.gif" class="soundstatus" id="'.$entries->content[$i]->title.'" alt="play sound">';
			echo '</span>'."\n";
		} else {
			echo $entries->content[$i]->title;
		}

        echo '</div>'."\n"; //end title
	 	echo '</div>'."\n"; //end entry
	 	$mem = $entries->content[$i]->date;             
}  
                            
?>                                   

