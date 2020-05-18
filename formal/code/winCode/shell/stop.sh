#:/bin/bash
function getProcess()
{
    res=`ps -aux | grep -v 'grep' | grep $1 | awk '{print $2}'`

    for i in $res
    do
        `kill -9 $i`
    done
}

getProcess php-fpm
getProcess nginx
getProcess mysql
getProcess redis