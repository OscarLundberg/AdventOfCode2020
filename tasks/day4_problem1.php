function validate($passport){
  $fields = ["byr", "iyr", "eyr", "hgt", "hcl", "ecl", "pid"];

  foreach($fields as $field){
	$includes = strpos(" $passport", $field);
	$len = count(preg_split('/\n| /', $passport)) -1;
	if(!$includes){
		debug("$len fields. $field - $passport -> " . ($includes ? 'true' : 'false'));   
		return false;
	}
  }
  return true;
}

//$passports = array();
$passports = 0;
$activePassport = "";
$valid = true;
foreach($input as $line){ 
	if(strlen($line) <= 2){
		if(validate($activePassport)){
		  	$passports++;
		}	
	  	$activePassport = "";
	}else{	
		$activePassport .= $line;  	
	}
}

if(validate($activePassport)){
  $passports++;
}	

return $passports;