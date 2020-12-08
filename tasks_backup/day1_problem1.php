$len = count($input);
sort($input);
$l_index = 0;
$r_index = $len - 1;

$target = 2020;
while($l_index < $r_index){
  $left = $input[$l_index];
  $right = $input[$r_index];
  $val = $left + $right;
  if($val == $target){
    return $left * $right;
  }else if($val < $target){
    $l_index += 1;
  }
  else if($val > $target){
    $r_index -= 1;
  }
}

return null;