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
	function __construct($date, $title, $soundpath){
		parent::__construct($date, $title);
		$this->soundpath = $soundpath;
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
		
		foreach ($files as $file){
 			$pieces = explode(".",$file);
 			$ext = $pieces[1];
 			$name = substr($pieces[0], 7,36);
 			$size = getimagesize($this->path.$file);
 			//get date
 		    $creationdate = date ("d.m.y", filectime($this->path.$file));
 			$year = substr($file, 0,2);
 			$month = substr($file, 2,2);
 			$day = substr($file, 4,2);
 			$dateshow = "$day.$month.$year";
 			$datesystm = "$year-$month-$day";
 			if (($ext=='gif') and ($count >= $from) and ($count <= $to)){
					$result[$i] = new ImageEntry($dateshow, $name, "pub/$file");
			$i++;
 			} else if (($ext=='mp3') and ($count >= $from) and ($count <= $to)){
					$result[$i] = new SoundEntry($dateshow, $name, "pub/$file");
			$i++;
 			}
 			
		 $count++;
		}     
		
		// echo "<p>INSIDE</p><pre>";
		// print_r($result);
		// echo "</pre>";  
 
	    return $result;
	}  
	

}


// class images{
// 	function images($path){
// 		$this->path = $path;
// 	}
// 	function comparedate( $a, $b ){
// 	   if  ( $a[datesystm] == $b[datesystm] )
// 	        return 0;
// 	   if  ( $a[datesystm] > $b[datesystm] )
// 	         return -1;
// 	   return 1;
// 	}	
// 	
//	function show($format,$order=false){
// 		$i = 0;
// //	var $result;
// 		$verz=opendir ($this->path);
// 		while ($file=readdir($verz)){
// 			$pieces = explode(".",$file);
// 			$ext = $pieces[1];
// 			$name = substr($pieces[0], 7,36);
// 			$size = getimagesize($this->path.$file);
// 			//get date
// 		    $creationdate = date ("d.m.y", filectime($this->path.$file));
// 			$year = substr($file, 0,2);
// 			$month = substr($file, 2,2);
// 			$day = substr($file, 4,2);
// 			$dateshow = "$day.$month.$year";
// 			$datesystm = "$year-$month-$day";
// 			if ($ext=='gif'){
// 				if ($format=='quer' && $size[0]>$size[1]){
// 					$result[$i]["imagepath"] = "pub/$file";
// 					$result[$i]["imagefile"] = $file;
// 					$result[$i]["datesystm"] = $datesystm;
// 					$result[$i]["dateshow"] = $dateshow;
// 					$result[$i]["name"] = $name;
// 				}
// 				if ($format=='hoch' && $size[0]<$size[1]){
// 					$result[$i]["imagepath"] = "pub/$file";
// 					$result[$i]["imagefile"] = $file;
// 					$result[$i]["datesystm"] = $datesystm;
// 					$result[$i]["dateshow"] = $dateshow;
// 					$result[$i]["name"] = $name;
// 				}
// 			$i++;
// 			}
// 		}
// 		$i = 0;
// 		closedir($verz);
// 		if ($order==true)uasort($result,array($this,"comparedate"));		
// 		return $result;
// 	}	
// }
// 
// class bench{ 
//     var $start; 
//     var $stop; 
//     function bench(){ 
//       $this->start = 0; 
//       $this->stop = 0; 
//     } 
//     function getmicrotime(){  
//         list($usec, $sec) = explode(" ",microtime());  
//         return ((float)$usec + (float)$sec);  
//     } 
//     function start(){ 
//        $this->start = $this->getmicrotime(); 
//     } 
//     function stop(){ 
//        $this->stop = $this->getmicrotime(); 
//     } 
//     function diff(){ 
//        $result = $this->stop - $this->start; 
//        return round($result,3); 
//     } 
//   }                      


?>