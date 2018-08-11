#!/usr/bin/env bash

printenv | grep "BOT_TOKEN" > /app/env.sh
printenv | grep "CHAT_ID" >> /app/env.sh


echo '['`date`']' 'Container set' >> /var/log/cron.log
cron
tail -f /var/log/cron.log
