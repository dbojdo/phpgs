<?php

namespace Webit\PHPgs\Options;

final class Size
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * Size constructor.
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return sprintf('%dx%d', $this->width, $this->height);
    }
}