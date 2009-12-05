<?php 
include "config.inc.php";
include "lib.inc.php";

$b = new bench; 
$b->start(); 
$x = new images($path.'pub/');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="alternate" type="application/rss+xml" title="ANIMATION FLOOR - RSS Feed" href="http://blog.plontsch.de/feed.php" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>ANIMATION FLOOR, a blog by Bernd Plontsch</title>
		<script type="text/javascript" src="jquery.js"></script>
		
		<script type="text/javascript">
$('document').ready(function() 
{ 
    $('#mylist a').click(function ()
    {
        var id = $(this).attr('rel');

        $.getJSON('jindex_getinfo.php', {'id' : id}, parseInfo);
    });
});

function parseInfo(data)
{
    $('#info').html(data.name +', '+ data.email);
} 
		</script>

	</head>
	<body>

<ul id="mylist">
    <li><a rel="3" href="/#dave">Dave's email address</a></li>
    <li><a rel="4" href="/#erik">Erik's email address</a></li>
</ul>

<p id="info">&nbsp;</p> 

		<?php
/*
		$allimages = $x->show('hoch',true);
		echo json_encode($allimages);
		$mem;
*/
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


		
		?>

		:: welcome to my blog. subscribe to <a href="http://blog.plontsch.de/feed.php">rss</a> :: <a href="about.html"> about</a> :: <a href="http://plontsch.de/">projects</a> :: <a href="http://twitter.com/ohrobot">twtr</a> :: contact bernd@plontsch.de
		
		<?php
		//include google analytics footer if placed in the according folder
		$analytics = $path.'.private/googleanalytics-code.inc'; 
        if (file_exists($analytics)) { 
            include '.private/googleanalytics-code.inc'; 
        } else { 
            echo "$analytics does not exist"; 
        } 
		?>

	</body>
<?php
$b->stop(); 
echo "<div class=\"sysmessage\">[".$b->diff()."]</div>";
?>
</html>