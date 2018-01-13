function reStructure(options, location){
//	location.html(options[1]);
	if (options[0] == "Operation Successful") {
		var fileArr = [];
		for (var x in server[sync["table"]]) {
			var len = (sync["data"].length) / sync["length"];
			var long = sync["columns"].length;
			for (var i = 0; i < long; i++) {
				if (x == sync["columns"][i]) {					
					var y = x.lastIndexOf("_");
					var z = x.slice(y);
					if (z != "_file") {
						for (var j = 0; j < len; j++) {
							server[sync["table"]][x].push(sync["data"][i + j]);
						}
					}
					else {
						var filen = (options.length - 1) / sync["filen"];
						if (fileArr.indexOf(x) == -1) {
							fileArr.push(x);
							k = fileArr.indexOf(x) + 1;
							for (var j = 0; j < filen; j++) {
								server[sync["table"]][x].push(options[k + (j * sync["filen"])]);
							}
						}
					}
				}
			}
		}
		setTimeout(function(){
	        $("input, textarea").val("").attr("data-file", "");
			$("textarea").text("");
		}, 500);
	}
	else if (options[0] == "Mission Accomplished") {
		if (options[1]) {
			sync["data"] = options[1];
		}
		location.siblings("form").find("input[data-input='"+sync["input"]+"'], textarea[data-input='"+sync["input"]+"']").attr("data-file", sync["data"]);
		location.siblings("form").find("div[data-input='"+sync["input"]+"'] [type='file']").siblings("span").text(sync["data"]);
		location.siblings("form").find("textarea[data-input='"+sync["input"]+"']").text(sync["data"]);
		var ab = sync["input"] - 1;
		var bc = ab / sync["length"];
		var cd = bc % 1;
		bc = bc - cd; 
		server[sync["table"]][sync["column"]][bc] = sync["data"];
		$("form[role='wrap']").remove();
		setTimeout(function(){
			$(".green").removeClass("green");
		}, 2000);
	}
	else if (options[0] == "Mission Lost") {
		var greenText = $(".green").text();
		$(".green").text("Empty");
		setTimeout(function(){
			$(".green").removeClass("green").text(greenText);
		}, 2000);
	}
	else if (options[0] == "Aim Achieved"){
		var ab = sync["input"] - 1;
		var bc = ab / sync["length"];
		var cd = bc % 1;
		bc = bc - cd; 
		for (var x in server[sync["table"]]) {
			if (x != "data_type") {
				server[sync["table"]][x].splice(bc, 1);
				if (server[sync["table"]][x] == "") {
					location.siblings("form").find("a.retrieve").text("Send To Database");
					location.siblings("form").find("a.retrieve").trigger("click");
				}
			}
		}
		location.siblings("form").find("a.retrieve").text("Retrieve From Database");
		location.siblings("form").find("a.retrieve").trigger("click");
	}	
}

