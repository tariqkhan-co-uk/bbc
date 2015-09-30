<?php
################################################################################
# Feature: Recipe Item											               #
################################################################################
class DataItem {
	// Object vars: self explanatory
	public 	$id				= false;
	public 	$name			= false;
	public 	$image			= false;
	public 	$cookingtime	= false;
	public 	$ingredients	= false;
	public	$error			= true;
	private $data			= false;

	// Class constructor
	public function __construct($data) {
		$this->data = $data; // Recipe data
		$this->id = (int)$_GET['id']; // Get item id from url... I would normally ensure XXS does not happen
		if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
			$this->getData($_GET['id']);
		}
	}

	private function getData($id) {
		$imgExt = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
		foreach($this->data as $record) { // Iterate each record of data
			if($record->id == $id) { // If parsed ID matches record ID save record data as object vars
				$this->id = $record->id;
				$this->name = $record->name;
				$img = 'images/recipes/'.str_replace(' ', '_', strtolower($record->name)).'.'; // Construct img url
				foreach($imgExt as $ext) { // Identify if image exists for item checking possible file extensions
					if(file_exists($img.$ext)) {
						$this->image = $img.$ext; // Found image
						break; // No need for anymore iterations
					}
				}
				$this->cookingtime = $record->cookingtime;
				foreach($record->ingredients->item as $item) { // Get ingredients, quanity and measurement
					$measure = '';
					if($item->attributes()[0]) {
						$measure = $item->attributes()[0].' '.($item->attributes()[1] ? $item->attributes()[1].' ' : 'x ');
					}
					$this->ingredients .= '<li>'.$measure.$item.'</li>';
				}
				$this->error = false;
				break; // No need for anymore iterations
			}
		}
	}
}
?>
