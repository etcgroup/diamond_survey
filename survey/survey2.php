<?php
include("utils/UI.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Survey</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="survey2.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="survey2.css" />
   <script>
	var time_start = new Date();
	var time_example = [];
	var time_help = [];
	var timer = 0;
	
	// Adding up modal sessions and submitting the values
	function submitTime() {
		curr_time = new Date();
		var total_time = document.getElementById("total-survey-time");
		var survey_time = Math.round((curr_time - window.time_start) / 1000);
		total_time.value = survey_time;
	}
	$(function() {
		$('#key-button').on("click",function(){
			if($(this).text()=="[-]"){
				$(this).text("[+]");
				$("#key").css("right", "-250px");
			} else{
				$(this).text("[-]");
				$("#key").css("right", "-30px");
			}
		});
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
            <img src="img/example_1_legend.png" height="400px">
        </p>
        <p>True signifies that the data type applied the label, where false did not. In triangle A, all three data types applied the label and were in agreement. 
            In triangle B, all three data types did not apply the label and were also in agreement. 
            Both of these elements lead to an accurate classifier.</p>
        <p>Analyze all 42 labels – each represented by a single chart – and identify each as accurate or inaccurate:</p>
        <p class="center">
            <img src="img/canvasexample.png">
        </p>
        <p>In the chart on the left, the automatic classifier is accurate relative to both current and historic data. 
            In the chart on the right, the automatic classifier is accurate, but <i>only for historic data, not current</i>. 
            The historic and automatic data can be said to be obsolete because it is outdated; what used to be true is not true now. 
            This might happen if the scientists who are labeling emotion in chat messages decide to change their definition of <i>frustration</i>; 
            perhaps they are now distinguishing <i>frustration</i> and <i>annoyance</i>, so messages that used to be labeled frustration would no longer be labeled as such. 
            This can lead to errors in similar codes, such as anger.</p>
        <p><b>Please analyze</b> the following scenarios, based on the charts shown. 
            Each scenario will feature 30 charts, each representing a separate label, some with problems and others without. 
            <b>Your goal is to identify the most problematic chart in each scenario</b>.</p>
    </div>
	 <form method="post" action="submit.php">
    <div id="canvases">
    </div>
	   <div class="box">

			<p><span class="question">Question 6.</span> On a scale from 1 (Disagree) to 5 (Agree)
				please rate the following statements:</p>

			<?php
			echo UI::likert("reflection", array(
				"difficulty" => " The chart was difficult to learn",
				"learned" => "The chart was easy to use once I figured it out",
				"usable" => "I was able to use the chart to guide me through the scenarios",
				"bugs" => "The chart was helpful for understanding classifier bugs",
				"data_shifts" => "The chart was useful for understanding shifts in the dataset"
					), 5, "disagree", "agree");
			?>

			<p><span class="question">Question 7.</span> On a scale from 1
				(unfamiliar) to 7 (expert) please rate your familiarity with
				the following topics:</p>

			<?php
			echo UI::likert("familiarity", array(
				"Quantitative Data Analysis",
				"Qualitative Data Analysis",
				"Visual Analytics",
				"Machine Learning",
				"Data Mining",
				"Confusion Matrices"
					), 7, "unfamiliar", "familiar");
			?>


			<p><span class="question">Question 8.</span> Is there anything
				you'd like to comment on regarding the chart or this survey?</span></p>
			<textarea name="open-ended-comments"></textarea>
		</div>
	   
		<div class="box">
			<input name="answer" id="answer" type="hidden" value="" />
			<input name="type" id="type" type="hidden" value="" />
			<input name="hill" id="hill" type="hidden" value="" />
			<input type="hidden" name="total-survey-time" id="total-survey-time" value="" />
			<input type="submit" onclick="submitTime()" class="submit" />
		</div>
	</form>
	
</div>
    <div id="key">
        <p>
            <button id="key-button">[-]</button>
            <em>Legend:</em>
            <p class="img"><img src="img/legend.PNG" alt="" height="150"></p>
            <em>Example Interpretation:</em>
            <p class="img">
                <img src="img/annotatedexample.PNG" alt="" height="100">
            <ul class="example_interp">
                <li>20 messages were labeled true by all three data sets (Manual, Inferred, Verifying).</li>
                <li>26 messages were labeled as false by Manual, but true by Inferred and Verifying. This indicates an interesting change between the Manual and Verifying data sets.</li>
                <li>34 messages were labeled true in Manual, but false by Inferred and Verifying. This also indicates a change between the Manual and Verifying data.</li>
                <li>The 26 and 34 percent message groups signify that there was a severe code definition shift problem.</li>
            </ul>
            </p>
        </p>
    </div>
	   
</body>
</html>