function parseObject(options){
	var tabs = getProps(options);
	var cols = options;
	server = options;

	for (var i = 0;i < tabs.length; i++) {
		var j = i + 1;
		var app = $("nav ul li:first").clone(true);
		app.find("a").attr({"data-nav" : "nav-"+tabs[i]}).html("<span>*</span>"+tabs[i]);
		$("nav ul li:last").before(app);

		var block = $("div.block-content:first").clone();
		block.removeClass("poster").addClass("no-display");
		block.attr({"data-id": "a" + j}).attr({"data-nav" : "nav-" + tabs[i]});
		block.find("div.block div").not(".ajax-result").remove();
		block.find("h1").text(tabs[i]);
		form = block.find("form");
		form.find("[data-input], div:has(button)").remove();
		form.attr("role", "data-form").removeClass("dim-opacity");
		form.prepend("<div><a class='btn retrieve'>Retrieve From Database</a></div>");

		var m = 1;
		var lum = cols[tabs[i]];
		var dataDiv = getProps(lum).length - 1;

		for (var x in lum){
			if (x != "data_type") {
				var div = $("<div></div>").attr("data-input", m).attr("data-div", dataDiv);
				var label = $("<label></label>").text(x);
				var delLabel = $("<label class='no-display' data-function='delete'>Delete</label>");
				var span = $("<span class='no-display'></span>");
				var upLabel = $("<label class='no-display' data-function='update'>Update</label>");
				var input = $("<input required />");
				var ext = x.lastIndexOf("_");
				var slice;

				if (lum["data_type"][x] == "text" || lum["data_type"][x] == "varchar") {
					input.attr("type", "text");
				}
				else if (lum["data_type"][x] == "int"){
					input.attr("type", "number");
				}
				else if (lum["data_type"][x] == "longtext"){
					input = $("<textarea required rows='5'></textarea>");
				}
				if (ext != -1) {
					slice = x.slice(ext);
					if (slice == "_file") {
						input.attr("type", "file").attr("data-file", "");
					}
					else if(x == "_email"){
						input.attr("type", "email");
					}
					else if(slice == "_pass"){
						input.attr("type", "password");
					}
					else if (slice == "_area") {
						input = $("<textarea required rows='5'></textarea>");
					}
				}

				input.attr("name", "input "+m).attr("placeholder", "Enter "+x).attr("data-input", m);
				div.append(label).append(upLabel).append(delLabel).append(span).append(input);
				form.append(div);
				m++;
			}
		}

		form.append('<div><button type="submit" role="submit">Submit</button><button role="plus">'+
			'<i class="fa fa-plus"></i></button><button role="minus"><i class="fa fa-minus"></i></button></div>');
		$("div.block-content:last").after(block);
		form.append('<div class="ajax-background"><span></span><div class="ajax-progress"></div></div>');
	}

	$("button[role='plus']").click(function(e){
		e.preventDefault();
		var hr = "<hr>";
		var parent = $("form").has(this);
		var counter = parseInt(parent.find("[data-input]:last").attr("data-input"));
		var data = parseInt(parent.find("[data-input]:last").attr("data-input"));
		var div = parseInt(parent.find("div[data-div]").attr("data-div"));
		var num = (data / div) + 1;
		parent.find("div[data-input]:last").after(hr);

		for(var i=div;i>=1; i--){
			var count = counter + i;
			var html = parent.find("div[data-input='"+i+"']").clone();
			html.attr("data-input", count);
			html.find("[data-input]").attr("data-input", count);
			html.find("[data-input]").attr("name", "input "+ count);
			html.find("label").append(" "+num);
			html.find("input").val("");
			html.find("textarea").text("");
			parent.find("hr:last").after(html);
		}
	})

	$("button[role='minus']").click(function(e){
		e.preventDefault();
		var parent = $("form").has(this);
		var data = parseInt(parent.find("div[data-input]:last").attr("data-input"));
		var div = parseInt(parent.find("div[data-div]").attr("data-div"));
		var num = data - div - 1;
		if(num > 0){
			parent.find("div[data-input]:gt("+num+"), hr:last").remove();
		}
		else{}
	})

	$("a.retrieve").click(function(e){
		e.preventDefault();
		var parent = $("div.block").has(this);
		var form = parent.find("form").has(this);
		var tab = parent.find("h1:first").text();
		var col = getProps(server[tab]["data_type"]);
		var len = server[tab][col[0]].length;
		var dataDivo = parseInt(form.find("div[data-div]").attr("data-div")) - 1;
		form.find("hr, div[data-input]:gt("+dataDivo+")").remove();

		var bag = parseInt(parent.find("div[data-input]:last").attr("data-input"));
		for (var i = 1; i < bag; i++) {
			form.find("button[role='minus']").trigger("click");
		}
		var buttonText = $(this).text();
		if (buttonText == "Retrieve From Database" && len > 0) {
			for (var i = 0; i < len; i++) {
				if (i > 0){
					form.find("button[role='plus']").trigger("click");
				}
				for (var x in server[tab]) {
					if (x != "data_type") {					
						var j = ((dataDivo + 1) * i);
						if (i == 0 && x == col[0]) {
							var label = form.find("div[data-input]:eq("+i+")");	
						}
						else{
							var label = form.find("div[data-input]:eq("+j+"), div[data-input]:gt("+j+")");
						}
						label.find("label").each(function(index){
							var chart = $(this).text();
							var n = ufirst(x, "up");
							if(chart.startsWith(n)){
								form.find("[data-function], span").removeClass("no-display");
								$(this).siblings("input, textarea").not("input[type='file']").val(server[tab][x][i]).attr("data-file", server[tab][x][i]);
								$(this).siblings("textarea").text(server[tab][x][i]).attr("data-file", server[tab][x][i]);
								$(this).siblings("input[type='file']").attr("data-file", server[tab][x][i]).siblings("span").text(server[tab][x][i]);
								form.find("button").addClass("no-display");
							}
							else if($(this).text() == "Delete") {
								var a = parseInt($(this).parent().attr("data-input"));
								var b = parseInt($(this).parent().attr("data-div"));
								if(a % b != 1 && b != 1){
									$(this).remove();
								}
							}
						});
					}
				}
			}
			$(this).text("Send To Database");
			form.find(".ajax-background").addClass("no-display");
		}
		else if(buttonText == "Send To Database"){
			$(this).text("Retrieve From Database");
			$("input, textarea").val("").attr("data-file", "");
			$("textarea").text("");
			form.find("[data-function], span").addClass("no-display");
			form.find("button, .ajax-background, .ajax-background span").removeClass("no-display");
		}

		$("label[data-function]").click(function(e){
			e.preventDefault();
			var button = $(this).attr("data-function");			
			var inputs = [];
			$(this).addClass("green");
			var parent = $("div.block").has(this);
			var form = parent.find("form").has(this);
			var tab = parent.find("h1:first").text();
			var columnName = ufirst($(this).siblings("label:first").text(), "low");
			var ext = parseInt(columnName.lastIndexOf(" "));
			if (ext > -1) { columnName = columnName.slice(0, ext); }
			var dataFile = $(this).siblings("input, textarea").attr("data-file");
			var dataDiv = parseInt(form.find("div[data-div]").attr("data-div"));
			var dataInput = parseInt($(this).siblings("input, textarea").attr("data-input"));
			var a = dataInput % dataDiv;
			if (a == 0) {
				a = dataDiv;
			}
			var b = dataInput - a + 1;
			var c = dataInput + dataDiv - a;
			if (dataDiv == 1) {
				b = dataInput;
				c = b;
			}

			if (button == "update") {
				var type = "update";
				for (var i = b; i <= c; i++) {
					if (i != dataInput || dataDiv == 1) {
						var title = form.find("input[data-input='"+i+"'], textarea[data-input='"+i+"']").siblings("label:first").text();
						var dataFill = form.find("input[data-input='"+i+"'], textarea[data-input='"+i+"']").attr("data-file");
						var ext = parseInt(title.lastIndexOf(" "));
						if (ext > -1) { title = title.slice(0, ext); }
						inputs.push(ufirst(title, "low"));
						inputs.push(dataFill);
					}
				}
				if ($(this).siblings("[type='file']")[0]) {
					var wrapForm = $("<form role='wrap'></form>");
					var cloneFile = $(this).siblings("[type='file']").clone();
					wrapForm.append(cloneFile);
					form.after(wrapForm);
					$("[role='wrap']").submit(function(e){
						e.preventDefault();
						updateObject = new FormData(this);
						type = "update";
						var changedValue = "";
						sync["data"] = "";
						updateObject.append("type", type);
						var intel = $("[type='file']")[0].files;
						updateObject.append("intel", intel);
						updateObject.append("changedValue", changedValue);
					});
					$("[role='wrap']").trigger("submit");
				}
				else{
					var changedValue = $(this).siblings("input, textarea").val();
					updateObject = new FormData();
					updateObject.append("changedValue", changedValue);
					sync["data"] = changedValue;
				}
			}
			else if (button == "delete") {
				updateObject = new FormData();
				type = "delete";
				for (var i = b; i <= c; i++) {
					var title = form.find("input[data-input='"+i+"'], textarea[data-input='"+i+"']").siblings("label:first").text();
					var dataFill = form.find("input[data-input='"+i+"'], textarea[data-input='"+i+"']").attr("data-file");
					var ext = parseInt(title.lastIndexOf(" "));
					if (ext > -1) { title = title.slice(0, ext); }
					inputs.push(ufirst(title, "low"));
					inputs.push(dataFill);
				}
			}

			sync["table"] = tab;
			sync["column"] = ufirst(columnName, "up");
			sync["length"] = dataDiv;
			sync["prevFile"] = dataFile;
			sync["input"] = dataInput;
			
			updateObject.append("type", type);
			updateObject.append("tab", tab);
			updateObject.append("columnName", columnName);
			updateObject.append("inputs", JSON.stringify(inputs));

			$.ajax({
				xhr: function(){
				var xhr = new XMLHttpRequest()  || new ActiveXObject("Microsoft.XMLHTTP");
				xhr.upload.addEventListener("progress", function(e){
					if(e.lengthComputable){
						var width = e.loaded / e.total * 100;
						width -= width % 1;
						$("div.update-bar").css("width", width+"%");
					}
				});
				return xhr;
			}, 
				url: "controlla/index_db.php", method: "POST", 
				data: updateObject, contentType : false, processData : false, cache: false,
				dataType: "json", context: $("div.ajax-result"),
				success: function(success){
					reStructure(success, $(this));
					$("div.update-bar").addClass("green");
					setTimeout(function(){
						$("div.update-bar").css("width", "0%").removeClass("green");
					}, 2000);						
				}
			});			
		})
	})

	$("form[role='data-form']").submit(function(e){
		e.preventDefault();
		var collect = new FormData(this);
		var dataInput = $(this).find("[data-input]:last").attr("data-input");
		var dataDiv = parseInt($(this).find("[data-div]").attr("data-div"));
		var tab = $(this).siblings("h1").text();
		var cols = getProps(server[tab]);
		cols.pop();
		sync["table"] = tab;
		sync["columns"] = [];
		sync["length"] = dataDiv;
		sync["data"] = [];
		for (var i = 0; i < cols.length; i++){
			sync["columns"][i] = ufirst(cols[i], "up");
		}
		for (var i = 1; i <= dataInput; i++) {
			sync["data"][i - 1] = collect.get("input "+i);
		}
		for (var i = 0; i < cols.length; i++){
			cols[i] = cols[i].toLowerCase();
		}
		type = "insert";
		var length = $(this).find("div[data-input]:last").attr("data-input");
		collect.append("type", type);
		collect.append("tab", tab);
		collect.append("cols", cols);
		if ($(this).has("input[type='file']")) {
			var intel = $("input[type='file']")[0].files;
			collect.append("intel", intel);
		}
		$.ajax({
			xhr: function(){
				var xhr = new XMLHttpRequest()  || new ActiveXObject("Microsoft.XMLHTTP");
				xhr.upload.addEventListener("progress", function(e){
					if(e.lengthComputable){
						var width = e.loaded / e.total * 100;
						width -= width % 1;
						$(".ajax-background span").text("Sending Data "+width+"%");
						if (width > 45) {
							$(".ajax-background span").addClass("white-color");
						}
					}
				});
				return xhr;
			}, 
			url: "controlla/index_db.php", method: "POST", 
			data: collect, contentType : false, processData : false, cache: false,
			dataType: "json", context: $("div.ajax-result"),
			success: function(success){
				reStructure(success, $(this));
				setTimeout(function(){
					$(".ajax-progress").css("width", 0+"%");
					$(".ajax-background span").removeClass("white-color").text("Request Completed");
				}, 1000);
				$("div.update-bar").addClass("green");
				setTimeout(function(){
					$("div.update-bar").css("width", "0%");
				}, 2000);
			}
		});		
	});
}

