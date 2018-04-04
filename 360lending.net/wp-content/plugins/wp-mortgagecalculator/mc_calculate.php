<?php
$noy = $_GET['noy'];
$principal = $_GET['principal'];
$interest = $_GET['interest'];

$a = str_replace(',','',$principal) ;
$t_years = $noy*12;
$t_interest = $interest/1200;
$t = (1.0 /(pow((1+$t_interest),$t_years)));

if($t < 1){ 
   $payment = (($a*$t_interest)/(1-$t));
} else { 
   //$payment = $a/$t_years; 
} 

$total = round($payment,2); 


$html = 'Your <span class="key">Monthly Payment</span> for <span class="hot">'.$noy.'</span> <span class="key">Years</span> at an <span class="key">Interest Rate</span> of <span class="hot">'.$interest.'%</span> for a <span class="key">Loan Amount</span> of <span class="hot">$'.$principal.'</span> is <span class="hot">$'.$total.'</span> a <span class="key">Month</span>';

echo $html;
?>
