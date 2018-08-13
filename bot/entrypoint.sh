#!/usr/bin/env bash

printenv | grep "BOT_TOKEN" > /app/env.sh
printenv | grep "CHAT_ID" >> /app/env.sh
printenv | grep "PATH_TO_USED_WALLPAPERS_DIRECTORY" >> /app/env.sh
printenv | grep "USED_WALLPAPERS_FILENAME" >> /app/env.sh



echo '['`date +%Y-%m-%dT%H:%M:%S.%6N%:z`']' 'Container set' >> /var/log/cron.log
cron
tail -f /var/log/cron.log
