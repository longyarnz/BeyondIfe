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

screenSize();

$(window).resize(function(){
	v = window.innerHeight || document.documentElement.clientheight || document.body.clientheight;
	screenSize();
})

$(document).ready(function(){
	$("nav").mouseleave(function(){
		$(this).removeClass("nav-toggle");
		key = 0;
	})

	$(".twitch").click(function(){
		if($(this).is(".koja")){}
		else{
			$(this).addClass("koja");
			var length = $(".block-content").not(".block-content[data-nav]").length;
			var data = $(".block-content:not(.no-display)").attr("data-id");
			$(".block-overlay").removeClass("dark-background");
			$("nav").removeClass("nav-toggle");
			key = 0;

			if($(this).is(".link-left")){
				var x = parseInt(data) - 1 || "undefined";
				if (x < 1 || x == "undefined") {
					x = length + 1;
				}

				$(".block-content[data-id='"+data+"']").addClass("low-index");
				$(".block-content[data-id='"+x+"']").addClass("go-up").removeClass("no-display");
				var setTime = setTimeout(function(){
					$(".block-content[data-id='"+data+"']").addClass("go-down");
					$(".block-content[data-id='"+x+"']").removeClass("go-up");
				}, 200);
				var setDelay = setTimeout(function(){
					$(".block-content[data-id='"+data+"']").addClass("no-display").removeClass("low-index go-down");
					$(".link-left, .link-right").removeClass("koja");
				}, 2000);

			}
			else if($(this).is(".link-right") && key == 0){
				var x = parseInt(data) + 1 || undefined;
				if (x > length + 1 || x == undefined) {
					x = 1;
				}

				$(".block-content[data-id='"+data+"']").addClass("low-index");
				$(".block-content[data-id='"+x+"']").addClass("go-down").removeClass("no-display");
				var setTime = setTimeout(function(){
					$(".block-content[data-id='"+data+"']").addClass("go-up");
					$(".block-content[data-id='"+x+"']").removeClass("go-down");
				}, 200);
				var setDelay = setTimeout(function(){
					$(".block-content[data-id='"+data+"']").addClass("no-display").removeClass("low-index go-up");
					$(".link-left, .link-right").removeClass("koja");
				}, 2000);
			}
			else if($(this).is(".link-right") && key == 1 && w < 768){
				$("nav").removeClass("nav-toggle-sm");
				$(".link-left, .link-right").removeClass("koja");
				$(".link-right").removeClass("red");
				key = 0;

				if (ab == 0) {
					$(".block-overlay").removeClass("dim-opacity");
				}
				else if(ab == 1){
					$(".block-overlay").addClass("dim-opacity");
				}
			}
		}
	})
})