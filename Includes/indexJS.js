// Used later to save the current tab
var currentTab = "";
var currentTabsPos = 0;
var linkWidth = 0;
var headRight='230px';
var tTime=1;
var tO;
var curTab;

function switchPic()
  {
  if(tTime<9){
	  
		
    tTime++;

	   $('#topImage').fadeOut('slow', function() {
	   $( "#topImage" ).css( "background", "url(Images/home_banner_"+tTime+"_text.jpg)" );
	   $( "#topImage" ).css( "background-position", "50% 50%" );
	   //$( "#topImage" ).css( "height", "390" );
	   $( "#topImage" ).css( "background-size", "100% 100%" );
       $("#topImage").fadeIn("slow");
  });
  }
  else{ $('#topImage').fadeIn('slow', function() {
    
  });
	  tTime=1;
	   $('#topImage').fadeOut('slow', function() {
	   $( "#topImage" ).css( "background", "url(Images/home_banner_"+tTime+"_text.jpg)" );
	   $( "#topImage" ).css( "background-position", "50% 50%" );
	   //$( "#topImage" ).css( "height", "390" );
	   $( "#topImage" ).css( "background-size", "100% 100%" );
       $("#topImage").fadeIn("slow");
  });
  }
  }
// Re-direct the user to the Mobile site if using an iPhone/iPod/Android
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)))
{
	location.replace("Mobile/home.html");
}
else if((navigator.userAgent.match(/Android/i)))
{
	location.replace("Mobile/home.html");
}

$(document).ready(function() {
	var int=self.setInterval(function(){switchPic()},5000);
	$( "#headerRunner" ).css( "background", "url(Images/pattern.png)" );
	$( "#headerRunner" ).animate( { "height":"8px" }, { queue:false, duration:"fast" } );
	windowResize();
	//window.onresize = windowResize;
	window.onorientationchange = updateOrientation;
});

// Ipad orientation changes
function updateOrientation()
{   
	var orientation=window.orientation;
	switch(orientation)
	{
		case 0:
		$( "body" ).css( "width", "768" );
		windowResize();
		break;
		case 90:
		$( "body" ).css( "width", "1024" );
		windowResize();
		break;
		case -90:
		$( "body" ).css( "width", "1024" );
		windowResize();
		break;
	}
}

// Positions the footer at the bottom
$(function(){
	positionFooter(); 
	function positionFooter(){
		var padding_top = $("#footer").css("padding-top", "" );
		var page_height = $(document.body).height() - padding_top;
		var window_height = $(window).height();
		var difference = window_height - page_height;
		if (difference < 0) 
			difference = 0;

		$("#footer").css({
			padding: difference + "px 0 0 0"
		})
	}

	$(window).resize(positionFooter)
	$(window).resize(windowResize)
});

// Shift the links on the headerRunner
function shiftLinks()
{
	if( currentTab != "" )
	{
		//document.getElementById("clock").innerHTML = ( $( "#headerRunner" ).width() - currentTabsPos.left );
		$( "#runnerLinks" ).css( 'right',headRight);
	}
}

// Encompasses everything activated on the window resize event
function windowResize()
{
	//document.getElementById("clock").innerHTML = 'width'+window.innerWidth;
	currentTabsPos = $( currentTab ).position();
	
	// Following three if statements change the window size, adjusting the css as necessary
	if( $(window).innerWidth() >= 1280 )                              // WINDOW SIZE 1280
	{
		headRight='230px';
		$( "body" ).css( "width", "1280px" );
		$( "#ersLogo" ).css( "margin-left", "18%" );
		$( "#topDiv" ).css( "width", "1280" );
		$( "#headerRunner" ).css( "width", "1280" );
		$( "#tabs" ).css( "margin-right", "10%" );
		$( "#topImage" ).css( "margin-left", "0px" );
		$( "#topImage" ).css( "height", "360" );
		$( "#rightContent" ).css( "float", "right" );
		$( "#rightCol" ).css( "clear", "none" );
		$( "#rightCol" ).css( "float", "right" );
		
	}
	else if( $(window).innerWidth() >= 1024 ) 	                     // WINDOW SIZE 1024
	{
		headRight='105px';
		$( "body" ).css( "width", "1024px" );
		$( "#ersLogo" ).css( "margin-left", "10%" );
		$( "#topDiv" ).css( "width", "1024" );
		$( "#headerRunner" ).css( "width", "1024" );
		$( "#tabs" ).css( "margin-right", "10%" );
		$( "#topImage" ).css( "margin-left", "0px" );
		$( "#topImage" ).css( "height", "360" );
		$( "#rightContent" ).css( "float", "left" );
		$( "#rightCol" ).css( "clear", "none" );
		$( "#rightCol" ).css( "float", "right" );
	}
	else if( $(window).innerWidth() <= 768 ) 	                     // WINDOW SIZE 768
	{
		headRight='20px';
		$( "body" ).css( "width", "768px" );
		$( "#ersLogo" ).css( "margin-left", "2%" );
		$( "#topDiv" ).css( "width", "768" );
		$( "#headerRunner" ).css( "width", "768" );
		$( "#tabs" ).css( "margin-right", "2%" );
/*		$( "#topImage" ).css( "background-size", "53% 53%" );*/
		$( "#topImage" ).css( "height", "190" );
		$( "#rightContent" ).css( "float", "left" );
		$( "#rightCol" ).css( "clear", "both" );
		$( "#rightCol" ).css( "float", "left" );
	}
	
	shiftLinks();

}
function outTab()
{
	//clearTimeout(tO);
	//tO=setTimeout(function(){
	//	$( curTab ).css( "background", "url(Images/pattern.png)" );
		//$( "#headerRunner" ).animate( { "height":"8px" }, { queue:false, duration:"fast" } );},3000);
	//$( "#headerRunner" ).css( "background", "url(Images/pattern.png)" );
}
// When the mouse is over a tab
function overTab( thisTab )
{	
//clearTimeout(tO);
curTab=thisTab;
	// Change the tabs texture
	$( thisTab ).css( "background", "url(Images/pattern2.png)" );
	// Below animates the runner
	$( "#headerRunner" ).animate( { "height":"22px" }, { queue:false, duration:"fast" } );
	$( "#headerRunner" ).css( "background", "url(Images/pattern2.png)" );
	// Show the new tab
	$( "#"+$( thisTab ).attr( "title" ) ).css( "display", "inline" );
	
	// Hide the last tab
	if( currentTab != "" && currentTab != thisTab )
	{
		$( currentTab ).css( "background", "url(Images/pattern.png)" );
		$( "#"+$( currentTab ).attr( "title" ) ).css( "display", "none" );
	}
	
	// Get the new current tab
	currentTab = thisTab;
	currentTabsPos = $( currentTab ).position();
	linkWidth = $( "#runnerLinks" ).width();
	
	shiftLinks();
}
