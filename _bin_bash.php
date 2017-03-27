<?php

require_once __DIR__.'/Implementation.php'; 

class BashImplementation implements Implementation {
	
	public function check($content) {
		$report = new Report();
		$bad_var_pregexpr = "@^([^#]*;)?[[:space:]]*(((.*[({\\[])?[[:space:]]*\\$)|\\.|source|.*exec)@mi";
		$m = [ ];
		if (preg_match_all ( $bad_var_pregexpr, $content, $m )) {
			// Bad var detected
			$report->error("$file: bad variable detected");
		}
		return $report;
	}
	
}

return new BashImplementation();
