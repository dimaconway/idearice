#!/usr/bin/env bash

if [ ! -f .env ]; then
    echo "ERROR: .env file not found"
    exit 1
fi

source .env

php -f src/main.php ${BOT_TOKEN} ${CHAT_ID}
