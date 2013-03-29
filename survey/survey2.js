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

window.loaded_canvases = 0;

function get_triangle(which, value){
	var out = [];
	var tooltip_vals = [];
	var data_type = ["Historic", "Automatic", "Current"];
	for (var i = 0, len = which.length; i < len; i++) {
		if (which[i] === 'T') {
			tooltip_vals.push("True in " + data_type[i]);
		} 
		else {
			tooltip_vals.push("False in " + data_type[i]);
		}
	}
	tooltip_vals = tooltip_vals.join('\n');
	out.push('<div class="'+which+' '+triangle_info[which][0]+' triangle">'+value+'</div>');
	out.push('<div class="'+which+'text forward"><p class="num">'+value+'</p></div>');
	return out.join('\n');
}

function render_canvas(data) {
	var widgets = [];
	window.loaded_canvases++;
	
	$.each(data, function(code, diamond_data){
		info = diamond_data.type+' '+diamond_data.hill;
		diamond_data = diamond_data.data;
		var toprow = []; 
		$.each(window.top_triangles, function(key, which){
			toprow.push(get_triangle(which, diamond_data[which]==undefined?0:diamond_data[which]));
		});
		var bottomrow = [];
		$.each(window.bottom_triangles, function(key, which){
			bottomrow.push(get_triangle(which, diamond_data[which]==undefined?0:diamond_data[which]));
		});
		widgets.push('<div class="widget inline hover-group"><div style="display:none" class="type">' + info + '</div><div class="diamond outline"><div class="toprow">' + toprow.join('') + '</div><div class="bottomrow">' + bottomrow.join('') + '</div></div></div>');
	});
	$('#canvas'+window.loaded_canvases).html(function(){
		question = '<div><span class=\"question\">Question ' + window.loaded_canvases + ':</span> Select (by clicking) the <u>the square that reflects the most problematic data</u>; see the examples in the introduction for help. <u>Justify your choice</u> in one or two sentences below:<br /><textarea name=\"open-ended-'+window.loaded_canvases+'-explanation\"></textarea><input type=hidden name=\"open-ended-'+window.loaded_canvases+'-selection\" id=\"open-ended-'+window.loaded_canvases+'-selection\" /><input type=hidden name=\"open-ended-'+window.loaded_canvases+'-data\" id=\"open-ended-'+window.loaded_canvases+'-data\" /></div>';
		return question + widgets.join('\n');
	});

	$('#open-ended-'+window.loaded_canvases+'-data').val(JSON.stringify(data));
	activate_canvases();
}

function activate_canvases(){
	if(window.loaded_canvases < window.goal_canvases){
		return;
	}
	
	$('.canvas .triangle').each(function(){
		var obj = $(this);
		var which = "top";
		if(obj.hasClass("triangle-bottomleft") || obj.hasClass("triangle-bottomright")){
			which = "bottom";
		}
		var num = Number(obj.text());
		var scale = [
				[208,209,230],
				[166,189,219],
				[103,169,207],
				[54,144,192],
				[2,129,138],
				[1,100,80]];
		num = Math.floor(num/10);
		num = num > 5 ? 5 : num;
		obj.text("").css("border-"+which+"-color","rgb("+scale[num][0]+","+scale[num][1]+","+scale[num][2]+")");
	});
	
	$('.canvas .triangle').on('click', function(){
		$(".outline-active").removeClass("outline-active");
		$(this).parent().parent().addClass("outline-active");
		canvas_num = $(this).parent().parent().parent().parent().attr('id').substring(6);
		$("#open-ended-"+canvas_num+"-selection").val($('.type', $(this).parent().parent().parent()).text());
	});
	
	$('.canvas .num').on('click', function(){
		$(".outline-active").removeClass("outline-active");
		$(this).parent().parent().parent().addClass("outline-active");
		canvas_num = $(this).parent().parent().parent().parent().parent().attr('id').substring(6);
		$("#open-ended-"+canvas_num+"-selection").val($('.type', $(this).parent().parent().parent().parent()).text());
	});
}

$(document).ready(function(){
	window.goal_canvases = 3;
	canvases = [];
	for(var i=1; i<=window.goal_canvases; i++){
		canvases.push('<div id="canvas' + i + '" class="canvas box deselect_text"></div>');
	}
	$('#canvases').html(canvases.join('\n'));
	for(var i=1; i<=window.goal_canvases; i++){
		$.getJSON('survey2_data.php', render_canvas);
	}
});