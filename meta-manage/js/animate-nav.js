$("div.notification span, header").click(function(){
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

function deposit(a, b, c){
	if(a == "*"+b){
		var sec = 0;
	}
	else{
		var sec = 3000;
	}
	var form = $("div.block-content").not(".no-display").find("div.block form[role='data-form']");
	var dataDivo = parseInt(form.find("[data-div]").attr("data-div")) - 1;
	setTimeout(function(){
		form.find("a.retrieve").text("Send To Database").trigger("click");
	}, 1000);
	setTimeout(function(){
		form.find("hr, div[data-input]:gt("+dataDivo+")").remove();
		form.find("input, textarea").val("");
		form.find("[data-function], span").addClass("no-display");
		form.find("button").removeClass("no-display");
	}, sec);
	
	$("div.block-content").each(function(){
		var tab = $(this).find("h1:first").text();
		if (c == "*"+tab) {
			sync["filen"] = $(this).find("form input[type='file']").length;
		//	alert(sync["filen"]);
		}
	});
}

$(document).ready(function(){
	$("nav ul li a").click(function(){
		var tabloid = $(".block-content").not(".no-display").find("h1:first").text();
		var nav = $(this).text();
		deposit(nav, tabloid, $(this).text());
		var dataNav = $(this).attr("data-nav");
		var navStart = $(this).is("[data-nav='start']");
		var tweet = $(this).is(".dim");
		var dataPlay = $(".block-content[data-nav='"+dataNav+"']").is(".no-display");
		var data = $(".block-content:not(.no-display)").attr("data-id");
		var about = $(this).attr("data-about");
		key = 0;
		
		if(dataPlay){
			if(navTouch == 0){
				navTouch = 1;
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
				setTimeout(function(){
					navTouch = 0
				}, 2000);
			}
		}
		else{
			$("nav").removeClass("nav-toggle");
			$(".block-overlay").removeClass("dark-background");
		}
	})
})