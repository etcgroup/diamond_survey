<?php
include("utils/Queries.php");
include("utils/Response.php");
?>
<html>
    <head>
        <style>
            body{ background-color:#aaaaaa; }
            .box{
                width:600px;
                margin:auto;
                padding:50px; 
                margin-bottom:30px;
                margin-top:30px;
                background-color:#ffffff;
            }
        </style>
        <title>Survey</title>
    </head>
    <body>
        <div class="box">
             <p><strong><em>Thank you for taking our survey! Please copy this line 
                        into mechanical turk to get credit for this HIT:</em></strong></p>

<?php
$response = new Response();
echo "<h3>" . $response->token . "</h3>";
foreach ($_POST as $question => $answer) {
    $response->answer_question($question, $answer) . "\n";
}
?>
        </div>
    </body>
</html>
