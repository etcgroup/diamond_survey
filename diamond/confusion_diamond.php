<!DOCTYPE html>
<html>
<head>
	<title>Survey</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="confusion_diamond.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="confusion_diamond.css" />
        <script>
            $(function() {
              $( document ).tooltip();
            });
        </script>
</head>
<body>
    <div>
        <div class="taskbox">
           <div id="canvas3"></div>
           <input type="button" value="Reload Page" onClick="document.location.reload(true)">
        </div>
       </div>
    </div>
</body>
</html>