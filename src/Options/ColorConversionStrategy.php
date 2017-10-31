<?php

namespace Webit\PHPgs\Options;

final class ColorConversionStrategy
{
    /** @var string */
    private $strategy;

    /**
     * ColorConversionStrategy constructor.
     * @param string $strategy
     */
    private function __construct($strategy)
    {
        $this->strategy = (string)$strategy;
    }

    /**
     * @return ColorConversionStrategy
     */
    public static function leaveColorUnchanged()
    {
        return new self('LeaveColorUnchanged');
    }

    /**
     * @return ColorConversionStrategy
     */
    public static function useDeviceIndependentColor()
    {
        return new self('UseDeviceIndependentColor');
    }

    /**
     * @return ColorConversionStrategy
     */
    public static function gray()
    {
        return new self('Gray');
    }

    /**
     * @return ColorConversionStrategy
     */
    public static function rgb()
    {
        return new self('rgb');
    }

    /**
     * @return ColorConversionStrategy
     */
    public static function cmyk()
    {
        return new self('CMYK');
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->strategy;
    }
}