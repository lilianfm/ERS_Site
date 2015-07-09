function loaded() {
	$("#bt1").css("height","39px");
	$("#bt2").css("height","39px");
	$("#bt3").css("height","39px");
	$("#bt4").css("height","39px");
	$("#bt5").css("height","39px");
	runCheck();
	
	window.onorientationchange=updateOrientation;
 
}
window.onresize = function(event) {
	
}
function run320(){
	//$("#mybtnHol").css("background","url(imageT.png)");
	//$("#ersBottomBarDiv").css("height","50px");
	//$("#floater3").css("float","none");
	//$("#floater4").css("float","none");
	//$("#floater5").css("float","none");
	
	//$("#floater1").css("float","none");
	//	$("#ersBottomBarDiv").css("text-align","center");
	
		
}
function run480(){
		$("#ersBottomBarDiv").css("text-align","left");
	//$("#mybtnHol").css("background","url(imageT2.png)");
	//$("#floater3").css("float","left");
	//$("#floater4").css("float","left");
	//$("#floater5").css("float","left");
	
	//$("#floater1").css("float","right");
	//$("#ersBottomBarDiv").css("height","25px");
}

function runCheck(){
if(window.innerWidth==320){
		run320();
	}
	else{
		run480();
	}	
}
function updateOrientation()
{   
var orientation=window.orientation;
 switch(orientation)
    {

        case 0:
		run320();
	break;
		case 90:
		run480();
	break;
		case -90:
		run480();
	break;
	}

}
/*
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)))
{


}
else if((navigator.userAgent.match(/iPad/i)))
{
	location.replace("http://174.123.234.135/Alex/website/");

}
else if((navigator.userAgent.match(/Android/i)))
{

}
else{
	location.replace("http://174.123.234.135/Alex/website/");
}
*/
function minThis(idd){
	//alert(idd);
	for(var i=1;i<5;i++){
		if(i!=idd){
			
		$("#bt"+i).css("height","39px");
$("#bt"+i).css("background-image","url(pattern.png)");
		}
	}
	
}
function expand(elem){
	if(elem.style.height!="205px"){
		minThis(elem.id);
		//$(elem).html( "ABOUT US </br> Hello" );
$(elem).css("background-image","url(pattern2.png)");
	  $(elem).animate({ 
    height: "205px"
  }, 100 );

//$(this.event.target).html("ABOUT US </br>MISSION STATEMENT</br>COMPANY HISTORY");

	}
	else{

		//$(elem).css("height","39px");
		
//$(elem).css("background-image","url(pattern.png)");
	}
}
