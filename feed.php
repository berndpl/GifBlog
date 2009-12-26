<?php 

include_once "inc.config.php";
include_once "inc.data.php"; 

header("Content-Type: application/rss+xml; charset=utf-8");  

$rssfeed = '<?xml version="1.0" encoding="utf-8"?>';  
$rssfeed .= '<rss version="2.0">';  
$rssfeed .= '<channel>';  
$rssfeed .= '<title>ANIMATION FLOOR by Bernd Plontsch</title>';  
$rssfeed .= '<link>http://blog.plontsch.de/</link>';  
$rssfeed .= '<description>animations and field recordings</description>';
//$rssfeed .= '<pubDate>Mon, 21 Dec 2009 10:25:32 PST</pubDate>';
//$rssfeed .= '<lastBuildDate>Mon, 21 Dec 2009 10:25:32 PST</lastBuildDate>';
$rssfeed .= '<image>';
$rssfeed .= '<link>http://blog.plontsch.de/</link>';
$rssfeed .= '<url>http://blog.plontsch.de/feedlogo_tanne.jpg</url>';
$rssfeed .= '<title>blog.plontsch.de</title>';
$rssfeed .= '</image>';  
$rssfeed .= '<language>en-us</language>';  
$rssfeed .= '<copyright>Copyright (C) 2010 Bernd Plontsch</copyright>';     
  
$entries = new ListEntry (0,25,$path); 
foreach ($entries->content as $entry) {  
	$rssfeed .= '<item>';  
	$rssfeed .= '<title>' . $entry->title . '</title>';  
	$rssfeed .= '<description><![CDATA[<p><img src="http://blog.plontsch.de/'.$entry->imagepath.'" alt="'.$entry->title.'" /></p>]]></description>';  
	if (isset($entry->soundpath)){ 
		$rssfeed .= '<enclosure url="http://blog.plontsch.de/'.$entry->soundpath.'" type="audio/mpeg" />';
	} 
	$rssfeed .= '<link>http://blog.plontsch.de/</link>';
	$thisdate = explode (".", $entry->date);
	$feedthisdate = '20'.$thisdate[2].'-'.$thisdate[1].'-'.$thisdate[0];
	$rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($feedthisdate)) . '</pubDate>';  
	$rssfeed .= '</item>'."\n";
}      
$rssfeed .= '</channel>';  
$rssfeed .= '</rss>';      

echo $rssfeed;           

?>