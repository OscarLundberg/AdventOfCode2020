//Generated on 07-12-20 06:28
//Input exposed via the $input variable

function validate($line){
	$parts = explode(":", $line);
	$policy = explode(" ", $parts[0]);
	$vals = explode("-", $policy[0]);
	$low = $vals[0] - 1;
	$high = $vals[1] - 1;
	$char = $policy[1];
  	$pw = str_replace(" ", "", $parts[1]);
	//if($high > strlen($pw)){
		//debug($line . " $high = " . $pw[$high] . ", $low = " . $pw[$low] ); 
 	$a = $pw[$low] == $char; 
  	$b = $pw[$high] == $char;
  	
  	return $a xor $b;
}


$counter = 0;
foreach($input as $pass){
	if(validate($pass)){
  		$counter += 1;
  	}
}

return $counter;