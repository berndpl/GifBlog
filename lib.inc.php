<?php

class images{
	function images($path){
		$this->path = $path;
	}
	function comparedate( $a, $b ){
	   if  ( $a[datesystm] == $b[datesystm] )
	        return 0;
	   if  ( $a[datesystm] > $b[datesystm] )
	         return -1;
	   return 1;
	}	
	function show($format,$order=false){
		$i = 0;
//		var $result;
		$verz=opendir ($this->path);
		while ($file=readdir($verz)){
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
			if ($ext=='gif'){
				if ($format=='quer' && $size[0]>$size[1]){
					$result[$i]["imagepath"] = "pub/$file";
					$result[$i]["imagefile"] = $file;
					$result[$i]["datesystm"] = $datesystm;
					$result[$i]["dateshow"] = $dateshow;
					$result[$i]["name"] = $name;
				}
				if ($format=='hoch' && $size[0]<$size[1]){
					$result[$i]["imagepath"] = "pub/$file";
					$result[$i]["imagefile"] = $file;
					$result[$i]["datesystm"] = $datesystm;
					$result[$i]["dateshow"] = $dateshow;
					$result[$i]["name"] = $name;
				}
			$i++;
			}
		}
		$i = 0;
		closedir($verz);
		if ($order==true)uasort($result,array($this,"comparedate"));		
		return $result;
	}	
}

class bench{ 
    var $start; 
    var $stop; 
    function bench(){ 
      $this->start = 0; 
      $this->stop = 0; 
    } 
    function getmicrotime(){  
        list($usec, $sec) = explode(" ",microtime());  
        return ((float)$usec + (float)$sec);  
    } 
    function start(){ 
       $this->start = $this->getmicrotime(); 
    } 
    function stop(){ 
       $this->stop = $this->getmicrotime(); 
    } 
    function diff(){ 
       $result = $this->stop - $this->start; 
       return round($result,3); 
    } 
  } 


?>