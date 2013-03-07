<?php

include("utils/Queries.php");
include("utils/Response.php");

$response = new Response();

var_dump($_POST);

echo "<p><strong><em>Thank you for takign our survey! Please copy this line ";
echo "into mechanical turk to get credit for this HIT:</em></strong></p>";
echo "<h3>" . $response->token . "</h3>";

foreach ($_POST as $question => $answer) {
    $response->answer_question($question, $answer)."\n";
}
?>
