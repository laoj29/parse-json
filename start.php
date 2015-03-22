<?php
	
	// ParseNode.php is the core class to parse the node
	require_once "ParseNode.php";

	// define file name to get the data and conditions to loop the data
	$filename = "node.json";
	$params = array(
		'key' => 'type',
		'value' => 'Manual'
	);

	// initialize ParseNode class
	$node = new ParseNode($filename, $params);

	// call getJson function to get the data from file
	$data = $node->getJson();

	// if fail to get data, return false; otherwise loop the data and find required nodes
	if (isset($data['success']) && !$data['success']) {
		var_dump($data['result']);
		return false;
	} else {
		$node->findIdByType($data['result']);
	}

?>