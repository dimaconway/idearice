<?php
declare (strict_types=1);

namespace IdeaRice;

/**
 * Class Wallpaper
 *
 * @package IdeaRice
 */
class Wallpaper
{
    /** @var string */
    private $basePictureUrl;

    /** @var string */
    private $copyrightText;

    /**
     * Wallpaper constructor.
     *
     * @param $basePictureUrl
     * @param $copyrightText
     */
    public function __construct(
        $basePictureUrl,
        $copyrightText
    ) {
        $this->basePictureUrl = $basePictureUrl;
        $this->copyrightText = $copyrightText;
    }

    /**
     * @return string
     */
    public function get1920x1080(): string
    {
        return $this->getResolution('1920x1080');
    }

    /**
     * @param string $resolution
     *
     * @return string
     */
    private function getResolution(string $resolution): string
    {
        return 'https://www.bing.com'
            . $this->basePictureUrl
            . '_' . $resolution . '.jpg';
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->copyrightText;
    }

    /**
     * @return string
     */
    public function get1366x768(): string
    {
        return $this->getResolution('1366x768');
    }

    /**
     * @return string
     */
    public function get1920x1200(): string
    {
        return $this->getResolution('1920x1200');
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->getResolution('1080x1920');
    }
}
