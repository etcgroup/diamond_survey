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
            .help{ font-size: .9em }
            body{
                background-color:#aaaaaa;
            }
            .box{
                width:50%;
                margin:auto;
                padding-top:20px;
                padding-bottom:20px;
                margin-bottom:30px;
                margin-top:30px;
                background-color:#ffffff;
            }
            .q-box{ position:relative;width:500px; margin:auto; background-color:#dddddd; padding:10px; border:solid 1px #333333; margin-bottom:5px;} 
            p,h1,.likert{
               padding-left:50px;
               padding-right:50px;
            }
            .likert-extreme{
                font-size:.5em;
                color:#aaaaaa;
            }
            .q-box-left{ float:left; width:75%; }
            .q-box-right{ float:right; width:20%; }
            .q-box-clear{ clear:both;padding-top:15px; }
            .img{
                text-align: center;
            }
            .img img{
                border:solid 1px #aaaaaa;
            }
        </style>
        <script>
            $(function() {
                $( ".sortable" ).sortable({
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
        <div class="box">
            <div class="q-box">
                <div class="q-box-left">
                    A group of scientists is studying emotion expression in text. They
                    want to identify what emotion is expressed in individual text chat
                    messages, but in a chat log data too big to be labeled manually,
                    so:</strong> 
                </div>
                <div class="q-box-right">
                    <div class="help ui-state-highlight" help="example">example</div>
                </div>
                <div class="q-box-clear">
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
                </div>
            </div>

            <p>I designed a chart to help these scientists
                consider all at once the 3 labels that have been applied to 100
                messages - historic, automatic, and current.
                <strong>Please help me improve this chart</strong> by stepping into
                the shoes of these scientists, and using it to analyze how well
                the labeling process (outlined above) is working!</p>

            <p class="img"><img src="http://anachrobot.us/storage/example_1_legend.PNG" alt="" height=300 /></p>

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
                <em>frustration</em> would no longer be.</p>


            <p><strong>Please analyze</strong> the following three scenarios, based on
                the charts shown. The data in all three scenarios are for the label
                "interest," and represent hypothetical problems in labeling -
                <strong>your goal is to identify these problems and suggest
                    solutions</strong>.</P>
        </div>
        <div class="box">
            <h1>Scenario 1</h1>
            <p class="img"><img src="http://anachrobot.us/storage/scenario1.PNG" alt="" width="300"/></p>

            <div class="q-box">
                <div class="q-box-left">
                    <u>Question 1.</u> What problem(s) exist in this scenario? Using
                    dragging and dropping, <strong>sort from most problematic (at
                        the top) to least problematic (at the bottom).</strong> 
                </div>
                <div class="q-box-right">
                    <div class="help ui-state-highlight" help="problems">help</div>
                </div>
                <div class="q-box-clear">
                    <?php
                    echo UI::orderlist("problems", array(
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
                    echo UI::orderlist("solutions", array(
                        "ml" => "Find/build a better automatic classifier",
                        "cdr" => "Find more reliable people to label data",
                        "lbl" => "Go through the labels and refine definitions"
                    ));
                    ?>
                </div>
            </div>
        </div>

        <div class="box">
            <h1>Scenario 2</h1>
            <p class="img"><img src="http://anachrobot.us/storage/scenario2.PNG" alt="" wdith="300" /></p>
            <div class="q-box">
                <div class="q-box-left">
                    <u>Question 3.</u> Describe what problems exist in this scenario.
                    Hint: refer to the options presented in question 1!
                </div>
                <div class="q-box-right">
                    <div class="help ui-state-highlight" help="problems">help</div>
                </div>
                <div class="q-box-clear">
                    <textarea style="width:500px;height:200px;"></textarea>
                </div>
            </div>
            <div class="q-box">
                <div class="q-box-clear">
                    <u>Question 4.</u> What should the researchers do next to improve the performance?<br>
                    <textarea style="width:500px;height:200px;"></textarea>
                </div>
            </div>
        </div>
        <div class="box">
            <h1>Scenario 3</h1>
            <p class="img"><img src="http://anachrobot.us/storage/scenario3.PNG" alt="" width="500 "/></p>
            <p>Here, two charts are shown side by side: the first one is from December 2012, and the second - from January 2013. <strong>Think about what changed in that time to have this kind of impact on the different kinds of data.</strong>
            <div class="q-box">
                <div class="q-box-left">
                    <u>Question 5.</u> Describe what problems exist in this scenario.
                    Hint: refer to the options presented in question 1!
                </div>
                <div class="q-box-right">
                    <div class="help ui-state-highlight" help="problems">help</div>
                </div>
                <div class="q-box-clear">
                    <textarea style="width:500px;height:200px;"></textarea>
                </div>
            </div>
            <div class="q-box">
                <div class="q-box-clear">
                    <u>Question 6.</u> What should the researchers do next to improve the performance?<br>
                    <textarea style="width:500px;height:200px;"></textarea>
                </div>
            </div>
        </div>

        <div class="box">
            <p><u>Question 7.</u> On a scale from 1 (Disagree) to 5 (Agree) please rate the following statements:</span></p>
    <?php
    echo UI::likert("reflection", array(
        "The chart was difficult to learn",
        "The chart was easy to use once I figured it out",
        "The chart was easy to use once I figured it out",
        "I was able to use the chart to guide me through the scenarios",
        "The chart was helpful for understanding classifier bugs",
        "The chart was useful for understanding shifts in the dataset"
            ), 5, "disagree", "agree");
    ?>

    <p><u>Question 8.</u> On a scale from 1 (unfamiliar) to 7 (expert) please rate your familiarity with the following topics:</p>

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
</div>


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


<div id="example" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Example</h3>
    </div>
    <div class="modal-body">
        <p>Below is a segment of a chat log with labeled data;
            #1 is the <u>historic</u>, #2 is the <u>automatic</u>, and #3
        is the <u>current</u> label</p>
        <table>
            <tr><th>time</th><th>speaker</th><th>message</th></tr>
            <tr><td>05:58:41</td><td>Alice</td><td>ok, so where was the f***ing SN on the image?<br>#1: interest / anger<br>#2: annoyance / confusion<br>#3:   interest / frustration</td></tr>
            <tr><td>05:58:55</td><td>Alice</td><td>was it the bright blob?<br>#1: interest / anger<br>#2: considering<br>#3: interest</td></tr>
            <tr><td>05:59:03</td><td>Ben</td><td>5876 absorption is much wider than the H alpha in v space<br>#1, #2, #3: no affect</td></tr>
            <tr><td>05:59:18</td><td>Ben</td><td>Oh hmmm.<br>#1, #2, #3: considering</td></tr>
            <tr><td>05:59:28</td><td>Ben</td><td>Lemme see what [the] coordinates were...</td>#1, #2, #3: no affect</td></tr>
           <!-- <tr><td>06:13:07</td><td>Charlie</td><td>is it "well-developed"?<br>#1: interest</tr></tr>
           <tr><td>06:13:18</td><td>Alice</td><td>Should be an interesting experiment.<br>#1, #2: anticipation<br>#3: interest</td></tr>
           <tr><td>06:13:19</td><td>Dana</td><td>yes<br>#1, #3: agreement<br>#2: no affect</td></tr>
           <tr><td>06:12:20</td><td>Dana</td><td>big!!<br>#1: excitement / agreement<br>#2, #3: excitement</td></tr>-->
        </table>

    </div>
</div>


</body>
</html>