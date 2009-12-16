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
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/jquery.preload-min.js" type="text/javascript" charset="utf-8"></script>				
		<script type="text/javascript">   
		console.log('start');
				jQuery(function( $ ){
				$('#summary').fadeIn('slow');

				/**
				* All the functions below, are used to update the summary div
				 * That is not the objective of the plugin, the really important part
				 * is the one right below. The option placeholder, and threshold.
				 */
				 $.preload( '.entry img', {//the first argument is a selector to the images
				 onRequest:request,
				 onComplete:complete,
				 onFinish:finish,
				 placeholder:'js/loader.gif',//this is the really important option
				 notFound:'js/missing.gif',//optional image if an image wasn't found
				 threshold: 6 //'2' is the default, how many at a time, to load.
				 }); 

				 function update( data ){
				 $('#done').html( ''+data.done );
				 $('#total').html( ''+data.total );
				 $('#loaded').html( ''+data.loaded );
				 $('#failed').html( ''+data.failed );
				 };
				 function complete( data ){
				 update( data );
				 $('#image-next').html( 'none' );//reset the "loading: xxxx"
				 $('#image-loaded').html( data.image );
				 };
				 function request( data ){
				 update( data );
				 $('#image-next').html( data.image );//set the "loading: xxxx"
				 };
				 function finish(){//hide the summary
				 $('#summary').fadeOut('slow');
				 };
				});
		</script>
	</head>
	<body>
		<?php
		$allimages = $x->show('hoch',true);
		$mem;
		foreach ($allimages as $image){
			echo '<div class="entry"><img src="'.$image["imagepath"].'" alt="'.$image["name"].'" />';
			if ($image['dateshow']!=$mem){
				echo '<div class="date">'.$image['dateshow'].'</div>';
			}
			if (strpos($image['name'],'blank') === false){
			echo '<div class="title">'.$image['name'].'</div>';
			}
			echo '</div>';
			$mem = $image['dateshow'];
		}
		
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
