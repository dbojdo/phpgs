<?php

namespace Webit\PHPgs\Options;

final class Options
{
    /** @var string[] */
    private static $defaultOptions = array(
        '-dNOPAUSE' => null,
        '-dBATCH' => null,
        '-dSAFER' => null
    );

    /**
     * @var string[]
     */
    private $options;

    /**
     * Options constructor.
     * @param array $options
     */
    private function __construct(array $options = array())
    {
        $this->options = array_replace(self::$defaultOptions, $options);
    }

    /**
     * @param Device $device
     * @return Options
     */
    public static function create(Device $device = null)
    {
        $options = new self();
        return $options->withDevice($device ?: Device::pdfWrite());
    }

    /**
     * @param Device $device
     * @return Options
     */
    public function withDevice(Device $device)
    {
        return $this->withOption('-sDEVICE', (string)$device);
    }

    /**
     * @param Size $size
     * @return Options
     */
    public function withSize(Size $size)
    {
        return $this->withOption(sprintf('-g%s', (string)$size));
    }

    /**
     * @param CompatibilityLevel $compatibilityLevel
     * @return Options
     */
    public function withCompatibilityLevel(CompatibilityLevel $compatibilityLevel)
    {
        return $this->withOption('-dCompatibilityLevel', (string)$compatibilityLevel);
    }

    /**
     * @return Options
     */
    public function withNoTransparency()
    {
        return $this->withOption('-dNOTRANSPARENCY');
    }

    /**
     * @return Options
     */
    public function useCIEColor()
    {
        return $this->withOption('-dUseCIEColor', 'true');
    }

    /**
     * @param ColorConversionStrategy $colorConversionStrategy
     * @return Options
     */
    public function withColorConversionStrategy(ColorConversionStrategy $colorConversionStrategy)
    {
        return $this->withOption('-dColorConversionStrategy', (string)$colorConversionStrategy);
    }

    /**
     * @param ColorConversionStrategy $colorConversionStrategy
     * @return Options
     */
    public function withColorConversionStrategyForImages(ColorConversionStrategy $colorConversionStrategy)
    {
        return $this->withOption('-dColorConversionStrategyForImages', (string)$colorConversionStrategy);
    }

    /**
     * @param DeviceColorSpace $colorSpace
     * @return Options
     */
    public function withProcessColorModel(DeviceColorSpace $colorSpace)
    {
        return $this->withOption('-dProcessColorModel', (string)$colorSpace);
    }

    /**
     * @param int|null $first
     * @param int|null $last
     * @return Options
     */
    public function withPageRange($first = null, $last = null)
    {
        $options = $this;
        if ($first !== null) {
            $options = $options->withOption('-dFirstPage', $first);
        }

        if ($last !== null) {
            $options = $options->withOption('-dLastPage', $last);
        }

        return $options;
    }

    /**
     * @param int $quality
     * @return Options
     */
    public function withJpegQuality($quality)
    {
        return $this->withOption('-dJPEGQ', (int)$quality);
    }

    /**
     * @param int $x
     * @param null|int $y
     * @return Options
     */
    public function withResolution($x, $y = null)
    {
        $option = sprintf('-r%d', $x);
        if ($y) {
            $option = sprintf('-r%dx%d', $x, $y);
        }

        return $this->withOption($option);
    }

    /**
     * @return Options
     */
    public function useCropBox()
    {
        return $this->withOption('-dUseCropBox');
    }

    /**
     * @param string $option
     * @param null|mixed $value
     * @return Options
     */
    public function withOption($option, $value = null)
    {
        $options = $this->options;
        $options[$option] = $value !== null ? (string)$value : null;

        return new self($options);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        $options = array();
        foreach ($this->options as $option => $value) {
            $value = $value === null ? escapeshellarg($option) : sprintf('%s=%s', $option, escapeshellarg($value));
            $options[] = $value;
        }

        return implode(' ', $options);
    }
}