window.triangle_info = [];
window.triangle_info["FTT"] = ["triangle-topleft", {"historic": "black", "current": "white", "auto": "white"}];
window.triangle_info["TTT"] = ["triangle-bottomright", {"historic": "white", "current": "white", "auto": "white"}];
window.triangle_info["TFT"] = ["triangle-bottomleft", {"historic": "white", "current": "black", "auto": "white"}];
window.triangle_info["TTF"] = ["triangle-topright", {"historic": "white", "current": "white", "auto": "black"}];
window.triangle_info["FFT"] = ["triangle-bottomleft", {"historic": "black", "current": "white", "auto": "white"}];
window.triangle_info["FTF"] = ["triangle-topright", {"historic": "black", "current": "white", "auto": "white"}];
window.triangle_info["FFF"] = ["triangle-topleft", {"historic": "black", "current": "white", "auto": "white"}];
window.triangle_info["TFF"] = ["triangle-bottomright", {"historic": "black", "current": "white", "auto": "white"}];
window.top_triangles = ["FTT", "TTT", "TFT", "TTF"];
window.bottom_triangles = ["FFT", "FTF", "FFF", "TFF"];

function get_triangle(which, value){
	var out = [];
	out.push('<div class="'+which+' '+triangle_info[which][0]+' triangle">' + value+'</div>');
	out.push('<div class="'+which+'text">'+value+'</div>');
	out.push('<div class="squaresbackground" id="'+which+'background"></div>');
	out.push('<div class="'+which+'squares">');
	$.each(triangle_info[which][1], function(datasource, color){
		out.push('<div class="' + datasource + ' square' + color + '"></div>');
	});
	out.push('</div>');
	return out.join('\n');
}

$.getJSON('data.php', function(data) {
	var widgets = [];
	$.each(data, function(code, diamond_data){
		var toprow = []; 
		$.each(window.top_triangles, function(key, which){
			toprow.push(get_triangle(which, diamond_data[which]==undefined?0:diamond_data[which]));
		});
		var bottomrow = [];
		$.each(window.bottom_triangles, function(key, which){
			bottomrow.push(get_triangle(which, diamond_data[which]==undefined?0:diamond_data[which]));
		});
		widgets.push('<div class="widget inline"><div class="label">' + code + '</div><div class="diamond"><div class="toprow">' + toprow.join('') + '</div><div class="bottomrow">' + bottomrow.join('') + '</div></div></div>');
	});
	$('#canvas').html(widgets.join('\n'));
	
	$(".triangle").each(function(){
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