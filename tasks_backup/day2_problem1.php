//Generated on 06-12-20 22:08
//Input exposed via the $input variable
function validate($line){
	$parts = explode(":", $line);
	$policy = explode(" ", $parts[0]);
	$vals = explode("-", $policy[0]);
	$low = $vals[0];
	$high = $vals[1];
	$char = $policy[1];
  	$pw = str_replace(" ", "", $parts[1]);
	$result = substr_count($pw, $char);
  	if ((int)$result >= (int)$low && (int)$result <= (int)$high){
		return true;
	}
  	return FALSE;
}


$counter = 0;
foreach($input as $pass){
	if(validate($pass)){
  		$counter += 1;
  	}
}

return $counter;