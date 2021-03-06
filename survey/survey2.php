<?php
include("utils/UI.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Survey</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="survey2.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
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
		<p>Imagine you had to look at a text message, like <span class='message'>"WHAAAAAAT?!"</span> and decide if it expresses an emotion, like <span class='emotion'>frustration</span>. At the same time, an automated classification algorithm is also trying to decide whether the message expresses emotion. When people create <span class='manual'>manual</span> labels, as well as when algorithms generate <span class='automatic'>automatic</span> labels, there is some possibility of error. Imagine that, to judge this error, a human judge is asked to also label this message, creating a <span class='verifying'>verifying</span> label. Some labels are more straightforward than others; identifying <span class='emotion'>frustration</span> is more straightforward than figuring out whether <span class='message'>"hmmmmm"</span> expresses <span class='emotion'>interest</span> or <span class='emotion'>confusion</span>. <strong>The following chart summarizes the result of a <span class='manual'>person</span>, an <span class='automatic'>algorithm</span>, and a <span class='verifying'>judge</span> all labeling 100 messages with a single emotion:</strong></p> 
	    <p class="img"><img src="img/horizontal_legend.PNG" alt="" height="200"></p>
		<p>In this task, <b>please identify the most difficult emotion to label, with the most problematic performance</b>, based on the charts shown. You will be judged based on the justification of your choice; the more detail you include, the more we can learn about how to improve these charts.</p><p>
            Each scenario will feature 42 charts, each representing labels for 100 messages and 1 emotion. Here's some possible kinds of charts you might see:</p>
		<table>
		<tr><td><img src="img/type-2.png"><!-- 70 acc, 80 rel --></td><td>This is <strong>pretty good</strong>. All three sets of labels agree a lot. Those times when the <span class='automatic'>automatic</span> labels disagree with the <span class='manual'>manual</span> labels, the <span class='verifying'>verifying</span> labels disagree with the <span class='manual'>manual</span> and agree with the <span class='automatic'>automatic</span>. In other words, the original labeller made some errors, but the algorithm works regardless, so it's okay.</td></tr>
		<tr><td><img src="img/type-4.png"><!-- 50 acc, 40 rel --></td><td>This is <strong>okay</strong>. All three sets of labels agree on half othe messages, which isn't great, but when the <span class='automatic'>automatic</span> labels disagree with the <span class='manual'>manual</span> labels, the <span class='verifying'>verifying</span> labels disagree with the <span class='manual'>manual</span> and agree with the <span class='automatic'>automatic</span>. Once again, the original labeller made some errors, but the algorithm works regardless, so it's okay.</td></tr>
		<tr><td><img src="img/type-5.png"><!-- 50 acc, 80 rel --></td><td>This is <strong>not okay</strong>. Not only are there 10+10=20 messages where the <span class='manual'>manual</span> and verification labels disagree, but also 15+15=30 messages where the <span class='manual'>manual</span> disagrees with the <span class='automatic'>automatic</span>. There is noise in both the human labeller and the <span class='automatic'>automatic</span> algorithm.</td></tr>
		<tr><td><img src="img/type-1.png"><!-- 50 acc, 80 rel --></td><td>This is <strong>pretty bad</strong>. The <span class='automatic'>automatic</span> labels are pretty much as bad as they can reasonably get, getting only about half of anything right, <em>but at least the <span class='manual'>manual</span> labels are consistent with the verifying labels.</em></td></tr>
		<tr><td><img src="img/type-3.png"><!-- 70 acc, 80 rel --></td><td>This is <strong>awful</strong>. All three sets of labels disgree badly. There are 10+10=20 messages where the <span class='automatic'>automatic</span> label agrees with the <span class='manual'>manual</span> label, but not with the <span class='verifying'>verifying</span> label. In other words, the original labelled made some errors, which really messed up the algorithm, so it's not okay.</td></tr>
		</table>
    </div>
	 <form method="post" action="submit.php">
    <div id="canvases">
    </div>
	   <div class="box">

			<p><span class="question">Question 4.</span> On a scale from 1 (Disagree) to 5 (Agree)
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

			<p><span class="question">Question 5.</span> On a scale from 1
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


			<p><span class="question">Question 6.</span> Is there anything
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
			<p class="img"><img src="img/vertical_legend.PNG" alt="" width="200"></p>
        </p>
    </div>
	   
</body>
</html>