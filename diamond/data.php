<?php

// emotion labels  
$labels28 = array("acceptance", "admiration", "agreement", "amazement", "amusement", "anger", "annoyance", "anticipation", "apologetic", "apprehension", "boredom", "confusion", "considering", "disagreement",
                "disappointment", "disbelief", "disgust", "distraction", "ecstasy", "embarrassment", "excitement", "fear", "frustration", "gratitude", "grief", "happiness", "impatience", "interest");

// setting bases for each error type
$bases = array(
    "ideal" => array("FTT" => 0, "TTT" => 50, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 40, "TFF" => 10),
    "accurate" => array("FTT" => 25, "TTT" => 25, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 25, "TFF" => 25),
    "auto error" => array("FTT" => 0, "TTT" => 20, "TFT" => 30, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 20, "TFF" => 30),
    "current error" => array("FTT" => 0, "TTT" => 20, "TFT" => 0, "TTF" => 30, "FFT" => 30, "FTF" => 0, "FFF" => 20, "TFF" => 0)
);

// proportions for each error type
$ideal = array (
    "ideal" => 23,
    "accurate" => 3,
    "auto error" => 1,
    "current error" => 1
    );

$auto= array (
    "ideal" => 3,
    "accurate" => 1,
    "auto error" => 23,
    "current error" => 1
    );

$current= array (
    "ideal" => 3,
    "accurate" => 1,
    "auto error" => 1,
    "current error" => 23
    );

$accurate = array (
    "ideal" => 3,
    "accurate" => 23,
    "auto error" => 1,
    "current error" => 1
    );

$values = null;
	
$cases = array ($ideal, $auto, $current, $accurate);
$selection = array_rand($cases);
        
switch($selection){
    case $ideal: $values = get_values($labels28, $ideal, $bases, 10); break;
    case $auto: $values = get_values($labels28, $auto, $bases, 10); break;
    case $current: $values = get_values($labels28, $current, $bases, 10); break;
    default: $values = get_values($labels28, $accurate, $bases, 10);
}

echo json_encode(array("task" => 0, "values" => $values));

//echo json_encode(array("label count" => 10, "error type" => ""));

// returns an array of emotion labels and their values
function get_values($labels_list, $error_list, $base_vals, $k) {
    $results = $labels_list;
    $labels = $labels_list;
    shuffle($labels_list);
    foreach ($labels_list as $label) {    
        // selecting a random error level to assign to emotion label (ex. ideal, very accurate, etc.)
        reset($error_list);
        $error = key($error_list);

        $change = mt_rand(0, 9);

        $newresult = $base_vals[$error];

        $change_minus = array_rand($newresult);

        //echo json_encode($change_minus);
        // skips percent error change leads to negative values
        if ($newresult[$change_minus] - $change > 0) {
            $newresult[$change_minus] = $newresult[$change_minus] - $change;
            $change_add = array_rand(($newresult));
            $newresult[$change_add] = $newresult[$change_add] + $change;
        } 

        //adding jitter
        for ($i = 0; $i < $k; $i++) {
            $pairs = $newresult;
            $triangle1 = array_rand($pairs);
            unset($pairs[$triangle1]);
            $triangle2 = array_rand($pairs);

            // if triangle 1's value is 0, skip pair
            if ($newresult[$triangle1] === 0) {
                $i--;
            } else {
               $newresult[$triangle1] = $newresult[$triangle1] - 1;
               $newresult[$triangle2] = $newresult[$triangle2] + 1;
            }
        }
        $results[$label] = $newresult;

    $error_list[$error] = $error_list[$error] - 1;
    if ($error_list[$error] === 0) {
        unset($error_list[$error]);
    }
        
    } 
    $return = array();
    foreach ($labels as $item) {
        $return[$item] = $results[$item];
    }
    return $return;
}
?>