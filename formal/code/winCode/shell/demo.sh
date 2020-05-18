#!/bin/bash
#redis重写aof文件
`redis-cli bgrewriteaof`
#redis状态
res=$(redis-cli  info persistence | awk '{FS=":"}{print $1 "\t" $2}'| grep aof_rewrite_in_progress | awk '{print $2}')

echo "$res"



