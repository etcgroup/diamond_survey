<?php

// emotion labels  
$labels15 = array("interest", "amusement", "considering", "agreement", "annoyance", "confusion", "acceptance", "apprehension", "frustration", "supportive", "surprise", "anticipation", "tired", "trust", "vigilance");
$labels42 = array("acceptance", "admiration", "agreement", "amazement", "amusement", "anger", "annoyance", "anticipation", "apologetic", "apprehension", "boredom", "confusion", "considering", "disagreement", "disappointment", "disbelief", "disgust", "distraction", "ecstasy", "embarrassment", "excitement", "fear", "frustration", "gratitude", "grief", "happiness", "impatience", "interest", "joy", "loathing", "pensiveness", "pride", "rage", "relief", "sadness", "serenity", "supportive", "surprise", "terror", "tired", "trust", "vigilance");

// setting bases for each error type
$bases = array(
    "70-80" => array(
            "uphill" => array("FTT" => 0, "TTT" => 25, "TFT" => 15, "TTF" => 10, "FFT" => 10, "FTF" => 15, "FFF" => 25, "TFF" => 0),
            "downhill" => array("FTT" => 10, "TTT" => 35, "TFT" => 5, "TTF" => 0, "FFT" => 0, "FTF" => 5, "FFF" => 35, "TFF" => 10)
        ),
    "50-40" => array(
			"NA" => array("FTT" => 25, "TTT" => 20, "TFT" => 0, "TTF" => 5, "FFT" => 5, "FTF" => 0, "FFF" => 20, "TFF" => 25)
		),
    "50-80"=> array(
            "uphill" => array("FTT" => 0, "TTT" => 20, "TFT" => 20, "TTF" => 5, "FFT" => 5, "FTF" => 20, "FFF" => 20, "TFF" => 0),
            "downhill" => array("FTT" => 10, "TTT" => 25, "TFT" => 15, "TTF" => 0, "FFT" => 0, "FTF" => 15, "FFF" => 25, "TFF" => 10)
        )
);

$task1 = array (
    "70-80" => 10,
    "50-40" => 1,
    "50-80" => 4
);

$task2 = array (
    "70-80" => 5,
    "50-40" => 2,
    "50-80" => 5
);

$task3 = array (
    "70-80" => 18,
    "50-40" => 5,
    "50-80" => 19
);

$task4 = array (
    "70-80" => 18,
    "50-40" => 6,
    "50-80" => 18
);

$values = null;
	
//$cases = array ($ideal, $auto, $current, $accurate);
//$selection = array_rand($cases);
/*        
switch($_GET["task"]){
    case 1: $values = get_values($labels12, $task1, $bases, 10); break;
    case 2: $values = get_values($labels12, $task2, $bases, 10); break;
    case 3: $values = get_values($labels42, $task3, $bases, 10); break;
    default: 
}*/
if(isset($_GET['seed'])) 
	mt_srand($_GET['seed']);
$values = get_values($labels15, $task1, $bases, 10);

echo json_encode($values);

//echo json_encode(array("label count" => 10, "error type" => ""));

// returns an array of emotion labels and their values
function get_values($labels_list, $error_list, $base_vals, $k) {
    $results = $labels_list;
    $labels = $labels_list;
  //  shuffle($labels_list);
    foreach ($labels_list as $label) {    
        // selecting a random error level to assign to emotion label (ex. ideal, very accurate, etc.)
        
        reset($error_list);
        $error = key($error_list);

        $change = mt_rand(0, 9);

		$types = array_keys($base_vals[$error]);
		$type = $types[mt_rand(0, count($types)-1)];
        $newresult = $base_vals[$error][$type];
		$regions = array_keys($newresult);
		
        //adding jitter
        for ($i = 0; $i < $k; $i++) {
			$first = mt_rand(0, count($regions)-1);
			while($newresult[$regions[$first]]==0){
				$first = mt_rand(0, count($regions)-1);
			}
			$second = $first;
			while($second == $first){
				$second = mt_rand(0, count($regions)-1);
			}
		    $newresult[$regions[$first]]--;
 		    $newresult[$regions[$second]]++;
        }

        $dict["data"] = $newresult;
        $dict["type"] = $error;
        $dict["hill"] = $type;
		
        $results[$label] = $dict;

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