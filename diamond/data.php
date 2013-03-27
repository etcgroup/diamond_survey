<?php

// emotion labels  
$labels12 = array("interest", "amusement", "considering", "agreement", "annoyance", "confusion", "acceptance", "apprehension", "frustration", "supportive", "surprise", "anticipation");
$labels42 = array("acceptance", "admiration", "agreement", "amazement", "amusement", "anger", "annoyance", "anticipation", "apologetic", "apprehension", "boredom", "confusion", "considering", "disagreement",
                "disappointment", "disbelief", "disgust", "distraction", "ecstasy", "embarrassment", "excitement", "fear", "frustration", "gratitude", "grief", "happiness", "impatience", "interest", "joy", "loathing",
                "pensiveness", "pride", "rage", "relief", "sadness", "serenity", "supportive", "surprise", "terror", "tired", "trust", "vigilance");

// setting bases for each error type
$bases = array(
    "ideal" => array("FTT" => 0, "TTT" => 50, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 50, "TFF" => 0),
    "very accurate" => array(
        "historic" => array("FTT" => 1, "TTT" => 49, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 50, "TFF" => 0),
        "auto" => array("FTT" => 0, "TTT" => 49, "TFT" => 1, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 50, "TFF" => 0),
        "current" => array("FTT" => 0, "TTT" => 49, "TFT" => 0, "TTF" => 1, "FFT" => 0, "FTF" => 0, "FFF" => 50, "TFF" => 0)
        ),
    "moderately accurate" => array(
        "historic" => array("FTT" => 5, "TTT" => 45, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 45, "TFF" => 5),
        "auto" => array("FTT" => 0, "TTT" => 45, "TFT" => 5, "TTF" => 0, "FFT" => 0, "FTF" => 5, "FFF" => 45, "TFF" => 0),
        "current" => array("FTT" => 0, "TTT" => 45, "TFT" => 0, "TTF" => 5, "FFT" => 5, "FTF" => 0, "FFF" => 45, "TFF" => 0)
        ),
    "low accuracy" => array(
        "historic" => array("FTT" => 10, "TTT" => 40, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 40, "TFF" => 10),
        "auto" => array("FTT" => 0, "TTT" => 40, "TFT" => 10, "TTF" => 0, "FFT" => 0, "FTF" => 10, "FFF" => 40, "TFF" => 0),
        "current" => array("FTT" => 0, "TTT" => 40, "TFT" => 0, "TTF" => 10, "FFT" => 10, "FTF" => 0, "FFF" => 40, "TFF" => 0)
        ),
    "very low accuracy" => array(
        "historic" => array("FTT" => 15, "TTT" => 35, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 35, "TFF" => 15),
        "auto" => array("FTT" => 0, "TTT" => 35, "TFT" => 15, "TTF" => 0, "FFT" => 0, "FTF" => 15, "FFF" => 35, "TFF" => 0),
        "current" => array("FTT" => 0, "TTT" => 35, "TFT" => 0, "TTF" => 15, "FFT" => 15, "FTF" => 0, "FFF" => 35, "TFF" => 0)
        ),
    "inaccurate" => array (
        "historic" => array("FTT" => 20, "TTT" => 30, "TFT" => 0, "TTF" => 0, "FFT" => 0, "FTF" => 0, "FFF" => 30, "TFF" => 20),
        "auto" => array("FTT" => 0, "TTT" => 30, "TFT" => 20, "TTF" => 0, "FFT" => 0, "FTF" => 20, "FFF" => 30, "TFF" => 0),
        "current" => array("FTT" => 0, "TTT" => 30, "TFT" => 0, "TTF" => 20, "FFT" => 20, "FTF" => 0, "FFF" => 30, "TFF" => 0)
    )
);

// proportions for each error type
$task1_errors = array(
    "ideal" => 2,
    "very accurate" => 5,
    "moderately accurate" => 3,
    "low accuracy" => 1,
    "inaccurate" => 1
    );

$task2_errors = array (
    "ideal" => 1,
    "very accurate" => 4,
    "moderately accurate" => 3,
    "low accuracy" => 2,
    "very low accuracy" => 1,
    "inaccurate" => 1
    );

$task3_errors = array (
    "ideal" => 5,
    "very accurate" => 20,
    "moderately accurate" => 11,
    "low accuracy" => 5,
    "inaccurate" => 1
    );

$task4_errors = array (
    "ideal" => 5,
    "very accurate" => 15,
    "moderately accurate" => 10,
    "low accuracy" => 6,
    "very low accuracy" => 5,
    "inaccurate" => 1
    );


$scenario = $_GET["task"];
if ($scenario == 1) {
    echo json_encode(get_values($labels12, $task1_errors, $bases, 10));
} elseif ($scenario == 2) {
    echo json_encode(get_values($labels12, $task2_errors, $bases, 10));
} elseif ($scenario == 3) {
    echo json_encode(get_values($labels42, $task3_errors, $bases, 10));
} else {
    echo json_encode(get_values($labels42, $task4_errors, $bases, 10));
}

// returns an array of emotion labels and their values
function get_values($labels_list, $error_list, $base_vals, $k) {
    $results = $labels_list;
    $labels = $labels_list;
    shuffle($labels_list);
    foreach ($labels_list as $label) {    
        // selecting a random error level to assign to emotion label (ex. ideal, very accurate, etc.)
        reset($error_list);
        $error = key($error_list);
        if ($error === "ideal") {
            $results[$label] = $base_vals[$error];
        }else {
            $change = 0;
            if ($error === "very accurate") {
                $change = mt_rand(1, 9);
            } else {   
                $change = mt_rand(0, 9);
            }
            $data_types = $base_vals[$error];
            
            //selecting random error type (ex. historic, auto, current)
            $random_type = array_rand($data_types);
            $newresult = $base_vals[$error][$random_type];
            $change_minus = array_rand($newresult);
            
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
        }
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