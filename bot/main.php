<?php
declare (strict_types=1);


namespace IdeaRice;


if (4 !== $argc) {
    echo 'Run it like this:' . PHP_EOL
        . 'php -f ' . basename(__FILE__)
        . ' BOT_TOKEN CHAT_ID PATH_TO_USED_WALLPAPERS_FILE'
        . PHP_EOL;
    die;
}


require_once __DIR__ . '/src/include.php';


[, $botToken, $chatId, $pathToUsedWallpapersFile] = $argv;

foreach (getWallpapers($pathToUsedWallpapersFile) as $wallpaper) {
    echo \json_encode($wallpaper);
    echo PHP_EOL;
    postByUrl(getUrlToPostMobile($wallpaper, $botToken, $chatId));
    echo PHP_EOL;
    postByUrl(getUrlToPostDesktop($wallpaper, $botToken, $chatId));
    echo PHP_EOL;
}
