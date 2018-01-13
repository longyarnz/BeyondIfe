var collect = new FormData(this);
var type = "access";
collect.append("type", type);
if ($(":file")[0]) {
	var intel = $(":file")[0].files; 
	collect.append("intel", intel);
}

$.ajax({ 
	url: "controlla/index_db.php", method: "POST", 
	data: collect, contentType : false, processData : false, cache: false,
	dataType: "html", context: $("div.ajax-result"),
	beforeSend: function(){

	},
	success: function(success){

	}
});