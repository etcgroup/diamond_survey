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
        out.push('<div class="'+which+'text forward"><label title="'+value+' Messages rated:\n'+tooltip_vals+'"><p class="num">'+value+'</p></label></div>');
	//out.push('<div class="squaresbackground" id="'+which+'background"></div>');
	out.push('<div class="'+which+'squares">');
	//$.each(triangle_info[which][1], function(datasource, color){
	//	out.push('<div class="' + datasource + ' square' + color + '"></div>');
	//});
	out.push('</div>');
	return out.join('\n');
}

function render_canvas(data) {
	var widgets = [];
	var task = data.task;
	data = data.values;
        
	$.each(data, function(code, dict_data){

                
                i = 0;
                $.each(dict_data, function(data_type, diamond_data) {
                    if(i == 0) {
                        $Hill = dict_data["Hill"];
                        $Type = dict_data["Type"];
                        var toprow = []; 
                        $.each(window.top_triangles, function(key, which){
                                        toprow.push(get_triangle(which, diamond_data[which]==undefined?0:diamond_data[which]));
                        });
                        var bottomrow = [];
                        $.each(window.bottom_triangles, function(key, which){
                                        bottomrow.push(get_triangle(which, diamond_data[which]==undefined?0:diamond_data[which]));
                        });
                        //widgets.push('<div class="hill hide">' + $Hill + '</div><div class="type hide">' + $Type + '</div>');
                        widgets.push('<div class="widget inline hover-group"><div class="hill hide">' + $Hill + '</div><div class="type hide">' + $Type + '</div>' +
                        '<div class="label code hover-toggle"><p class="affect">' + code + '</p></div><div class="diamond outline"><div class="toprow">' + toprow.join('') + '</div><div class="bottomrow">' + bottomrow.join('') + '</div></div></div>');
                    }
                    i++;
                });
	});
	$('#canvas' + task).html(widgets.join('\n'));
        //$('#canvas' + task).html('<textarea name="' + task + '"></textarea>');

	$('#canvas' + task + ' .triangle').each(function(){
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
	$('#canvas' + task + ' .triangle').on('click', function(){
            $(".outline-active").removeClass("outline-active");
            $(this).parent().parent().addClass("outline-active");
            $('#answer').val($('.code', $(this).parent().parent().parent()).text());
            $('#hill').val($('.hill', $(this).parent().parent().parent()).text());
            $('#type').val($('.type', $(this).parent().parent().parent()).text());
        });
	$('#canvas' + task + ' .num').on('click', function(){
            $(".outline-active").removeClass("outline-active");
            $(this).parent().parent().parent().parent().addClass("outline-active");
            $('#answer').val($('.code', $(this).parent().parent().parent().parent().parent()).text());
            $('#hill').val($('.hill', $(this).parent().parent().parent().parent().parent()).text());
            $('#type').val($('.type', $(this).parent().parent().parent().parent().parent()).text());
        });
}


$.getJSON('data.php', {'task': 1}, render_canvas);
$.getJSON('data.php', {'task': 2}, render_canvas);
$.getJSON('data.php', {'task': 3}, render_canvas);
$.getJSON('data.php', {'task': 4}, render_canvas);
