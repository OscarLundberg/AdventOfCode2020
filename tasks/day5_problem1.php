//Generated on 08-12-20 18:31
//Input exposed via the $input variable
function make2Darray($x, $y){
  
  $arr = [];
  for($i=0;$i<$x;$i++) {
	for($j=0;$j<$y;$j++) {	  
		$arr[$i][$j] = "$i-$j";
	}
  }
  return $arr;
}



function half($arr, $dir){
	switch($dir){
	  case "B":
			foreach($arr as &$row){
				$row = half($row, "R");
			}
			return $arr;
		break;	
		
	  case "F": 
			foreach($arr as &$row){
				$row = half($row, "L");
			}
			return $arr;
		break;

	  case "L": 
			return array_slice($arr, 0, count($arr)/2);
		break;
		
	  case "R":
			return array_slice($arr, count($arr)/2);
		break;
		
	}
}

function idOf($str){
	$pass = trim($str);
	$orig = make2DArray(8, 128);
  	foreach(str_split($pass) as $dir){

		$orig = half($orig, $dir);
	}
	$pts = explode("-", $orig[0][0]);
  	return ($pts[1] * 8) + $pts[0];
}


$seatIds = [];
$max = PHP_FLOAT_MIN;
foreach($input as $seat) {
  $id = idOf($seat);
  $max =  $id > $max ? $id : $max;
}

return $max;
// return idOf('FBFBBFFRLR');



// return "<pre>".json_encode(
//   			half(
// 			  make2DArray(4, 4),
// 			  "F"), 
//   JSON_PRETTY_PRINT) . "</pre>";


  