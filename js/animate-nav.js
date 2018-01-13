$(".link-up, .chevron-up, .block-header, header, h1 a.dim").click(function(){
	if(key == 0){
		$("nav").addClass("nav-toggle");
		key = 1;
	}
	else{
		key = 0;
		$("nav").removeClass("nav-toggle");
	}
	if(ab == 1){
		ab = 0;
	}
})

$(document).ready(function(){
	$("nav ul li a, div.block-overlay a.dim").click(function(){
		key = 0;
		var dataNav = $(this).attr("data-nav");
		var navStart = $(this).is("[data-nav='start']");
		var tweet = $(this).is(".dim");
		var dataPlay = $(".block-content[data-nav='"+dataNav+"']").is(".no-display");
		var data = $(".block-content:not(.no-display)").attr("data-id");
		var about = $(this).attr("data-about");
		$("title").empty().append(about);
		$(".link-right").removeClass("red");
		$(".block-overlay").removeClass("dark-background");
		$("div.contact-form form").removeClass("no-display").find("input, textarea").val("");
		$("div.contact-form div.ajax-result").addClass("no-display");

		if(dataPlay){
			if(w < 768){
				$("nav").removeClass("nav-toggle");
				set = 400;
			}else{}
			var setTard = setTimeout(function(){
				$(".block-content[data-nav='"+dataNav+"']").removeClass("no-display").addClass("go-down");
			}, set);
			var setTime = setTimeout(function(){
				$(".block-content[data-id='"+data+"']").addClass("go-up");
				$(".block-content[data-nav='"+dataNav+"']").removeClass("go-down");
			}, 100 + set);
			var setTimer = setTimeout(function(){
				$("nav").removeClass("nav-toggle");
			},700);
			var setDelay = setTimeout(function(){
				$(".block-content[data-id='"+data+"']").addClass("no-display").removeClass("go-up");
				$(".block-content[data-nav='"+dataNav+"']").removeClass("low-index");
			}, 1300 + set);
			if (tweet) {
				$(".block-overlay").addClass("dim-opacity dark-background");
				ab = 1;
			}
			else if(navStart){
				var setTime = setTimeout(function(){
					$(".block-overlay").removeClass("dim-opacity dark-background");
				}, 1000);
			}
		}
		else{
			$("nav").removeClass("nav-toggle");
			$(".block-overlay").removeClass("dark-background");
			$("header").empty().html(xv);
		}
	})
})