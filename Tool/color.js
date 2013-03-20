$(document).ready(function() {
	var values = ["FTT","TTT","TFT","TTF","FFT","FTF","FFF","TFF"];
	values.forEach(
		function(element, index, array){
			var obj = $("#"+element);
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

		}
	);
	
	
	/* <div class="confdiamond">1 2 3 4 5 6 7 8</div>
	$(".confdiamond").html(function(blah){
		values = explode by space $(this).text();
		set text to nothing
		fill in with triangles
	});
	*/
	
	/* $(".TTT").text("").css("border-color","rgb("+value+",255,255)");*/

});