function response(options, location){
	var check = JSON.stringify(options);
	if (check.search("Invalid") != -1) {
		location.text("Invalid Access Codes");
	}
	else{
		location.text("DB Connected");
		$("header").removeClass("no-display");
		$("form[role='access-form']").addClass("dim-opacity");
		setTimeout(function(){
			$("form[role='access-form']").addClass("no-display");
			$("div.notification").removeClass("no-display");
		}, 300);
		setTimeout(function(){
			$("div.notification").removeClass("dim-opacity");
		}, 350);
		parseObject(options);
	}
}

function ufirst(word, letterCase){
	word.split("");
	if (letterCase == "up") {
		var cap = word[0].toUpperCase();
	}
	else{
		var cap = word[0].toLowerCase();
	}
	for (var i = 1; i < word.length; i++) {
		cap += word[i];
	}
	return cap;
}

function delButton(object){
	var check;
	var dataDivo;
	var dataInput;
	var form = $("form[data-form").has(object);
	form.find("div[data-input]").each(function(){
		dataDivo = parseInt(form.find("[data-div]").attr("data-div"));
		dataInput = parseInt(form.find("div[data-input]").attr("data-input"));
		check = dataInput % dataDivo;
		if (check != 1) {
			$(this).find("label[data-function='delete']").remove();
		}
	})
	
}

