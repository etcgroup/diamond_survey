<!DOCTYPE html>
<html>
<head>
	<title>A Title </title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="color.js"></script>
	<script>
		window.special_triangle_classes = [];
		window.special_triangle_classes["FTT"] = "triangle-topleft";
		window.special_triangle_classes["TTT"] = "triangle-bottomright";
		window.special_triangle_classes["TFT"] = "triangle-bottomleft";
		window.special_triangle_classes["TTF"] = "triangle-topright";
		window.special_triangle_classes["FFT"] = "triangle-bottomleft";
		window.special_triangle_classes["FTF"] = "triangle-topright";
		window.special_triangle_classes["FFF"] = "triangle-topleft";
		window.special_triangle_classes["TFF"] = "triangle-bottomright";
		

		$.getJSON('data.php', function(data) {
			var widgets = [];
			$.each(data.codes, function(code, diamond_data){
				var toprow = []; // FTT TTT TFT TTF
				
				var bottomrow = []; // TODO :)
				widgets.push('<div class="toprow">' + toprow + '</div><div class="bottomrow">' + bottomrow + '</div>');
            }
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