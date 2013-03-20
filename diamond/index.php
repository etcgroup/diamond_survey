<!DOCTYPE html>
<html>
<head>
	<title>A Title </title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="color.js"></script>
	<script>
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
			out.push('<div class="'+which+' '+triangle_info[which][0]+'">'+value+'</div>');
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
			$.each(data.codes, function(code, diamond_data){
				var toprow_elements
				var toprow = []; 
				$.each(window.top_triangles, function(key, which){
					toprow.push(get_triangle(which, diamond_data[which]));
				});
				var bottomrow = [];
				$.each(window.bottom_triangles, function(key, which){
					bottomrow.push(get_triangle(which, diamond_data[which]));
				});
				widgets.push('<div class="widget"><div class="label">' + code + '</div><div class="diamond"><div class="toprow">' + toprow + '</div><div class="bottomrow">' + bottomrow + '</div></div></div>');
            });
			('#canvas').html(widgets.join('\n'));
		});
	</script>
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
	<div>
		<h1>Heading1</h1>
		<p>paragraph.</p>
		
		<h1>Heading2</h1>
		<p>paragraph.</p>
		
		<h1>Heading3</h1>
		<p>paragraph.</p>
	</div>
	<div id="legend">
		<img src="legend.jpg" alt="legend" width="60%" height="60%">
	</div>
	<div id="toprow">
		<div class="FTT triangle-topleft">15</div>
		<div class="FTTtext">15</div>
		<div class="squaresbackground FTTbackground"></div>
		<div class="FTTsquares">
			<div class="historic squareblack"></div>
			<div class="current squarewhite"></div>
			<div class="auto squarewhite"></div>
		</div>

		<div class="TTT triangle-bottomright">10</div>
		<div class="TTTtext">10</div>
		<div class="squaresbackground TTTbackground"></div>
		<div class="TTTsquares">
			<div class="historic squarewhite"></div>
			<div class="current squarewhite"></div>
			<div class="auto squarewhite"></div>
		</div>
		
		<div class="TFT triangle-bottomleft">13</div>
		<div class="TFTtext">13</div>
		<div class="squaresbackground TFTbackground"></div>
		<div class="TFTsquares">
			<div class="historic squarewhite"></div>
			<div class="current squareblack"></div>
			<div class="auto squarewhite"></div>
		</div>
		
		<div class="TTF triangle-topright">26</div>
		<div class="TTFtext">26</div>
		<div class="squaresbackground TTFbackground"></div>
		<div class="TTFsquares">
			<div class="historic squarewhite"></div>
			<div class="current squarewhite"></div>
			<div class="auto squareblack"></div>
		</div>
		
	</div>
	<div id="bottomrow">
		<div class="FFT triangle-bottomleft">3</div>
		<div class="FFTtext">3</div>
		<div class="squaresbackground FFTbackground"></div>
		<div class="FFTsquares">		
			<div class="historic squareblack"></div>
			<div class="current squareblack"></div>
			<div class="auto squarewhite"></div>
		</div>
				
		<div class="FTF triangle-topright">5</div>
		<div class="FTFtext">5</div>
		<div class="squaresbackground FTFbackground"></div>
		<div class="FTFsquares">		
			<div class="historic squareblack"></div>
			<div class="current squarewhite"></div>
			<div class="auto squareblack"></div>
		</div>
		
		<div class="FFF triangle-topleft">27</div>
		<div class="FFFtext">27</div>
		<div class="squaresbackground FFFbackground"></div>
		<div class="FFFsquares">		
			<div class="historic squareblack"></div>
			<div class="current squareblack"></div>
			<div class="auto squareblack"></div>
		</div>
		
		<div class="TFF triangle-bottomright">1</div>
		<div class="TFFtext">1</div>
		<div class="squaresbackground TFFbackground"></div>
		<div class="TFFsquares">		
			<div class="historic squarewhite"></div>
			<div class="current squareblack"></div>
			<div class="auto squareblack"></div>
		</div>
		
	</div>

</body>
</html>