#!/bin/bash
domain=$(sed -n 1p /home/api/config.txt)
echo $domain
pppp=${domain:1}
pppp1=/registaction.php
step=2 #间隔的秒数，不能大于60
for (( i = 0; i < 55; i=(i+step) ))
do
    curl ${pppp}${pppp1} #调用链接
    sleep $step
done
exit 0