<?php
require "./rds.php";

$rds = new rds();

for($i=0;$i<=8;$i++){
  $rds->lpush('niu',$i);
}