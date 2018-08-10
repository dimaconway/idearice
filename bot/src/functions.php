<?php
declare(strict_types=1);

namespace IdeaRice;

/**
 * Return iterable of Wallpaper instances
 *
 * @return iterable
 */
function getWallpapers(): iterable
{
    $markets = [
        'en-US',
        'en-GB',
        'ru-RU',
        'uk-UA',
        'ar-XA',
        'bg-BG',
        'cs-CZ',
        'da-DK',
        'de-AT',
        'de-CH',
        'de-DE',
        'el-GR',
        'en-AU',
        'en-CA',
        'en-ID',
        'en-IE',
        'en-IN',
        'en-MY',
        'en-NZ',
        'en-PH',
        'en-SG',
        'en-XA',
        'en-ZA',
        'es-AR',
        'es-CL',
        'es-ES',
        'es-MX',
        'es-US',
        'es-XL',
        'et-EE',
        'fi-FI',
        'fr-BE',
        'fr-CA',
        'fr-CH',
        'fr-FR',
        'he-IL',
        'hr-HR',
        'hu-HU',
        'it-IT',
        'ja-JP',
        'ko-KR',
        'lt-LT',
        'lv-LV',
        'nb-NO',
        'nl-BE',
        'nl-NL',
        'pl-PL',
        'pt-BR',
        'pt-PT',
        'ro-RO',
        'sk-SK',
        'sl-SL',
        'sv-SE',
        'th-TH',
        'tr-TR',
        'zh-CN',
        'zh-HK',
        'zh-TW',
    ];
    $baseUrl = 'https://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';

    $uniqueImageNames = [];
    $wallpapers = [];

    foreach ($markets as $market) {
        $requestUrl = $baseUrl . '&mkt=' . $market;
        $response = file_get_contents($requestUrl);
        $parsedResponse = json_decode($response);

        $image = $parsedResponse->images[0];

        $matches = [];
        preg_match('/.*\/([^_]*)/', $image->urlbase, $matches);
        $imageNameFromUrl = $matches[1];

        if (!\in_array($imageNameFromUrl, $uniqueImageNames, true)) {
            $uniqueImageNames[] = $imageNameFromUrl;
            $wallpapers[] = new Wallpaper(
                $image->urlbase,
                $image->copyright
            );
        }
    }

    return $wallpapers;
}

/**
 * @param Wallpaper $wallpaper
 * @param string    $botToken
 * @param string    $chatId
 *
 * @return string
 */
function getUrlToPostMobile(
    Wallpaper $wallpaper,
    string $botToken,
    string $chatId
): string {
    $arButtons = [
        [
            [
                'text' => 'Mobile',
                'url'  => $wallpaper->getMobile(),
            ],
        ],
    ];

    return getUrlToPost(
        $botToken,
        $chatId,
        $wallpaper->getMobile(),
        $wallpaper->getCaption(),
        $arButtons
    );
}

/**
 * @param Wallpaper $wallpaper
 * @param string    $botToken
 * @param string    $chatId
 *
 * @return string
 */
function getUrlToPostDesktop(
    Wallpaper $wallpaper,
    string $botToken,
    string $chatId
): string {
    $arButtons = [
        [
            [
                'text' => '1366x768',
                'url'  => $wallpaper->get1366x768(),
            ],
            [
                'text' => '1920x1080',
                'url'  => $wallpaper->get1920x1080(),
            ],
            [
                'text' => '1920x1200',
                'url'  => $wallpaper->get1920x1200(),
            ],
        ],
    ];

    return getUrlToPost(
        $botToken,
        $chatId,
        $wallpaper->get1920x1080(),
        $wallpaper->getCaption(),
        $arButtons
    );
}

/**
 * @param string $botToken
 * @param string $chatId
 * @param string $photo
 * @param string $caption
 * @param array  $arButtons
 *
 * @return string
 */
function getUrlToPost(
    string $botToken,
    string $chatId,
    string $photo,
    string $caption,
    array $arButtons
): string {
    return 'https://api.telegram.org/bot' . urlencode($botToken)
        . '/sendPhoto?chat_id=' . urlencode($chatId)
        . '&photo=' . urlencode($photo)
        . '&caption=' . urlencode($caption)
        . '&reply_markup=' . urlencode(json_encode(['inline_keyboard' => $arButtons]));
}


/**
 * @param string $url
 */
function postByUrl(string $url): void
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_exec($curl);
    curl_close($curl);
}
