<?php

class Entry{
	function __construct($date, $title){
		$this->date = $date; //format? date ("d.m.y", filectime($this->path.$file)); 
		$this->title = $title; //$pieces = explode(".",$file); $ext = $pieces[1]; $name = substr($pieces[0], 7,36);
	return $this;
	}
}     

class ImageEntry extends Entry{
	function __construct($date, $title, $imagepath){
		parent::__construct($date, $title);
		$this->imagepath = $imagepath;
		return $this;
	}
}

class SoundEntry extends Entry{
	function __construct($date, $title, $soundpath, $imagepath){
		parent::__construct($date, $title, $imagepath);
		$this->soundpath = $soundpath;
		$this->imagepath = $imagepath;   
		return $this;
	}
}

//-----------------------


class ListEntry{
	
	var $content;
	
	function __construct($start, $items,$path){
		$x = $this->scandirectory($start,$items,$path);
		$this->content = $x;
		return true;
	}  
	                
	function scandirectory($start,$items,$path){
		$i = 0; 	//total file counter
		$f = 0;		//set file counter
		$files = scandir($path,1);      //scan and sort 0 = DESC   
				
		 // echo "<p>IN</p><pre>";
		 // print_r($files);
		 // echo "</pre>"; 
		
		for ($z = 0; ($z < (count($files))-3) && ($f <= $items); $z++){ // -3 because of ".", "..", ".DS_Store"
 			//extract display content
			$pieces = explode(".",$files[$z]);
 			$ext = $pieces[1];
 			$name = substr($pieces[0], 7,36);	// the title
 			$year = substr($files[$z], 0,2);
 			$month = substr($files[$z], 2,2);
 			$day = substr($files[$z], 4,2);
 			$dateshow = "$day.$month.$year";	// the date
			$y = $z - 1;   //last file
 			$lastpieces = explode(".",$files[$y]);
 			$lastext = $lastpieces[1];
  			if (($ext=='gif') && ($lastext == 'mp3')){
				if ($i++ >= $start){ // soviele schleifen mit befüllen wareten bis min. erreicht ist
					$result[$f] = new SoundEntry($dateshow, $name, "pub/$files[$y]", "pub/$files[$z]");  //SoundEntry: $date, $title, $soundpath, $imagepath
					$f++;
				}				
			} else if (($ext=='gif') && ($lastext != 'mp3')) {
				if ($i++ >= $start){
					$result[$f] = new ImageEntry($dateshow, $name, "pub/$files[$z]");
					$f++;
				}
			} 
		}
		     
	    // echo "<p>OUT</p><pre>";
	    // print_r($result);
	    // echo "</pre>";  
	
    return $result;
	}  
}



?>