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
				$("#key").css("right", "-200px");
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
		<p>Imagine you had to look at a text message, like <span class='message'>"WHAAAAAAT?!"</span> and decide if it expresses an emotion, like <span class='code'>frustration</span>. At the same time, an automated classifier is also trying to decide whether the message expresses emotion. When people create <span class='manual'>manual</span> labels, as well as when algorithms generate <span class='automatic'>automatic</span> labels, there is some possibility of error. Imagine that, to judge this error, a human judge is asked to also label this message, creating a <span class='verifying'>verifying</span> label. Some labels are more straightforward than others; identifying <span class='code'>frustration</span> is more straightforward than figuring out whether <span class='message'>"hmmmmm"</span> expresses <span class='code'>interest</span> or <span class='code'>confusion</span>. <strong>The following chart summarizes the result of a person, an algorithm, and a judge all labeling 100 messages with a single emotion:</strong></p> 
	    <p class="img"><img src="img/horizontal_legend.PNG" alt="" height="120"></p>
            <!--<ul >
                <li>20 messages were labeled true by all three data sets (Manual, automatic, Verifying).</li>
                <li>26 messages were labeled as false by Manual, but true by automatic and Verifying. This indicates an interesting change between the Manual and Verifying data sets.</li>
                <li>34 messages were labeled true in Manual, but false by automatic and Verifying. This also indicates a change between the Manual and Verifying data.</li>
                <li>The 26 and 34 percent message groups signify that there was a severe label definition shift problem.</li>
            </ul>-->
		<p>In this task, <b>please identify the most difficult emotion to label, with the most problematic performance</b>, based on the charts shown. You will be judged based on the justification of your choice; the more detail you include, the more we can learn about how to improve these charts.</p><p>
            Each scenario will feature 30 charts, each representing labels for 100 messages and 1 emotion. Here's some possible kinds of charts you might see:</p>
		<table>
		<tr><td><img src="img/type-2.png"><!-- 70 acc, 80 rel --></td><td>This is <strong>pretty good</strong>. All three sets of labels agree a lot. Those times when the automatic labels disagree with the manual labels, the verificaiton labels disagree with the manual and agree with the automatic. In other words, the original labeller made some errors, but the algorithm works regardless, so it's okay.</td></tr>
		<tr><td><img src="img/type-4.png"><!-- 50 acc, 40 rel --></td><td>This is <strong>okay</strong>. All three sets of labels agree on half othe messages, which isn't great, but when the automatic labels disagree with the manual labels, the <em>verificaiton labels disagree with the manual and agree with the automatic</em>. Once again, the original labeller made some errors, but the algorithm works regardless, so it's okay.</td></tr>
		<tr><td><img src="img/type-5.png"><!-- 50 acc, 80 rel --></td><td>This is <strong>not okay</strong>. Not only are there 10+10=20 messages where the manual and verification labels disagree, but also 15+15=30 messages where the manual disagrees with the automatic. There is noise in both the labeller and the algorithm.</td></tr>
		<tr><td><img src="img/type-1.png"><!-- 50 acc, 80 rel --></td><td>This is <strong>pretty bad</strong>. The automatic labels are pretty much as bad as they can reasonably get, getting only about half of anythign right, <em>but at least the manual labels are consistent with the verifying labels.</em></td></tr>
		<tr><td><img src="img/type-3.png"><!-- 70 acc, 80 rel --></td><td>This is <strong>awful</strong>. All three sets of labels disgree in pretty bad ways. There are 10+10=20 messages where the automatic label agrees with the manual label, <em>but not with the verificaiton label</em>. In other words, the original labelled made some errors, which really messed up the algorithm, so it's not okay.</td></tr>
		</table>
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
			<p class="img"><img src="img/annotatedexample.PNG" alt="" height="100"></p>
            <p class="img"><img src="img/legend.PNG" alt="" height="150"></p>
        </p>
    </div>
	   
</body>
</html>