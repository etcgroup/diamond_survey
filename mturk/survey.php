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
            .sortable { list-style-type: none; margin: 0; padding: 0; width: 500px; }
            .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: .9em; height:18px }
            .sortable li span { position: absolute; margin-left: -1.3em; }
            .help{
                font-size: .9em;
                float: right;
            }
            .example-table td{
                vertical-align: top;
                border-top:solid 1px #cccccc;
                padding-right:4px;
            }
            .submit{
                width:20%;
                height:40px;
                margin-left:40%;
                margin-right:40%;
            }
            h1{ text-align: center; }
            body{ background-color:#aaaaaa; }
            .box{
                width:600px;
                margin:auto;
                padding:50px; 
                margin-bottom:30px;
                margin-top:30px;
                background-color:#ffffff;
            }
            .likert-extreme{ font-size:.7em; color:#aaaaaa; }
            .likert-option{ font-size:.9em; padding-right:5px; }
            .img{ text-align: center; }
            .img img{ border: solid 1px #aaaaaa; }
            textarea{ width: 100%; height: 200px; }
            #key{
                -moz-border-radius: 15px;
                border-radius: 15px;
                padding:20px;
                padding-right:50px;
                position: fixed;
                bottom: 10px;
                right: -30px;
                z-index: -1;
                background-color: #ffffff;
                border:solid 1px #333333;
            }
            .question{
                background-color:#aa0000;
                color:#ffffff;
                padding-left:2px;
                padding-right:3px;
            }
        </style>
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

                var session_help = document.getElementById("session-help-time");
                session_help.value = window.time_help;

                var session_example = document.getElementById("session-example-time");
                session_example.value = window.time_example;
                
                var total_help = document.getElementById("total-help-time");
                sessions_help = 0;
                for (x in time_help) {
                    sessions_help += time_help[x];
                }
                total_help.value = sessions_help;
                
                var total_example = document.getElementById("total-example-time");
                sessions_example = 0;
                for (x in time_example) {
                    sessions_example += time_example[x];
                }
                total_example.value = sessions_example;
            
            }
            $(function() {
                $(".sortable").sortable({
                    stop: function() {
                        ids = $(this).sortable("toArray");
                        var list = "";
                        for (var i in ids) {
                            list += $("#" + ids[i]).attr('value') + " ";
                        }
                        $("#" + $(this).attr('id') + "-input").attr('value', list);
                    }
                });
                $("#sortable").disableSelection();
                $(".help").button({
                    icons: {
                        primary: "ui-icon-help"
                    }
                }).click(function(event) {
                    $("#" + $(this).attr("help")).modal();
                });
                $('#possible-problems').on('hidden', function() {
                    // stop timer, record, restart timer
                    // keep stuff in hidden inputs
                    window.time_help.push(Math.round(((new Date() - timer) / 1000)));
                    window.timer = 0;
                });
                $('#example').on('hidden', function() {
                    // stop timer, record, restart timer
                    // keep stuff in hidden inputs
                    window.time_example.push(Math.round(((new Date() - window.timer) / 1000)));
                    window.timer = 0; 
                });
               
                $('.modal').on('shown', function() {
                    // start timer
                    window.timer = new Date();
                });
            });
        </script>
        <title>Survey</title>
    </head>
    <body>
        <div id="key">
            <p><em>How to read the chart:</em></p>
            <p class="img"><img src="http://anachrobot.us/storage/example_1_legend.PNG" alt="" height=300 /></p>
        </div>
        <div class="box">
            <div class="help ui-state-highlight" help="example" style="margin-top:20px">example</div>
            <p>A group of scientists is studying emotion expression in text. They
                want to identify what emotion is expressed in individual text-based chat
                messages, but the chat log dataset is too big to be labeled manually,
                so:</p>
            <ol>
                <li>Scientists manually apply labels, such as "anger" and
                    "frustration" to 15% of the chat log messages.
                    This is the <strong>historic data</strong>.</li>
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
            <p>I designed a chart to help these scientists
                analyze the historic, automatic, and current data all at once for
                codes that have been applied to 100 messages.
                <strong>Please help me improve this chart</strong> by using it to analyze how well
                the labeling process (outlined above) is working!</p>

            <p>For example, consider these two charts:</p>
            <p class="img"><img src="http://anachrobot.us/storage/example_2_obsolete.PNG" height=200></p>

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
                <em>frustration</em> would no longer be labeled as such.</p>


            <p><strong>Please analyze</strong> the following three scenarios, based on
                the charts shown. The data in all three scenarios are for the label
                "interest," and represent hypothetical problems in labeling -
                <strong>your goal is to identify these problems and suggest
                    solutions</strong>.</P>
        </div>
        <form method="post" action="submit.php">
            <div class="box">
                <h1>Scenario 1</h1>
                <p>Consider the chart below:</p>
                <p class="img"><img src="http://anachrobot.us/storage/scenario1.PNG" alt="" width="300"/></p>

                <div class="help ui-state-highlight" help="possible-problems">help</div>
                <p><span class="question">Question 1.</span> What problem(s) exist
                    in this scenario? Using dragging and dropping, <strong>sort
                        from most problematic (at the top) to least problematic
                        (at the bottom).</strong></p> 
                <?php
                echo UI::orderlist("problems", array(
                    "FP" => "False positives",
                    "FN" => "False positives",
                    "FTPN" => "False true-positives/negatives",
                    "nrw" => "Code definition narrows",
                    "exp" => "Code definition expands",
                    "shft" => "Code definition shifts"
                ));
                ?>

                <p><span class="question">Question 2.</span> How could the scientists improve the data?
                    <strong>Sort from most effective (at the top) to least
                        effective (at the bottom).</strong></p>
                <?php
                echo UI::orderlist("solutions", array(
                    "ml" => "Find/build a better automatic classifier",
                    "cdr" => "Find more reliable people to label data",
                    "lbl" => "Go through the labels and refine definitions"
                ));
                ?>
            </div>

            <div class="box">
                <h1>Scenario 2</h1>
                <p>Consider the chart below:</p>
                <p class="img"><img src="http://anachrobot.us/storage/scenario2.PNG" alt="" wdith="300" /></p>
                <div class="help ui-state-highlight" help="possible-problems">help</div>
                <p><span class="question">Question 3.</span> Describe what
                    problems exist in this scenario.
                    Hint: refer to the options presented in question 1!</span></p>
                <textarea name="open-ended-2-problems"></textarea>
                <p><span class="question">Question 4.</span> What should the
                    researchers do next to improve the performance? (Refer to question 2 for example answers).</p>
                <textarea name="open-ended-2-solutions"></textarea>
            </div>
            <div class="box">
                <h1>Scenario 3</h1>
                <p>Consider the chart below:</p>
                <p class="img"><img src="http://anachrobot.us/storage/scenario3.PNG" alt="" width="500 "/></p>
                <div class="help ui-state-highlight" help="possible-problems">help</div>
                <p>Here, two charts are shown side by side: the first one is
                    from December 2012, and the second - from January 2013.
                    <strong>Think about what changed in that time to have this
                        kind of impact on the different kinds of data.</strong>
                <p><span class="question">Question 5.</span> Describe what problems exist in this scenario.
                Hint: refer to the options presented in question 1!</p>
                <textarea name="open-ended-3-problems"></textarea>
                <p><span class="question">Question 6.</span> What should the researchers do next
                to improve the performance? (Refer to question 2 for example answers).</p>
                <textarea name="open-ended-3-solutions"></textarea>
            </div>

            <div class="box">

                <p><span class="question">Question 7.</span> On a scale from 1 (Disagree) to 5 (Agree)
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

                <p><span class="question">Question 8.</span> On a scale from 1
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


                <p><span class="question">Question 9.</span> Is there anything
                    you'd like to comment on regarding the chart or this survey?</span></p>
                <textarea name="open-ended-comments"></textarea>
            </div>


            <div id="possible-problems" class="modal hide fade">
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
                        to label lines as "interest" that are not actually "interest". These lines
                        are labeled as "interest" in both historic or current data. The
                        classifier is generating false negatives.</p>
                    <p><strong>False true-positives/negatives:</strong> The
                        automatic classifier is correctly labeling messages as according to
                        historic, but not current data; therefore, the apparently true
                        positives are now false.</p>
                    <p><strong>Code definition narrows:</strong> The historic data has some
                        messages labeled as "interest" that are not labeled "interest" in the
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


            <div id="example" class="modal hide fade">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Example</h3>
                </div>
                <div class="modal-body">
                    <p>Below is a segment of a chat log with labeled data;
                        #1 is the <u>historic</u>, #2 is the <u>automatic</u>, and #3
                    is the <u>current</u> label</p>
                    <table class="example-table">
                        <tr><th>time</th><th>speaker</th><th>message</th><th>emotion label</th></tr>
                        <tr><td>05:58:41</td><td>Alice</td><td>ok, so where was the f***ing SN on the image?</td><td>#1: interest, anger<br>#2: annoyance, confusion<br>#3:   interest, frustration</td></tr>
                        <tr><td>05:58:55</td><td>Alice</td><td>was it the bright blob?</td><td>#1: interest, anger<br>#2: considering<br>#3: interest</td></tr>
                        <tr><td>05:59:03</td><td>Ben</td><td>5876 absorption is much wider than the H alpha in v space  </td><td>#1, #2, #3: no affect</td></tr>
                        <tr><td>05:59:18</td><td>Ben</td><td>Oh hmmm.</td><td>#1, #2, #3: considering</td></tr>
                        <tr><td>05:59:28</td><td>Ben</td><td>Lemme see what [the] coordinates were...</td><td>#1, #2, #3: no affect</td></tr>
                    </table>
                </div>
            </div>

            <div class="box">
                <input type="hidden" name="total-help-time" id="total-help-time" value="">
                <input type="hidden" name="session-help-time" id="session-help-time" value="">
                <input type="hidden" name="total-example-time" id="total-example-time" value="">
                <input type="hidden" name="session-example-time" id="session-example-time" value="">
                <input type="hidden" name="total-survey-time" id="total-survey-time" value="">
                <input type="hidden" name="problems" id="problems-input">
                <input type="hidden" name="solutions" id="solutions-input">
                <input type="submit" onclick="submitTime()" class="submit">
            </div>
        </form>
    </body>
</html>