#:/bin/bash
function getProcess()
{
    res=`ps -aux | grep -v 'grep' | awk 'NR>2{print $2}'`

    for i in $res
    do
        `kill -9 $i`
    done
}

getProcess