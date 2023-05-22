<?php
/**
  * Lucky red packets
  *
  * @param int $totalBonus The total amount of red envelopes <For accuracy, the unit is used here>
  * @param int $bonusSize number of red packets
  * @return array
  */
function randBonus($totalBonus, $bonusSize) {
     if ($totalBonus < 1) {
         die('The total amount of red envelopes should not be less than 1 cent').PHP_EOL;
     }
     if ($bonusSize < 1) {
         die('The number of red packets must not be less than 1').PHP_EOL;
     }
     if ($totalBonus < $bonusSize) {
         die('The amount of the red envelope is not enough, it does not meet the requirements of the lucky red envelope!').PHP_EOL;
     }
     $remainBonus = $totalBonus; // The remaining amount of red packets that can be distributed
     $iCount = 0;
     $divisions = [];
     $min = 1; // use 1 for random minimum
     while ($iCount < $bonusSize) {
         if ($iCount < $bonusSize - 1) {
             $restSize = $bonusSize - $iCount;
             $max = bcdiv($remainBonus, $restSize)*2; // The random maximum value uses 2 times the average value of the undistributed amount
             $randCent = $min;
             if (($remainBonus > $restSize*$min) && $max > $min ) {
                 $randCent = mt_rand($min, $max); // random amount range
                 while ($randCent == $remainBonus) {
                     $randCent = mt_rand($min, $max);
                 }
             }
             $divisions[] = $randCent;
             $remainBonus -= $randCent;
             echo 'max:'.$max.',iCount:'.$iCount.',randCent:'.$randCent.',remainBonus:'.$remainBonus.PHP_EOL;
         } else {
             $divisions[] = $remainBonus;
             echo 'max:null,iCount:'.$iCount.',randCent:'.$remainBonus.',remainBonus:0'.PHP_EOL;
         }
         $iCount++;
     }
     return $divisions;
}
$totalBonus = 16;
$bonusSize = 10;
// 0.16 yuan for 10 people
$ret = randBonus($totalBonus, $bonusSize);
$total = array_sum($ret);
echo 'Total amount of red envelopes: '.$total.' points,'.'Total number of red envelopes: '.$bonusSize.' points'.PHP_EOL;
echo 'Lucky red envelope collection details:'.implode(',', $ret).PHP_EOL;