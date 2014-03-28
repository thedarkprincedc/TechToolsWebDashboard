<?php
	$header_str = "/([\w]+).{/";
	$element_str = "/[A-Za-z_0-9]*={1}[A-Za-z_0-9!,.%;= -:]*/";
	$footer_str = "/}/";
	$trim_str = " \t\r\n";
	
	$handle = @fopen("../status.dat", "r");
	if ($handle) {
		$block = null;
		$title = null;
		$lastTitle = null;
		$count = 0;
		$total = array();
		while( ($buffer = fgets($handle, 4096)) !== false){
			if($buffer[0] == ' '||$buffer[0] == '#')	
				continue;
			$buffer = trim($buffer, $trim_str);
			if( preg_match($header_str, $buffer) == 1)
			{
				$title=explode(' ', $buffer);
				$inner = array();
			}
			if( preg_match($element_str, $buffer) == 1)
			{
				$element = explode('=', $buffer);
				$inner[$title[0]][$element[0]] = $element[1];
			}
			if( preg_match($footer_str, $buffer) == 1)
			{
				$block[]=$inner;
				$inner = null;
				$lastTitle = $title[0];
				continue;
			}
			
		}	
		echo json_encode($block, JSON_PRETTY_PRINT);
		if (!feof($handle)) {
			echo "Error: unexpected fgets() fail\n";
		}
		fclose($handle);
	}
?>