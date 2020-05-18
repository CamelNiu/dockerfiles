<?php

// 3个子进程处理任务
for ($i = 0; $i < 10; $i++){

    $gid = posix_getpid();
    var_dump('gid'.$gid);

    var_dump($gid);

    $pid = pcntl_fork();


    if ($pid == -1) {

    } elseif ($pid) {



    } else {// 子进程处理

      //var_dump($i);
        sleep(3);

      exit();

    }


}

where(true)