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
		<div id="FTT" class="triangle-topleft">15</div>
		<div id="FTTtext"><p>15</p></div>
		<div class="squaresbackground" id="FTTbackground"></div>
		<div class="FTTsquares">
			<div id="historic" class="squareblack"></div>
			<div id="current" class="squarewhite"></div>
			<div id="auto" class="squarewhite"></div>
		</div>

		<div id="TTT" class="triangle-bottomright">10</div>
		<div id="TTTtext"><p>10</p></div>
		<div class="squaresbackground" id="TTTbackground"></div>
		<div class="TTTsquares">
			<div id="historic" class="squarewhite"></div>
			<div id="current" class="squarewhite"></div>
			<div id="auto" class="squarewhite"></div>
		</div>
		
		<div id="TFT" class="triangle-bottomleft">13</div>
		<div id="TFTtext"><p>13</p></div>
		<div class="squaresbackground" id="TFTbackground"></div>
		<div class="TFTsquares">
			<div id="historic" class="squarewhite"></div>
			<div id="current" class="squareblack"></div>
			<div id="auto" class="squarewhite"></div>
		</div>
		
		<div id="TTF" class="triangle-topright">26</div>
		<div id="TTFtext"><p>26</p></div>
		<div class="squaresbackground" id="TTFbackground"></div>
		<div class="TTFsquares">
			<div id="historic" class="squarewhite"></div>
			<div id="current" class="squarewhite"></div>
			<div id="auto" class="squareblack"></div>
		</div>
		
	</div>
	<div id="bottomrow">
		<div id="FFT" class="triangle-bottomleft">3</div>
		<div id="FFTtext"><p>3</p></div>
		<div class="squaresbackground" id="FFTbackground"></div>
		<div class="FFTsquares">		
			<div id="historic" class="squareblack"></div>
			<div id="current" class="squareblack"></div>
			<div id="auto" class="squarewhite"></div>
		</div>
				
		<div id="FTF" class="triangle-topright">5</div>
		<div id="FTFtext"><p>5</p></div>
		<div class="squaresbackground" id="FTFbackground"></div>
		<div class="FTFsquares">		
			<div id="historic" class="squareblack"></div>
			<div id="current" class="squarewhite"></div>
			<div id="auto" class="squareblack"></div>
		</div>
		
		<div id="FFF" class="triangle-topleft">27</div>
		<div id="FFFtext"><p>27</p></div>
		<div class="squaresbackground" id="FFFbackground"></div>
		<div class="FFFsquares">		
			<div id="historic" class="squareblack"></div>
			<div id="current" class="squareblack"></div>
			<div id="auto" class="squareblack"></div>
		</div>
		
		<div id="TFF" class="triangle-bottomright">1</div>
		<div id="TFFtext"><p>1</p></div>
		<div class="squaresbackground" id="TFFbackground"></div>
		<div class="TFFsquares">		
			<div id="historic" class="squarewhite"></div>
			<div id="current" class="squareblack"></div>
			<div id="auto" class="squareblack"></div>
		</div>
		
	</div>

</body>
</html>