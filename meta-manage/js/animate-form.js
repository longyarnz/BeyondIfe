function screenSize(){
	if(w < 768){
		$(".section-top").height(v - 26);
	}
	else{
		$(".section-top").height(v - 34);
		$(".twitter-timeline").attr({"data-height" : v - 40, "data-width" : w * 0.85});
	}

	if(w > v){
		$(".img-sm").remove();
	}
	else{
		$(".img-lg").remove();
	}
}

function structure(options, location){
	location.html(location);
}


$(document).ready(function(){
	$(window).resize(function(){
		v = window.innerHeight || document.documentElement.clientheight || document.body.clientheight;
		screenSize();
	})

	$("[role='host']").val(window.location.hostname);
})