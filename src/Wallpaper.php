<?php
declare (strict_types = 1);

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
    private $copyrightLink;

    /** @var string */
    private $copyrightText;

    /**
     * Wallpaper constructor.
     *
     * @param $basePictureUrl
     * @param $copyrightLink
     * @param $copyrightText
     */
    public function __construct($basePictureUrl, $copyrightLink, $copyrightText)
    {
        $this->basePictureUrl = $basePictureUrl;
        $this->copyrightLink = $copyrightLink;
        $this->copyrightText = $copyrightText;
    }


}
