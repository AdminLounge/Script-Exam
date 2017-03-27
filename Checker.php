<?php

require_once __DIR__.'/Implementation.php';
require_once __DIR__.'/exceptions.php';

class Checker {
	private static $knownShebangs = [ 
			"#!/bin/bash" 
	];

	public static function startsWith($string, $prefix) {
		$length = strlen ( $prefix );
		return (substr ( $string, 0, $length ) === $prefix);
	}

	public static function endsWith($string, $suffix) {
		$length = strlen ( $suffix );
		if ($length == 0) {
			return true;
		}
		return (substr ( $string, - $length ) === $suffix);
	}
	
	public function examFile($file, $performActualChecks = true) {
		$content = file_get_contents ( $file );
		$shebang = strtok($content, "\n");
		
		if (!Checker::startsWith($shebang, "#!"))
			throw new NoShebangException($shebang);
		
		if (!in_array($shebang, Checker::$knownShebangs))
			throw new UnknownShebangException($shebang);
		
		$implFileName = __DIR__ . "/" . str_replace('/', '_', substr($shebang, 2)) . ".php";
		
		if (!file_exists($implFileName))
			throw new NoImplementationFoundException($shebang, $implFileName);
			
		if ($performActualChecks)
			return $this->invokeImpl(require $implFileName, $content);
		else 
			return true;
	}
	
	private function invokeImpl(Implementation $impl, $content) {
		return $impl->check($content);
	}
}