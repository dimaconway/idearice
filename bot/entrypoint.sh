#!/usr/bin/env bash

printenv | grep "BOT_TOKEN" > ${APP_ROOT}/env.sh
printenv | grep "CHAT_ID" >> ${APP_ROOT}/env.sh
printenv | grep "APP_ROOT" >> ${APP_ROOT}/env.sh


echo '['`date`']' 'Container set' >> /var/log/cron.log
cron
tail -f /var/log/cron.log
