<?php 
include_once "config.inc.php";
include_once "lib.inc.php";

include "draw.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="alternate" type="application/rss+xml" title="ANIMATION FLOOR - RSS Feed" href="http://blog.plontsch.de/feed.php" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>ANIMATION FLOOR, a blog by Bernd Plontsch</title>
		<script src="js/jquery-1.2.6.min.js" type="text/javascript"></script>
		<script src="js/jquery.preload-min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.quickpaginate.packed.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.jplayer.js" type="text/javascript"></script> 		
		
		<script type="text/javascript">   
		console.log('start');

		// PAGINATOR

		$(function(){
			$(".entry").quickpaginate({ perpage: 12, showcounter: false, pager : $("#pager") });
			$(".qp_next").attr('innerHTML', 'newer'); 
			$(".qp_prev").attr('innerHTML', 'older');		
		});

		// PRELOADER 

		jQuery(function( $ ){
			$.preload( '.entry img', {//the first argument is a selector to the images
				onRequest:request,
				onComplete:complete,
				onFinish:finish,
				placeholder:'js/loader.gif',//this is the really important option
				notFound:'js/missing.gif',//optional image if an image wasn't found
				threshold: 2 //'2' is the default, how many at a time, to load.
			});
			function update( data ){
			 	$('#done').html( ''+data.done );
			 	$('#total').html( ''+data.total );
			 };
			function complete( data ){
			 	update( data );
			};
			function request( data ){
			 	update( data );
			};
			function finish(){//hide the summary
			 	$('#summary').fadeOut('slow');
			};
		});   

		// SOUND PLAYER
		
		$(document).ready(function() {
		  $("#jpId").jPlayer( {
		    ready: function () {
		    },
		  });
		});
		
		var playing = 0;
		function playthis($file){
			if (playing == 0){
				$("#jpId").setFile($file).play();
				playing = 1;				
			} else {
  			   $("#jpId").stop();
				playing = 0;  
			} 
		}
			      
		</script>
	</head>
	<body>            
		<div id="jpId"></div>
		<div>
			<?php draw(1,$to,$path); ?>              
		</div>
		<div style="clear:both;"></div>
		<div>
			<p><div id="pager"></div></p>  	
			<p><div id="summary">loading ... <span id="done"></span> of <span id="total"></span></div></p>
			<p><div class="paragraph"> this is my blog. welcome. :: contact bernd@plontsch.de </div></p>			
			
		</div>
	</body>
</html>
