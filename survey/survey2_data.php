<?php

// emotion labels  
$labels28 = array("acceptance", "admiration", "agreement", "amazement", "amusement", "anger", "annoyance", "anticipation", "apologetic", "apprehension", "boredom", "confusion", "considering", "disagreement",
                "disappointment", "disbelief", "disgust", "distraction", "ecstasy", "embarrassment", "excitement", "fear", "frustration", "gratitude", "grief", "happiness", "impatience", "interest");

// setting bases for each error type
$bases = array(
    "70-80" => array(
            "uphill" => array("FTT" => 0, "TTT" => 25, "TFT" => 15, "TTF" => 10, "FFT" => 10, "FTF" => 15, "FFF" => 25, "TFF" => 0),
            "downhill" => array("FTT" => 10, "TTT" => 35, "TFT" => 5, "TTF" => 0, "FFT" => 0, "FTF" => 5, "FFF" => 35, "TFF" => 10)
        ),
    "50-40" => array("FTT" => 25, "TTT" => 20, "TFT" => 0, "TTF" => 5, "FFT" => 5, "FTF" => 0, "FFF" => 20, "TFF" => 25),
    "50-80"=> array(
            "uphill" => array("FTT" => 0, "TTT" => 20, "TFT" => 20, "TTF" => 5, "FFT" => 5, "FTF" => 20, "FFF" => 20, "TFF" => 0),
            "downhill" => array("FTT" => 10, "TTT" => 25, "TFT" => 15, "TTF" => 0, "FFT" => 0, "FTF" => 15, "FFF" => 25, "TFF" => 10)
        )
);

// proportions for each error type
$bowties = array (
    "70-80" => 12,
    "50-40" => 3,
    "50-80" => 13
);

$values = get_values($labels28, $bowties, $bases, 10);
echo json_encode(array("task" => $_GET["task"], "values" => $values));

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
        
        $newresult;
        if ($error == "50-40") {
             $newresult = $base_vals[$error];
        } else {
            $type = array_rand($base_vals[$error]);
            $newresult = $base_vals[$error][$type];
        }
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