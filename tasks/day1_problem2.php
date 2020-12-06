$target = 2020;

foreach($input as $a) {
  foreach($input as $b) {
    foreach($input as $c) {
 		if(($a + $b + $c) === $target){
          return $a * $b * $c;
        }
    }
  }
}

return null;