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
    echo \var_export($wallpaper, true);
    echo PHP_EOL;
    postByUrl(getUrlToPostMobile($wallpaper, $botToken, $chatId));
    echo PHP_EOL;
    postByUrl(getUrlToPostDesktop($wallpaper, $botToken, $chatId));
    echo PHP_EOL;
}
