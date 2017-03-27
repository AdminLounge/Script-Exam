<?php

class UnknownShebangException extends RuntimeException {
	
	public function __construct($shebang) {
		return parent::__construct("Unknown Shebang $shebang");
	}
}

class NoImplementationFoundException extends RuntimeException {
	
	public function __construct($shebang, $fileTried) {
		return parent::__construct("No implementation found for \"$shebang\". Tried: $fileTried");
	}
}

class NoShebangException extends RuntimeException {

	public function __construct($firstLine) {
		if (strlen($firstLine) > 20)
			$firstLine = substr($firstLine, 0, 20) . "...";
		return parent::__construct("This is no shebang: $firstLine");
	}
}