#!/bin/bash
#redis重写aof文件
msg=`redis-cli bgrewriteaof`
#redis状态
res=`redis-cli  info persistence | grep aof_rewrite_in_progress | awk -F ":" '{print $2}'`


while [ `echo $res` -eq "1" ];
do
  res=`redis-cli  info persistence | grep aof_rewrite_in_progress | awk -F ":" '{print $2}'`

  echo $res

done
