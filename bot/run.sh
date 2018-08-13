#!/usr/bin/env bash

source /app/env.sh

echo '['`date`'] Bot start'

php -f /app/main.php \
    ${BOT_TOKEN} \
    ${CHAT_ID} \
    ${PATH_TO_USED_WALLPAPERS_DIRECTORY}/${USED_WALLPAPERS_FILENAME}

echo '['`date`'] Bot finish'
