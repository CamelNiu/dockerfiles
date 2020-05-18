<?php

ini_set('display_errors', 'On');

    //信号处理需要注册ticks才能生效，这里务必注意
    //PHP5.4以上版本就不再依赖ticks了
    declare(ticks = 1);
    function sig_handler($signo){
        switch ($signo) {
            case SIGUSR1: echo "SIGUSR1\n"; break;
            case SIGUSR2: echo "SIGUSR2\n"; break;
            default:      echo "unknow";    break;
        }
    }
    //安装信号触发器器
    pcntl_signal(SIGUSR1, "sig_handler");
    pcntl_signal(SIGUSR2, "sig_handler");
    //向当前进程发送SIGUSR1信号
    posix_kill(posix_getpid(), SIGUSR1);
    posix_kill(posix_getpid(), SIGUSR2);
    ?>