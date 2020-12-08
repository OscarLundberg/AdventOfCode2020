//Generated on 08-12-20 15:43
//Input exposed via the $input variable


// byr (Birth Year) - four digits; at least 1920 and at most 2002.
// iyr (Issue Year) - four digits; at least 2010 and at most 2020.
// eyr (Expiration Year) - four digits; at least 2020 and at most 2030.
// hgt (Height) - a number followed by either cm or in:
// If cm, the number must be at least 150 and at most 193.
// If in, the number must be at least 59 and at most 76.
// hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
// ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
// pid (Passport ID) - a nine-digit number, including leading zeroes.
// cid (Country ID) - ignored, missing or not.

function objectFrom($str){ 
  $props = preg_split('/\n| /', $str);
  foreach($props as &$prop) { $prop = preg_replace('/:/', '":"', $prop); }
  array_pop($props);
  
  $json = '{"' . implode($props, '","') . '"}';
  return (array) json_decode($json); 
  
}

function validate($passportString){
  $passport = objectFrom($passportString);
  
  $fields = [ 
	"byr" => function ($val){
		$intVal = (int)$val;
		return $val >= 1920 && $val <= 2002;
  	}, 
	"iyr" => function ($val){
		$intVal = (int)$val;
	  	return $val >= 2010 && $val <= 2020;
	}, 
	"eyr" => function ($val){
		$intVal = (int)$val;
	  	return $val >= 2020 && $val <= 2030;
	}, 
	"hgt" => function ($val){
	  	if(strpos($val, "cm") != false)
		{
		  	$intV = (int)str_replace("in", "", $val);
		  	return $intV >= 150 && $intV <= 193;
		}else if(strpos($val, "in") != false) {
		  	$intV = (int)str_replace("in", "", $val);
		  	return $intV >= 59 && $intV <= 76;
		}
	  	return preg_match('/^\d+(cm|in)$/', $val);
	},
	"hcl" => function ($val){
	  	return preg_match('/^#[a-f0-9]{6}$/', $val);
	},
	"ecl" => function ($val){
	  	return preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/', $val);
	},
	"pid" => function ($val){
	  	return preg_match('/^\d{9}$/', $val);
	}
];
  foreach($fields as $field=>$val){
  	if(!array_key_exists($field, $passport)){
// 	  debug("$field - " . json_encode($passport));
	  return false;
	}
	else if($val($passport[$field]) == false){ //if(preg_match($val, $passport->$field)){
	  return false;
	}else {
	  debug("$field - $passport[$field]");
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

if(validate($activePassport . " ")){
  $passports++;
}	

// $test = [
// 'eyr:1972 cid:100
// hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926',

// 'iyr:2019
// hcl:#602927 eyr:1967 hgt:170cm
// ecl:grn pid:012533040 byr:1946',

// 'hcl:dab227 iyr:2012
// ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277',

// 'hgt:59cm ecl:zzz
// eyr:2038 hcl:74454a iyr:2023
// pid:3556412378 byr:2007',
  
// 'pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980
// hcl:#623a2f',

// 'eyr:2029 ecl:blu cid:129 byr:1989
// iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm',

// 'hcl:#888785
// hgt:164cm byr:2001 iyr:2015 cid:88
// pid:545766238 ecl:hzl
// eyr:2022',

// 'iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719'
// ];

// foreach($test as $str) 
// {
// 	debug(validate($str) ? 'true' : 'false');
// }
return $passports;