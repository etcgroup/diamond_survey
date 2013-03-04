<?php

include("utils/Queries.php");
include("utils/Response.php");

$response = new Response();

echo "<h1>" . $response->token . "</h1>";

var_dump($_POST);
echo "<pre>";

$open_ended = "open-ended";
foreach ($_POST as $question => $answer) {
    if (substr($question, 0, strlen($open_ended)) == $open_ended) {
        $question = substr($question, 1 + strlen($open_ended));
        echo "insert open-ended " . $response->id . "; " . $question . "; " . $answer . "\n";
    } else if (is_numeric($answer)) {
        echo "insert likert " . $response->id . "; " . $question . "; " . (int)$answer . "\n";
    } else {
        $items = explode(" ", $answer);
        foreach ($items as $order => $item) {
            if ($item == "") {
                continue;
            }
            echo "insert order " . $response->id . "; " . $question . "; " . $item . "; " . $order . "\n";
        }
    }
}
?>
