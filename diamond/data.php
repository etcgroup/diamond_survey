<?php

$results = array(
	"anger" => array(
		"TTF" => 30,
		"TFF" => 30,
		"TTT" => 20,
		"FFF" => 20
		),
	"interest" => array(
		"TTT" => 30
		)
	);

echo json_encode($results);

?>