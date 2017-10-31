<?php

namespace Webit\PHPgs\Options;

final class DeviceColorSpace
{
    /** @var string */
    private $colorSpace;

    /**
     * DeviceColorSpace constructor.
     * @param string $colorSpace
     */
    private function __construct($colorSpace)
    {
        $this->colorSpace = (string)$colorSpace;
    }

    /**
     * @return DeviceColorSpace
     */
    public static function gray()
    {
        return new self('/DeviceGray');
    }

    /**
     * @return DeviceColorSpace
     */
    public static function rgb()
    {
        return new self('/DeviceRGB');
    }

    /**
     * @return DeviceColorSpace
     */
    public static function cmyk()
    {
        return new self('/DeviceCMYK');
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->colorSpace;
    }
}