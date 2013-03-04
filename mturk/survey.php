<?php
include("utils/UI.php");
?>
<html>
    <head>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="css/bootstrap.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script src="libs/bootstrap.js"></script>
        <style>
            #sortable { list-style-type: none; margin: 0; padding: 0; width: 500px; }
            #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: .9em; height:18px }
            #sortable li span { position: absolute; margin-left: -1.3em; }
            .help{ font-size: .9em }
            .q-box{ position:relative;width:500px; } 
            .q-box-left{ float:left; width:75%; }
            .q-box-right{ float:right; width:20%; }
            .q-box-clear{ clear:both;padding-top:15px; }
        </style>
        <script>
            $(function() {
                $( "#sortable" ).sortable({
                    stop: function(){
                        console.log($(this).sortable( "toArray" ));
                    }
                });
                $( "#sortable" ).disableSelection();
                $(".help").button({
                    icons: {
                        primary: "ui-icon-help"
                    }
                }).click(function( event ) {
                    $("#"+$(this).attr("help")).modal();
                });
            });
        </script>
    </head>
    <body>

        <div id="problems" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Possible problems</h3>
            </div>
            <div class="modal-body">
                <p><strong>False positives:</strong> The automatic classifier is
                    labeling lines as "interest" that are not actually "interest" in
                    either the historic or current data. The classifier is generating
                    false positives.</p>
                <p><strong>False negatives:</strong> The automatic classifier is failing
                    to label lines as "interest" that are not actually "interest" that
                    are labeled thus in both the historic or current data. The
                    classifier is generating false negatives.</p>
                <p><strong>False true-positives/negatives:</strong> The
                    automatic classifier is correctly labeling messages as according to
                    historic, but not current data; therefore, the apparently true
                    positives are now false.</p>
                <p><strong>Code definition narrows:</strong> The historic data has some
                    messages labeled as "interest" that are not labeled than in the
                    current data. The definition of the "interest" label has
                    narrowed over time.</p>
                <p><strong>Code definition expands:</strong> In the current data, the
                    "interest" label is applied to some messages to which it is not in
                    the historic data. The definition of the "interest" label has
                    expanded over time.</p>
                <p><strong>Code definition shifts:</strong> The current and historic
                    labels disagree. The definition of the "interest" label has
                    shifted over time.</p>
            </div>
        </div>


        <h1>Introduction</h1>
        <p>A group of scientists is studying emotion expression in text. They
            want to identify what emotion is expressed in individual text chat
            messages, but in a chat log data too big to be labeled manually,
            so:</p>
        <ol>
            <li>Scientists manually apply labels, such as "anger" and
                "frustration" to 15% of the chat log messages.
                This is the <strong>historic data</strong>.
                <a href=example.html>[example]</a></li>
            <li>An automated classifier is created based on the <em>historic
                    data</em>, and used to label the remaining 85% of the chat
                log messages. This is the
                <strong>automatic data</strong>.</li>
            <li>For validity, scientists look at 100 random messages that have
                been <em>both</em> manually and automatically labeled. They
                check whether they agree or disagree with a particular label
                that was applied. This is the
                <strong>current data</strong>.</li>
        </ol>

        <p>I am studying a chart that I designed to help these scientists
            consider all at once the 3 labels that have been applied to 100
            messages - historic, automatic, and current.
            <strong>Please help me improve this chart</strong> by stepping into
            the shoes of these scientists, and using it to analyze how well
            the labeling process (outlined above) is working!</p>

        <p>For example, consider these two charts:</p>
        <p><img src="http://anachrobot.us/storage/example_2_obsolete.PNG" height=200></p>

        <p>In the chart on the left, the automatic classifier is accurate
            relative to both current and historic data. In the chart on the
            right, the automatic classifier is accurate, but <em>only for
                historic data</em>, not current. The historic and automatic
            data can be said to be obsolete because it is outdated; what
            used to be true is not true now. This might happen if the
            scientists who are labeling emotion in chat messages decide
            to change their definition of <em>frustration;</em> perhaps
            they are now distinguishing <em>frustration</em> and
            <em>annoyance</em>, so messages that used to be labeled
            <em>frustration</em> would no longer be.</p>

        <p><strong>Please analyze</strong> the following three scenarios, based on
            the charts shown. The data in all three scenarios are for the label
            "interest," and represent hypothetical problems in labeling -
            <strong>your goal is to identify these problems and suggest
                solutions</strong>.</P>

        <h1>Scenario 1</h1>
        <p><img src="http://anachrobot.us/storage/scenario1.PNG" alt="" /></p>

        <div class="q-box">
            <div class="q-box-left">
                <u>Question 1.</u> What problem(s) exist in this scenario? Using
                dragging and dropping, <strong>sort from most problematic (at
                    the top) to least problematic (at the bottom).</strong> 
            </div>
            <div class="q-box-right">
                <div class="help ui-state-error" help="problems">help</div>
            </div>
            <div class="q-box-clear">
                <?php
                echo UI::orderlist("problems",array(
                    "FP" => "False positives",
                    "FN" => "False positives",
                    "FTPN" => "False true-positives/negatives",
                    "nrw" => "Code definition narrows",
                    "nrw" => "Code definition expands",
                    "shft" => "Code definition shifts"
                ));
                ?>
            </div>
        </div>
        
        <div class="q-box">
            <div class="q-box-clear">
                <u>Question 2.</u> How could the scientists improve the data?
                <strong>Sort from most effective (at the top) to least
                    effective (at the bottom).</strong> 
            </div>
            <div class="q-box-clear">
                <?php
                echo UI::orderlist("solutions",array(
                    "ml" => "Find/build a better automatic classifier",
                    "cdr" => "Find more reliable people to label data",
                    "lbl" => "Go through the labels and refine definitions"
                ));
                ?>
            </div>
        </div>

        <h2>Scenario 2</h2>
        <p><img src="http://anachrobot.us/storage/scenario2.PNG" alt="" /></p>
        What is causing this performance?
        What should the researchers do next to improve the performance?
        <h3>Scenario 3</h3>
        <p><img src="http://anachrobot.us/storage/scenario3.PNG" alt="" /></p>

        What is causing this performance?
        What should the researchers do next to improve the performance?


        <h2>Additional Questions</h2>
        <p>On a scale from 1 (Disagree) to 5 (Agree) please rate the following statements:</span></p>
    <?php
    echo UI::likert("reflection", array(
        "The visualization was difficult to learn",
        "The visualization was easy to use once I figured it out",
        "The visualization was easy to use once I figured it out",
        "I was able to use the visualization to guide me through the scenarios",
        "The visualization was helpful for understanding classifier bugs",
        "The visualization was useful for understanding shifts in the dataset"
            ), 5, "disagree", "agree");
    ?>

    <p>On a scale from 1 (unfamiliar) to 7 (expert) please rate your familiarity with the following topics:</p>

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
</body>
</html>