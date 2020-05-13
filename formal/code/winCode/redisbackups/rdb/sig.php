<?php
// 安装信号
pcntl_signal(SIGUSR1, "sig_handler");
function sig_handler($sig){
    sleep(2);
    echo "这是测试信号的一个测试类\n";
}
// 是一个安装信号的操作
// pid -》 进程pid ， 要设置信号
// 根据进程设置信号
// posix_getpid获取进程id的
posix_kill(posix_getpid(), SIGUSR1);

echo "其他事情\n";
// 分发
pcntl_signal_dispatch();
// 信号是配合与多进程使用
// posix_getpid =》 只会针对于当前的进程去设置信号
