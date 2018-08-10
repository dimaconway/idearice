#!/usr/bin/env bash

source /app/env.sh

echo '['`date`'] Bot start'

php -f ${APP_ROOT}/main.php ${BOT_TOKEN} ${CHAT_ID}

echo '['`date`'] Bot finish'
