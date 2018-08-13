<?php
declare (strict_types=1);

namespace IdeaRice;

use JsonSerializable;

/**
 * Class Wallpaper
 *
 * @package IdeaRice
 */
class Wallpaper implements JsonSerializable
{
    /** @var string */
    private $mkt;

    /** @var string */
    private $basePictureUrl;

    /** @var string */
    private $copyrightText;

    /**
     * Wallpaper constructor.
     *
     * @param $basePictureUrl
     * @param $copyrightText
     * @param $mkt
     */
    public function __construct(
        $basePictureUrl,
        $copyrightText,
        $mkt
    ) {
        $this->basePictureUrl = $basePictureUrl;
        $this->copyrightText = $copyrightText;
        $this->mkt = $mkt;
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

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
