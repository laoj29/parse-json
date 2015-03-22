<?php

class ParseNode {

	// constructor of ParseNode class
	public function __construct($filename, $params) {
		if (isset($filename) && !empty($filename)) {
			$this->_file = $filename;
		}

		if (isset($params['key']) && !empty($params['key'])) {
			$this->_key = $params['key'];
		}

		if (isset($params['value']) && !empty($params['value'])) {
			$this->_value = $params['value'];
		}

		// number of nodes with type "Manual"
		$this->_count = 0;
	}

	// get json data from file
	public function getJson() {
		$retarr = array('success' => false, 'result' => NULL);

		if (isset($this->_file)) {
			$str = "";

			$lines = file($this->_file);
			// $lines = json_decode(json_encode($lines));

			foreach ($lines as $line) {
				$str .= trim($line);
			}

			$data = json_decode($str);

			$retarr['success'] = true;
			$retarr['result'] = $data;
		} else {
			$retarr['success'] = false;
			$retarr['result'] = "File error!";
		}

		return $retarr;
	}

	// find and print node id if node type is "Manual"
	public function findIdByType($data) {
		if (isset($this->_key) && isset($this->_value)) {
			if (sizeof($data) != 0) {
				foreach ($data as $key => $value) {
					if ($key == $this->_key && $value == $this->_value) {
						// echo "Bingo" . "<br>";
						$this->_count += 1;
						echo "Node ID: " . $data->node_id . "<br>";
					}

					if ($key == "children" && sizeof($data->children) != 0) {
						// echo "Continue" . "<br>";
						$children = $data->children;

						for ($i = 0; $i < sizeof($children); $i++) {
							$this->findIdByType($children[$i]);
						}
					}
				}
			}
		}
	}

}

?>