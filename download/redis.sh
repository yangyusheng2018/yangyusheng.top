#!/bin/bash
domain=$(sed -n 1p /home/api/config.txt)
echo $domain
pppp=${domain:1}
pppp1=/goredis.php
echo ${pppp}${pppp1}
curl ${pppp}${pppp1} #调用链接
exit 0