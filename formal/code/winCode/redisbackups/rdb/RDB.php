<?php
require 'Input.php';

// rdb-save保存方法
function save()
{
    rdbSave();
    call();
}
// save();
// rdb-bgsave保存方法
function bgsave()
{
    $pid = pcntl_fork(); // fork

    //设置一个信号
    pcntl_signal(SIGUSR1, function ($sig){
        Input::info("成功接收到子进程的持久化信息，并且执行完成");
    });

    if ($pid == 0) {
        // 子进程
        rdbSave();
        posix_kill(posix_getpid(), SIGUSR1);
        exit;
    } else {
        // file_put_contents('t.xt','p',8);
        // 父进程
        // var_dump("父进程");
        call();
    }
    // 部署 SIGUSR1 信号到linux系统中
    pcntl_signal_dispatch();
}
bgsave();
// 实际保存rdb文件保存方法
function rdbSave()
{
    Input::info("rdbSave 保存文件  开始");
    sleep(2);// 表示的持久化过程
    Input::info("rdbSave 保存文件  结束");
}
// 其他执行命令
function call()
{
    Input::info("rdbSave 持久化的时候 -》 需要执行的命令");
}
