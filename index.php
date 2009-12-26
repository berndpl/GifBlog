<?php 
include_once "inc.config.php";
include_once "inc.data.php";
//include "draw.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="alternate" type="application/rss+xml" title="ANIMATION FLOOR - RSS Feed" href="http://blog.plontsch.de/feed.php" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>ANIMATION FLOOR, a blog by Bernd Plontsch</title>
		<script src="js/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.preload-min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.jplayer.js" type="text/javascript" charset="utf-8"></script> 		
		<script type="text/javascript" charset="utf-8"> 
		  
		// PRELOADER 

		// jQuery(function( $ ){
		// 
		// 	$('#summary').fadeIn('slow');
		// 	$.preload( '.entry img', {//the first argument is a selector to the images
		// 		onRequest:request,
		// 		onComplete:complete,
		// 		onFinish:finish,
		// 		placeholder:'js/loader.gif',//this is the really important option
		// 		notFound:'js/missing.gif',//optional image if an image wasn't found
		// 		threshold: 5 //'2' is the default, how many at a time, to load.
		// 	});
		// 	function update( data ){
		// 	 	$('#done').html( ''+data.done );
		// 	 	$('#total').html( ''+data.total );
		// 	 };
		// 	function complete( data ){
		// 	 	update( data );
		// 	};
		// 	function request( data ){
		// 	 	update( data );
		// 	};
		// 	function finish(){//hide the summary
		// 	 	$('#summary').fadeOut('slow');
		// 	};
		// 
		// });   

				
		$(document).ready(function(){	 
	 
		//NON-JAVASCRIPT COMPATABILITY

	    $(".entry a").attr("href", "#");

		//GOOGLE ANALYTICS LINK TRACKING
		
		$("a").click(function(){
            pageTracker._trackPageview('/links/'+ $(this).attr('href'));
		});
		
		//JPLAYER
	
		$("#jquery_jplayer").jPlayer({
				ready: function () {
		 }
		}).onProgressChange( function(lp,ppr,ppa,pt,tt) {
			$("#pcent").text(parseInt(ppa)+"%");
		 });
	
		function playthis($soundfile) {
		 $("#jquery_jplayer").setFile($soundfile).play();
		 return false;
		}   
	
		function splitpath(fullpath){
			var patha = fullpath;
			var pathb = patha.split("/");
			var pathc = pathb[1].split(".");
			var pathd = pathc[0].split("_");
			var pathe = pathd[1];	
		return pathe;
		} 

		var playing = ''; //init playing

		$(".soundcontrol").click(function() {
			 console.log(this.id);	
			 $("#trackname").text($(this.id).text());
			 if (playing == this.id) {
				var status = "#"+splitpath(this.id);           
				$(status).attr("src", "js/headphone.gif");
		        $("#jquery_jplayer").stop();
			 	console.log("stop "+this.id);	
				playing = 0;
			} else {
			 	$("#jquery_jplayer").setFile(this.id).play(); 
				var status = "#"+splitpath(this.id);           
				$(".soundstatus").attr("src", "js/headphone.gif"); 	//reset status img
				$(status).attr("src", "js/headphone_play.gif");		//set stop image
			 	console.log("play "+this.id);		
			 	playing = this.id;
			}
			 	return false;
			});  
		});  
 
		</script>
	</head>
	<body>      

	<div id="jquery_jplayer" style="position: absolute; top: 0px; left: 0px;">
	<embed height="0" width="0" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="always" flashvars="id=jquery_jplayer&amp;fid=jqjp_flash_1&amp;vol=80" quality="high" bgcolor="#ffffff" src="js/Jplayer.swf" id="jqjp_flash_1" name="jqjp_flash_1"/>
	<div id="jqjp_force_1" style="text-indent: -9999px;">0.9782846976523163
	</div>
	</div>
		<div>
			<?php include 'inc.draw.php'; ?>              
		</div>                            
		<div style="clear:both;"></div>
		<div>
			<ul id="pagination">        
			<?php    
			 //Pagination
			 $x = new ListEntry(1,9999,$path);   //start, items, path
			 $count = count($x->content);
			 $pages = ceil($count/$itemsperpage);
			 for($i=1; $i<=$pages; $i++) {
				$style = '';
				if ($i == $_GET['page'] || ((!isset($_GET['page']) && ($i == 1)))) {
					$style = 'id ="current"';
				} 
			 	echo '<a class="paginator" '.$style.'" href="?page='.$i.'">'.$i.'</a> ';
			 }              
			?>   
			</ul>  	
			<div id="summary" style="display:none;">loading ... <span id="done"></span> of <span id="total"></span></div>
			<div><h1>this is my blog. welcome! click on posts marked with a "<img src="js/headphone_black.gif" alt="headphone"/>" to listen to additional field recordings :: <strong>bernd plontsch</strong> :: <a href="mailto:bernd@plontsch.de" onclick="pageTracker._trackEvent('index', 'external link', 'mail');">mail</a> :: <a href="http://wiki.github.com/ohrobot/animationfloor" onclick="pageTracker._trackEvent('index', 'external link', 'script');">script</a> :: <a href="http://plontsch.de" onclick="pageTracker._trackEvent('index', 'external link', 'projects');">projects</a><h1></div>
		</div>
		
		<?php
		//include google analytics code
        if (file_exists('inc.googleanalytics-code.php')) { 
            include 'inc.googleanalytics-code.php'; 
        }
		?>		
	</body>
</html>
