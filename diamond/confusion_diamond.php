<!DOCTYPE html>
<html>
<head>
	<title>Confusion Diamond</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="confusion_diamond.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="confusion_diamond.css" />
        <script>
            $(function() {
              //$( document ).tooltip();
            });
        </script>
</head>
<body>
    <div>
        <div class="taskbox">
           <div id="canvases">
           </div>
           <form id="selection">
               <input name="answer" id="answer" type="hidden" value="" />
               <input name="type" id="type" type="hidden" value="" />
               <input name="hill" id="hill" type="hidden" value="" />
           </form>
           <!-- 
           <p>Showing 10 labels with majority of confusion diamonds with xx error. </p>
           <p>Noise was introduced by random uniform selection of 10 pairs of data cells with incrementing one and decrementing the other. This was done independently for each label.</p>
           -->
           <div class="center"> 
               <input type="button" value="Reload Page" onClick="document.location.reload(true);">   
           </div>
        </div>
       </div>
    </div>
</body>
</html>