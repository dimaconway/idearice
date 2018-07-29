<?php
declare (strict_types=1);

if (3 !== $argc) {
    echo 'Run it like this:' . PHP_EOL
        . 'php -f ' . basename(__FILE__) . ' <BOT_TOKEN> <CHAT_ID> ' . PHP_EOL;
    die;
}

[, $botToken, $chatId] = $argv;

$basePictureUrl = 'https://www.bing.com/az/hprichbg/rb/T19Krishna_EN-GB11510458805';

$arPhotos = [
    '1280x720'  => $basePictureUrl . '_1280x720.jpg',
    '1366x768'  => $basePictureUrl . '_1366x768.jpg',
    '1920x1080' => $basePictureUrl . '_1920x1080.jpg',
    '1920x1200' => $basePictureUrl . '_1920x1200.jpg',
];

$copyrightLink = 'http://www.bing.com/search?q=bengal+tiger&form=hpcapt&filters=HpDate:%2220180728_2300%22';
$copyright = 'A Bengal tiger called ‘Krishna‘ or ‘T19’ in Ranthambore National Park, India (© Andy Rouse/Minden Pictures)';

$photo = $arPhotos['1920x1080'];
$caption = preg_replace('/\((©.*)\)/u', '([$1](' . $copyrightLink . '))', $copyright);

$arButtons = [];
$i = 0;
foreach ($arPhotos as $resolution => $url) {
    $rowIndex = $i / 2;
    $arButtons[$rowIndex][] = [
        'text' => $resolution,
        'url'  => $url,
    ];
    $i++;
}

$requestUrl = 'https://api.telegram.org/bot' . urlencode($botToken)
    . '/sendPhoto?chat_id=' . urlencode($chatId)
    . '&photo=' . urlencode($photo)
    . '&caption=' . urlencode($caption)
    . '&parse_mode=Markdown'
    . '&reply_markup=' . urlencode(json_encode(['inline_keyboard' => $arButtons]));

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $requestUrl);
$response = curl_exec($curl);
if ($response) {
    echo var_export($response, true);
} else {
    $errno = curl_errno($curl);
    $error = curl_error($curl);
    echo "Curl returned error $errno: $error\n";
}
curl_close($curl);
