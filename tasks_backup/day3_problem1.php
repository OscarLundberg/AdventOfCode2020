//Generated on 07-12-20 06:45
//Input exposed via the $input variable
function is_tree($inp, $a, $b){
  return $inp[$b][$a] == "#";
}
$x = 0;
$y = 0;
$effective_x = 0;
$counter = 0;
$dbg = "";
while($y < count($input)){
  $dbg .= "<br>		$y	-	";
  foreach(str_split($input[$y]) as $ind => $ch){
	if($ind == $effective_x){
	    if(is_tree($input, $effective_x, $y)){
			$dbg .= "<mark>X</mark>";  	
		  	$counter++;
  		}else{
			$dbg .= "<mark>O</mark>";
		}
	}else {
		$dbg .= $ch;
	}
  }
  
  $dbg .= "  -  $effective_x / " . strlen($input[$y]);
  $x += 3;
  $y += 1;
  $effective_x = $x % (strlen($input[0]) - 1);
}
 debug("$counter trees.\n\n$dbg");
return $counter;
