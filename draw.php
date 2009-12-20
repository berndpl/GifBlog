<?php    
include_once "config.inc.php";
include_once "lib.inc.php";

function draw($from=1,$to,$path){

	if (isset($_GET['from']) and isset($_GET['to'])){
		$entries = new ListEntry ($_GET['from'],$_GET['to'],$path);
	} else {
		$entries = new ListEntry ($from,$to,$path);
	}	
	
	
	$mem;
	for ($i = 0; $i < count($entries->content); $i++){
		if (get_class($entries->content[$i])=='ImageEntry'){
		 	echo '<div class="entry"><img src="'.$entries->content[$i]->imagepath.'" alt="'.$entries->content[$i]->title.'" />';
		 	if ($entries->content[$i]->date!=$mem){
		 		echo '<div class="date">'.$entries->content[$i]->date.'</div>';
		 	}
		 	if (strpos($entries->content[$i]->title,'blank') === false){
		 	echo '<div class="title">'.$entries->content[$i]->title.'</div>'; 		
		 	}
		    if (get_class($entries->content[$i-1])=='SoundEntry'){
			$filenamestart=split("/",$entries->content[$i-1]->soundpath);
			$filenameuse = $filenamestart[1]; 
            $filename=explode(".",$filenameuse);
			echo '<div class="sound">';
			echo '<a href="#" class="soundcontrol-play" id="'.$filename[0].'" onclick=\'playthis("'.$entries->content[$i-1]->soundpath.'");\'>play sound</a>';
			echo '</div>';
			}
		 	echo '</div>';
		 	$mem = $entries->content[$i]->date;             
		}
	}
}    


?>                                   

