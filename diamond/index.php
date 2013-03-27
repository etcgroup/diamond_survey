<!DOCTYPE html>
<html>
<head>
	<title>Survey</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="color.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="styles.css" />
        <script>
            $(function() {
              $( document ).tooltip();
            });
        </script>
</head>
<body>
    <div class="box">
        <p>A group of scientists is studying emotion expression in text.
            They want to identify what emotion is expressed in individual text-based chat messages,
            but the chat log dataset is too large to be labeled manually, so:</p>
        <ol>
            <li>Scientists manually apply labels, such as "anger" and "frustration" to 15% of the chat log messages. This is the <b>historic data</b>.</li>
            <li>An automated classifier is created based on the <i>historic data</i>, and used to label the remaining 85% of the chat log messages. This is the <b>automatic data</b>.</li>
            <li>For validity, scientists look at 100 random messages that have been <i>both</i> manually and automatically labeled. They check whether they agree or disagree with a particular label that was applied. This is the <b>current data</b>.</li>
        </ol>
        <p>I designed a chart to help these scientists analyze the performance of all 42 of their labels, 
            which have historic, automatic, and current data for 100 messages. <b>Please help me improve this 
            chart</b> by using it to analyze how well the labeling process (outlined above) is working!</p>
        <p>An example of how to interpret the chart is below:</p>
        <p class="center">
            <img src="example_1_legend.png" height="400px">
        </p>
        <p>True signifies that the data type applied the label, where false did not. In triangle A, all three data types applied the label and were in agreement. 
            In triangle B, all three data types did not apply the label and were also in agreement. 
            Both of these elements lead to an accurate classifier.</p>
        <p>Analyze all 42 labels – each represented by a single chart – and identify each as accurate or inaccurate:</p>
        <p class="center">
            <img src="canvasexample.png">
        </p>
        <p>In the chart on the left, the automatic classifier is accurate relative to both current and historic data. 
            In the chart on the right, the automatic classifier is accurate, but <i>only for historic data, not current</i>. 
            The historic and automatic data can be said to be obsolete because it is outdated; what used to be true is not true now. 
            This might happen if the scientists who are labeling emotion in chat messages decide to change their definition of <i>frustration</i>; 
            perhaps they are now distinguishing <i>frustration</i> and <i>annoyance</i>, so messages that used to be labeled frustration would no longer be labeled as such. 
            This can lead to errors in similar codes, such as anger.</p>
        <p><b>Please analyze</b> the following three scenarios, based on the charts shown. 
            Each scenario will feature 42 charts, each representing a separate label, some with problems and others without. 
            <b>Your goal is to identify charts with the attributes specified in the scenarios</b>.</p>
    </div>
    <div class="box">
       <div id="canvas1"></div>
       <div id="canvas2"></div>
       <div id="canvas3"></div>
       <div id="canvas4"></div>
    </div>
</body>
</html>