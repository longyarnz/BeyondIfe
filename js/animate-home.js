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

function countDown(){
	var days, hours, minutes, seconds, milliSeconds, modulus; 
	milliSeconds = Date.parse("November 25, 2017");
	milliSeconds -= new Date();

	days = milliSeconds / (1000 * 60 * 60 * 24);
	modulus = days % 1;
	days -= modulus;

	hours = modulus * 24;
	modulus = hours % 1;
	hours -= modulus;

	minutes = modulus * 60;
	modulus = minutes % 1;
	minutes -= modulus;

	seconds = modulus * 60;
	modulus = seconds % 1;
	seconds -= modulus;

	for (var i = 0; i < 4; i++) {
		var arr = [days, hours, minutes, seconds];
		$("div.count-down art:eq("+i+")").text(arr[i]);
	}
}

screenSize();
var setTime = setInterval(countDown, 1000);

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
		$("title").text("#BeyondIfe@BeyondIfe");
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

	$(".story-pane").click(function(){
		if($(this).is(".click")){
			scroll = $(".block").has(this).scrollTop();
			var item;
			var dataPane = $(this).attr("data-pane");
			var elder = $("div.block-backdrop-1").has(this);
			elder.find("div.story-board div.story-pane[data-pane!='"+dataPane+"']").addClass("no-display");
			elder.find("div.story-board").removeClass("no-display plain-article").addClass("animate-article");
			elder.find("div.story-board").removeClass("grey-background");
			elder.find("h1.stories").addClass("no-display");
			$(".block").animate({scrollTop : 0}, 1500);
			$(this).removeClass("click");
			if($(this).is(".video")){
				$(this).addClass("now");
				var setDelay = setTimeout(function(){				
					$(".now").find(".img-lg, .img-sm").addClass("dim-opacity");
					item = $(".now").find("item").html();
				},1000);
				var setDelay = setTimeout(function(){
					$(".now").find(".img-lg, .img-sm").addClass("no-display").removeClass("dim-opacity");
					$(".now").find("div.play").html(item).removeClass("no-display");
					$(".now").removeClass("now");					
				},1500);
			}
		}
	})

	$("a.stories").click(function(e){
		e.preventDefault();
		$("h1.stories").removeClass("no-display");

		var setTimea = setTimeout(function(){
			$("div.story-pane").removeClass("no-display");
			$("div.story-board").addClass("plain-article").removeClass("no-display animate-article");
			$("div.block-backdrop-1").has(this).addClass("grey-background");
			$(".block").animate({scrollTop : scroll}, 1500);
		}, 300);

		var setTime = setTimeout(function(){			
			$("div.story-pane").addClass("click");
		}, 500);

		var setTimeo = setTimeout(function(){
			$("video").remove();
			$("div.story-card").find("div.play").addClass("no-display");
			$("div.story-card").find(".img-lg, .img-sm").removeClass("no-display dim-opacity");				
			$("h1 span.play").html("<i class='fa fa-youtube-play'></i>Play Video....");
			cd = 0;
			xy = 0;
		}, 1000);
	})

	$("span.play").click(function(){
		var elder = $("div.story-card").has(this);
		if(cd == 0){
			elder.find("ul").addClass("open-list");
			var setTime = setTimeout(function(){
				cd = 1;
			}, 550);
		}
		else if(cd == 1){
			elder.find("ul").removeClass("open-list");
			var setTime = setTimeout(function(){
				cd = 0;
			}, 550);
		}
		else if(cd == 2){
			elder.find("div.play").addClass("dim-opacity");
			var setTime = setTimeout(function(){
				elder.find("div.play").addClass("no-display");
				elder.find(".img-lg, .img-sm").removeClass("no-display dim-opacity");				
				$("h1 span.play").html("<i class='fa fa-youtube-play'></i>Watch Talk....");
				cd = 0;
			}, 550);
		}
	})

	$("h1.card-stories ul li").click(function(){
		var elder = $("div.story-card").has(this);
		var link = $(this).attr("data-link");
		elder.find("div.play").html(link);
		if(cd == 1){
			$(".block").animate({scrollTop : 0}, 500);
			elder.find(".img-lg, .img-sm").addClass("dim-opacity");
			var setTime = setTimeout(function(){
				elder.find("ul").removeClass("open-list");
				elder.find(".img-lg, .img-sm").addClass("no-display");
				elder.find("div.play").removeClass("no-display dim-opacity");
				$("h1 span.play, h5 span.play").html("<i class='fa fa-image'></i>Show Image....");
				cd = 2;
			}, 550);
		}
	})

	$("form[role='contact-form']").submit(function(e){
		const mail = new FormData(this);
		e.preventDefault(),
		$.ajax({
			url: "controlla/mail.php", method: "POST", 
			data: mail, contentType : false, processData : false, cache: false,
			dataType: "json", context: $("div.ajax-result"),
			success: function(success){
				$(this).find("span").text(success);
				$(this).removeClass("no-display"),
				$(this).siblings("form").addClass("no-display")
			}
		});
	})

	$("form[role='nomination-form']").submit(function(e){
		const mail = new FormData(this);
		e.preventDefault(),
		$.ajax({
			url: "controlla/mail.php", method: "POST", 
			data: mail, contentType : false, processData : false, cache: false,
			dataType: "json", context: $("div.nomination-result"),
			success: function(success){
				$(this).find("span").text(success);
				$(this).removeClass("no-display"),
				$(this).siblings("form").addClass("no-display"),
				$("form[role='nomination-form']").remove();
				$("li").has("a[data-nav='nav-nom']").remove();
			}
		});
	})
})