<?php
################################################################################
# Feature: Recipe List											               #
################################################################################
class DataList {
	// Object vars
	public 	$count	= false; // Data record count
	private $data	= false; // Object to contain recipe data
	private $list	= array();

	// Class constructor
	public function __construct($data) {
		$this->data = $data; // Recipe data
		$this->count = count($this->data);
		$this->getData();
	}

	// Get data using query string searching parsed field
	private function getData() {
		if($this->count >= 1) { // If 1 or more records...
			$i = 0;
			$list_item = '';
			foreach($this->data as $record) { // Iterate each record of data
				$i++;
				$list_item .= '<li id="'.$record->id.'">'; // Assign ID attribute to the opening list item containing record ID
				$list_item .= '<h2><a href="?page=item&amp;id='.$record->id.'">'.$record->name.'</a></h2>'; // Display recipe name as heading and a link to the recipe page (would normally use recipe name for friendly urls and seo)
				$list_item .= '<p><em>Cooking time: '.$record->cookingtime.'</em></p>'; // Display emphsised cooking time
				$ingredients = '';
				foreach($record->ingredients->item as $item) {
					$ingredients .= $item.', ';
				}
				$list_item .= '<p>Ingredients: '.trim($ingredients, ', ').'</p>'; // Display ingredients as paragraph
				$list_item .= '</li>'; // Close the list item
				if($i == 10) { // Simple pagination (good thing I didnt use a database lol)
					$this->list[] = $list_item;
					$list_item = '';
				} elseif($i == $this->count) {
					$this->list[] = $list_item;
					$list_item = '';
				}
			}
		}
	}

	public function showData() {
		$recordset = 0;
		if(!empty($_GET['recordset']) && ctype_digit($_GET['recordset']) && $_GET['recordset'] > 0) {
			$recordset = (int)$_GET['recordset']-1;
			if($recordset >= count($this->list)) {
				$recordset = 0;
			}
		}
		echo $this->list[$recordset];
	}

	public function showPagination() { // Not doing next/previous page, but easy (i++ or i--)
		$recordset = count($this->list);
		if($recordset > 1) {
			echo '<ul class="pagination">';
			echo '<li><a href="?page=list&amp;recordset=1">First page</a></li>';
			for($i=1; $i <= $recordset ; $i++) {
				echo '<li><a href="?page=list&amp;recordset='.$i.'">Page '.$i.'</a></li>';
			}
			echo '<li><a href="?page=list&amp;recordset='.$recordset.'">Last page</a></li>';
			echo '</ul>';
		}
	}
}
?>
