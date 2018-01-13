<!-- <div class="block-content no-display" data-id="a1" data-nav="nav-about">
	<div class="block block-backdrop-1">
		<h1>Table Name</h1>
		<form role="data-form" method="post" enctype="multipart/form-data" autocomplete="off">
			<div><a class="btn retrieve">Retrieve From Database</a></div>
			<div data-input="1" data-div="3">
				<label>Name</label>
				<input type="text" placeholder="Enter Your Name" name="input 1" required data-input="1">
			</div>	
			<div data-input="2">
				<label>Email</label>
				<input type="email" name="input 2" placeholder="Enter Your Email" required data-input="2">
			</div>
			<div data-input="3">
				<label>Message</label>
				<textarea rows="5" name="input 3" placeholder="Kindly Express Yourself" required data-input="3"></textarea>
			</div>
			<div>
				<button type="submit" role="submit">Submit</button>
				<button role="plus"><i class="fa fa-plus"></i></button>
				<button role="minus"><i class="fa fa-minus"></i></button>
			</div>
			<div class="ajax-background"><div class="ajax-progress">0%</div></div>
		</form>
	</div>
</div> -->

<!-- <div class="block-content no-display" data-id="a2" data-nav="nav-social">
	<div class="block block-backdrop-1">
		<h1>BeyondIfe8</h1>

	</div>
</div>

<div class="block-content no-display" data-id="a3" data-nav="nav-handle">
	<div class="block block-backdrop-1">
		<a class="twitter-timeline" data-link-color="#f00" href="https://twitter.com/BeyondIfe">Tweets by BeyondIfe</a> 
	</div>
</div>

<div class="block-content no-display" data-id="a4" data-nav="nav-article">
	<div class="block block-backdrop-1 grey-background">
		<h1>WE TELL THE BEST STORIES</h1>
	
	</div>
</div>

<div class="block-content no-display" data-id="a5" data-nav="nav-profile">
	<div class="block block-backdrop-1 grey-background">
		<h1>#BeyondIfe_Speakers</h1>
	
	</div>
</div>

<div class="block-content no-display" data-id="a6" data-nav="nav-team">
	<div class="block block-backdrop-1 grey-background">
		<h1>#BeyondIfe_8</h1>
	
	</div>
</div>

<div class="block-content no-display" data-id="a7" data-nav="nav-video">
	<div class="block block-backdrop-1 grey-background">
		<h1>#BeyondIfe_Videos</h1>
	
	</div>
</div>

<div class="block-content no-display" data-id="a8" data-nav="nav-faqs">
	<div class="block block-backdrop-1">
		<h1>FAQs</h1>
	
	</div>
</div>

<div class="block-content no-display" data-id="a9" data-nav="nav-contact">
	<div class="block block-backdrop-1 grey-background">
		<h1>Contact Us</h1>
	
	</div>
</div> 

var k = -1;
var m = 1;
var lum = cols[tabs[i]];
for (var x in lum){
	var div = $("div[data-input='"+m+"']");
	var label = $("label");
	var ext = x.lastIndexOf("_");
	var slice;
	label.text(x);

	if (lum["data_type"][x] = "text" || lum["data_type"][x] = "varchar") {
		var input = $("input[type='text']");
	}
	else if (lum["data_type"][x] = "int"){
		var input = $("input[type='number']");
	}
	if (ext != -1) {
		slice = x.slice(ext);
		if (slice == "_file") {
			var input = $("input[type='file']");
		}
		else if (slice == "_area") {
			var input = $("textarea");
			input.attr("rows", 5);
		}
	}

	input.attr("name", "input "+m).attr("placeholder", "Enter "+x).attr("data-input", m).attr("required", "");
	div.append(label).append.(input);
	form.append(div);

	$("a.retrieve").click(function(e){
		e.preventDefault();
		var parent = $("form").has(this);
		var w = parent.find("div.ajax-progress").width();
		var x = parent.find("div.ajax-background").width();
		w += 30; 
		var y = w / x *100;
		y = y - y % 1;
		if(y < 100 || y == 100){
			parent.find("div.ajax-progress").width(w).text("Sending Data... "+y+"%");
		}
		else if(y > 100){
			parent.find("div.ajax-progress").width(x).text("Data Sent... 100%");
		}
	})


	function reStructure(options, location, data){
	location.html(options);
//	$("form[role='access-form']").trigger("submit");
	// if (options == "Operation Successful") {
	// 	var update = server;
	// 	location.text(getProps(sync));
	// 	for (var x in update[sync["table"]]) {
	// 		var len = (sync["data"].length) / sync["length"];
	// 		var long = sync["columns"].length;
	// 		for (var i = 0; i < long; i++) {
	// 			if (x == sync["columns"][i]) {
	// 				for (var j = 0; j < len; j++) {
	// 					update[sync["table"]][x][] = sync["length"] * j + i;
	// 				}
	// 			}
	// 		}
	// 	}
	// }


	if (options == "Operation Successful") {
		var update = server;
	//	location.text(getProps(sync));
		for (var x in update[sync["table"]]) {
			var len = (sync["data"].length) / sync["length"];
			var long = sync["columns"].length;
			for (var i = 0; i < long; i++) {
				if (x == sync["columns"][i]) {
					for (var j = 0; j < len; j++) {
						update[sync["table"]][x][update[sync["table"]][x].length + 1 + j] = sync["length"] * j + i;
					}
				}
			}
		}
	}
}