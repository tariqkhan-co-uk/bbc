<?php
################################################################################
# Feature: Star       											               #
################################################################################
/*
I'm not building user access control so lets use JSON serialising?!?!
Besides... this has better performance!
*/
class Star {
	public $json = array();
	private $data = false;
	// Class constructor
	public function __construct($data) {
		$this->data = $data;
		if(file_exists('stars.json')) {
			$this->json = json_decode(file_get_contents('stars.json'), true);
		}
		if(!empty($_GET['star']) && ctype_digit($_GET['star'])) {
			$this->saveStar((int)$_GET['star']);
		}
		if(!empty($_GET['unstar']) && ctype_digit($_GET['unstar'])) {
			$this->deleteStar((int)$_GET['unstar']);
		}
	}
	private function saveStar($id) {
		$this->json[$id] = 1;
		if(file_exists('stars.json')) {
			unlink('stars.json');
		}
		file_put_contents('stars.json', json_encode($this->json));
	}
	private function deleteStar($id) {
		unset($this->json[$id]);
		if(file_exists('stars.json')) {
			unlink('stars.json');
		}
		file_put_contents('stars.json', json_encode($this->json));
	}
	// Get data using query string searching parsed field
	private function getData($id) {
		foreach($this->data as $record) { // Search each record of data
			if($record->id == $id) { // If query string (case-insensitive exists in data field)
				$this->result[(int)$record->id] = $record; // Create array of results avoiding duplicate records
			}
		}
	}
	// Show data as list element
	public function showData() {
		foreach($this->json as $key => $value) {
			$this->getData($key);
		}
		foreach($this->result as $record) {
			echo '<li><a href="?page=item&amp;id='.$record->id.'">'.$record->name.'</a></li>';
		}
	}
}
?>
