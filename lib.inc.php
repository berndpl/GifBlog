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
	
	function __construct($from=1, $to=999,$path){
		$x = $this->scandirectory($from,$to,$path);
		$this->content = $x;
		return true;
	}  
	
	                
	function scandirectory($from,$to,$path){
		$i = 0;    
		$count = 1; //counting through all files minus "." and ".."
		$files = scandir($path,1);      //scan and sort 0 = DESC   
		
		
		
		for ($z = 0; $z < count($files); $z++){
 			$pieces = explode(".",$files[$z]);
 			$ext = $pieces[1];
 			$name = substr($pieces[0], 7,36);
// 			$size = getimagesize($this->path.$file);
 			//get date
// 		    $creationdate = date ("d.m.y", filectime($this->path.$file));
 			$year = substr($files[$z], 0,2);
 			$month = substr($files[$z], 2,2);
 			$day = substr($files[$z], 4,2);
 			$dateshow = "$day.$month.$year";
 			$datesystm = "$year-$month-$day";
			$w = $z - 1;   
 			$lastpieces = explode(".",$files[$w]);
 			$lastext = $lastpieces[1];
			//echo "<p>class :".get_class($files[$w])."</p>";
 			if (($ext=='gif') and ($lastext != 'mp3') and ($count >= $from) and ($count <= $to)){
					$result[$i] = new ImageEntry($dateshow, $name, "pub/$files[$z]");
			$i++;
 			} else if (($ext=='mp3') and ($count >= $from) and ($count <= $to)){
					$y = $z + 1;                 					
					$result[$i] = new SoundEntry($dateshow, $name, "pub/$files[$z]", "pub/$files[$y]");
			$i++;
 			}
 			
		 $count++;
		}     
		
		 //  echo "<p>INSIDE</p><pre>";
		 //  print_r($result);
		 // echo "</pre>";  
		 //            
	    return $result;
	}  
	

}



?>