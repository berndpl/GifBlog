<?php
include "inc.config.php";
include "inc.data.php";
include "inc.feedwriter-lib.php";
$x = new images($path.'pub/');

//header
$rss = new UniversalFeedCreator();
$rss->useCached();
$rss->title = "ANIMATION FLOOR by Bernd Plontsch";
$rss->description = "animated gif all over the place";
$rss->link = "http://blog.plontsch.de/";
$rss->syndicationURL = "http://blog.plontsch.de/".$PHP_SELF;

//content
$allimages = $x->show('hoch',true);
foreach ($allimages as $image){
    $item = new FeedItem();
    $item->title = $image["name"];
    $item->link = "http://blog.plontsch.de/";
//	$item->description = "http://plontsch.com/experiments/animatedgallery/".$image["imagepath"];
	$item->description = "<img src=\"http://blog.plontsch.de/".$image["imagepath"]."\" />";	
    $item->date =  date(DATE_RFC2822,strtotime($image["datesystm"]));
    $rss->addItem($item);
}
$xml=$rss->createFeed("2.0");
echo $xml;
?>


