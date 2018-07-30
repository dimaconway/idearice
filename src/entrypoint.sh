#!/usr/bin/env bash

printenv | grep "BOT_TOKEN" >> env.sh
printenv | grep "CHAT_ID" >> env.sh

./run.sh
