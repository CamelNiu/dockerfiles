<?php
$pid = pcntl_fork(); // fork

if ($pid == 0) {
    // 子进程
    var_dump("子进程");
} else {
    // 父进程
    var_dump("父进程");
}


while (true) {
  
}
