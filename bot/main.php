<?php
declare (strict_types=1);


namespace IdeaRice;


if (3 !== $argc) {
    echo 'Run it like this:' . PHP_EOL
        . 'php -f ' . basename(__FILE__) . ' <BOT_TOKEN> <CHAT_ID> ' . PHP_EOL;
    die;
}


require_once __DIR__ . '/src/include.php';


[, $botToken, $chatId] = $argv;

foreach (getWallpapers() as $wallpaper) {
    postByUrl(getUrlToPostMobile($wallpaper, $botToken, $chatId));
    postByUrl(getUrlToPostDesktop($wallpaper, $botToken, $chatId));
}