function desponse(options, location){
	$(".block-content:not(:first)").remove();
	$(".block-content.poster").removeClass("no-display");
	location.text(options);
	$("div.notification").addClass("dim-opacity");
	setTimeout(function(){
		$("form[role='access-form']").removeClass("no-display");
		$("div.notification").addClass("no-display");
	}, 300);
	setTimeout(function(){
		$("header").addClass("no-display");
		$("form[role='access-form']").removeClass("dim-opacity").find("[role='host']").val(window.location.hostname);
	}, 350);
	$("nav ul li").not("nav ul li:first, nav ul li:last").remove();
}

function getProps(options){
	var y = [];
	var i = 0;
	for (var x in options) {
	   y[i] = x;
	   i++;
	}
	return y;
}

$(document).ready(function(){
	$("form[role='access-form']").submit(function(e){
		e.preventDefault();
		if (accessCount == 0){
			accessCount = 1;
			var collect = new FormData(this);
			type = "access";
			var length = $(this).find("div[data-input]:last").attr("data-input");
			collect.append("type", type);
			collect.append("length", length);
			if ($(":file")[0]) {
				var intel = $(":file")[0].files; 
				collect.append("intel", intel);
			}
			$.ajax({
				xhr: function(){
					var xhr = new XMLHttpRequest()  || new ActiveXObject("Microsoft.XMLHTTP");
					xhr.upload.addEventListener("progress", function(e){
						if(e.lengthComputable){
							var width = e.loaded / e.total * 100;
							width -= width % 1;
							$(".ajax-progress").css("width", width+"%").text("");
							$(".ajax-background span").text("Sending Data "+width+"%");
							if (width > 30) {
								$(".ajax-background span").addClass("white-color");
							}
						}
					});
					return xhr;
				}, 
				url: "controlla/index_db.php", method: "POST",
				data: collect, contentType : false, processData : false, cache: false,
				dataType: "json", context: $("div.ajax-result"),
				beforeSend: function(){
					$("h1:first").text("Connecting...");
				},
				success: function(success){
					response(success, $("h1:first"));
					$(".ajax-background span").text("Request Completed");
					
					setTimeout(function(){
						$(".ajax-progress").css("width", 0+"%");
						$(".ajax-background span").removeClass("white-color");
					}, 1000);
				}
			});
			
			setTimeout(function(){
				accessCount = 0
			}, 5000);
		}		
	});

	$("a[data-nav='logout']").click(function(e){
		e.preventDefault();
		server = null;
		$.ajax({
			url: "controlla/index_db.php", method: "POST", 
			data: {type : "recess"}, cache: false,
			success: function(success){
				desponse(success, $("h1:first"));
			}
		});
	})
})