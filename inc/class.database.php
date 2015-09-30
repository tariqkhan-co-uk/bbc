<?php
class Database {
	// Object vars
	public	$data	= false;

	// Class constructor
	public function __construct($file) {
		// Self-explanatory!?!?
		$file = ROOT.$file.'.xml';
		if(!file_exists($file)) {
			die('XML Data file not found!');
		} elseif(!$xml = @simplexml_load_file($file)) {
			die('XML Data file corrupt!');
		} elseif(!$xmlArray = $xml->xpath('//recipes')) {
			die('XML Data has invalid root node!');
		} else {
			$this->data = $xmlArray[0];
		}
	}
}
?>
