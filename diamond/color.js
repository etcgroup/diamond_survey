$(document).ready(function() {

	$(".triangle").each(function(){
	console.log($(this).attr("class"));
		var obj = $(this);
			var which = "top";
			if(obj.hasClass("triangle-bottomleft") || obj.hasClass("triangle-bottomright")){
				which = "bottom";
			}
			var num = Number(obj.text());
			var scale = [
				[255,255,255],
				[237,248,251],
				[191,211,230],
				[158,188,218],
				[140,150,198],
				[136,86,167]];
			num = Math.floor(num/10);
			num = num > 5 ? 5 : num;
			obj.text("").css("border-"+which+"-color","rgb("+scale[num][0]+","+scale[num][1]+","+scale[num][2]+")");
	});
});