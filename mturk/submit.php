<?php

include("utils/Queries.php");
include("utils/Response.php");

$response = new Response();

echo "<h1>" . $response->token . "</h1>";

echo "<pre>";

foreach ($_POST as $question => $answer) {
    echo $response->answer_question($question, $answer)."\n";
}
?>
