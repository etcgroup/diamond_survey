<?php

// emotion labels  
$labels15 = array("interest", "amusement", "considering", "agreement", "annoyance", "confusion", "acceptance", "apprehension", "frustration", "supportive", "surprise", "anticipation", "tired", "trust", "vigilance");

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
            "uphill" => array("FTT" => 5, "TTT" => 20, "TFT" => 20, "TTF" => 5, "FFT" => 5, "FTF" => 20, "FFF" => 20, "TFF" => 5),
            "downhill" => array("FTT" => 10, "TTT" => 25, "TFT" => 15, "TTF" => 0, "FFT" => 0, "FTF" => 15, "FFF" => 25, "TFF" => 10)
        )
);

$task1 = array (
    "70-80" => 10,
    "50-40" => 1,
    "50-80" => 4
);

if(isset($_GET['seed'])) 
	mt_srand($_GET['seed']);
$values = get_values($labels15, $task1, $bases, 10);

echo json_encode($values);

//echo json_encode(array("label count" => 10, "error type" => ""));

// returns an array of emotion labels and their values
function get_values($labels_list, $error_list, $base_vals, $k) {
    $results = $labels_list;
    $labels = $labels_list;
    foreach ($labels_list as $label) {    
        // selecting a random error level to assign to emotion label (ex. ideal, very accurate, etc.)
        reset($error_list);
        $error = key($error_list);

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