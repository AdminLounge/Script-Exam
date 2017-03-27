<?php
class Report {
	private $log = [ ];
	private $errorlog = [ ];
	private $state = "success";

	public function info($message) {
		$this->log [] = $message;
	}

	public function error($message) {
		info ( $message );
		$this->errorlog [] = $message;
		$this->state = "failure";
	}

	public function getLog() {
		return $this->log;
	}

	public function getErrorLog() {
		return $this->errorlog;
	}

	public function isSuccessful() {
		return $this->state == "success";
	}
}
interface Implementation {

	/**
	 * Examine the content of the given file.
	 * 
	 * @param string $content
	 *        	The content to perform the checks on.
	 * @return Report A Report object that represents the result of the examination
	 */
	public function check($content);
}