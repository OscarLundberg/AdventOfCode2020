//Generated on 07-12-20 07:50
//Input exposed via the $input variable
function is_tree($inp, $a, $b){
  return $inp[$b][$a] == "#";
}

function slope_tree_count($horizontal, $vertical) {
  $input = $GLOBALS['input'];
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
			  $counter++;
		  }
	  }else {
		  $dbg .= $ch;
	  }
	}
	$x += $horizontal;
	$y += $vertical;
	$effective_x = $x % (strlen($input[0]) - 1);
  }
  return $counter;
}

$a = slope_tree_count(1, 1);
$b = slope_tree_count(3, 1);
$c = slope_tree_count(5, 1);
$d = slope_tree_count(7, 1);
$e = slope_tree_count(1, 2);

debug("$a - $b - $c - $d - $e");

return $a * $b * $c * $d * $e;

