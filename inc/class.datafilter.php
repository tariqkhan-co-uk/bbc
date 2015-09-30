<?php
################################################################################
# Feature: Filter recipes											           #
################################################################################
class DataFilter {
	// Object vars
	public	$error	= false; // Boolean to flag if filter contains an error
	public	$result = false; // Array of filter results data
	private $data	= false; // Object to contain recipe data
	private	$msg	= false; // Array of form input messages

	// Class constructor
	public function __construct($data) {
		$this->data = $data; // Recipe data
		if(!empty($_POST['filter'])) { // If filter form submitted
			$this->validate(); // Validate post data
		}
	}

	// Validate form fields (would normally use regx, but ctype works for this)
	private function validate() {
		$fields = array( // Array of expected fields and its error message and expected data type
			'name' => array(
				'error' => 'Name must only contain letters.',
				'input'	=> 'alpha'
			),
			'ingredients' => array(
				'error' => 'Ingredient must only contain letters.',
				'input'	=> 'alpha'
			),
			'cookingtime' => array(
				'error' => 'Cooking time contains an invalid selection.',
				'input'	=> 'digit'
			)
		);
		foreach($fields as $key => $array) { // For every field...
			if(!empty($_POST[$key])) { // If field is not empty
				if(($array['input'] == 'alpha' && !ctype_alpha($_POST[$key])) || ($array['input'] == 'digit' && !ctype_digit($_POST[$key]))) { // If invalid data type
					$this->error = true; // Flag error
					$this->msg[$key] = $array['error']; // Assign input field with an error message
				} else { // Valid input
					$this->getData($key, trim($_POST[$key])); // Attempt to retrieve data
				}
			}
		}
	}

	// Get data using query string searching in parsed field
	private function getData($field, $query) {
		foreach($this->data as $record) { // Search each record of data
			if(stripos($record->$field, $query) !== false) { // If query string (case-insensitive exists in data field)
				$this->result[(int)$record->id] = $record; // Create array of results avoiding duplicate records
			}
		}
	}

	// Show data as list element
	public function showData() {
		foreach($this->result as $record) {
			echo '<li><a href="?page=item&amp;id='.$record->id.'">'.$record->name.'</a></li>';
		}
	}

	// Display input error message if exists
	// I would also normally remember input values for the user, but you have not asked for this
	public function msg($field) {
		if(!empty($this->msg[$field])) {
			echo '<p class="error_inline">'.$this->msg[$field].'</p>';
		}
	}
}
?>
