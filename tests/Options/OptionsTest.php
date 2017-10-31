<?php

namespace Webit\PHPgs\Options;

use Webit\PHPgs\AbstractTest;

class OptionsTest extends AbstractTest
{
    /**
     * @param Options $options
     * @param string $expectedString
     * @dataProvider options
     * @test
     */
    public function shouldCastToString(Options $options, $expectedString)
    {
        $this->assertEquals($expectedString, (string)$options);
    }

    public function options()
    {
        return array(
            'default' => array(
                Options::create(),
                sprintf("%s", $this->commonOptions())
            ),
            'custom-device' => array(
                Options::create($device = Device::any($this->randomString())),
                sprintf("%s", $this->commonOptions($device))
            ),
            'size' => array(
                Options::create()->withSize(new Size(150, 200)),
                sprintf("%s '-g150x200'", $this->commonOptions())
            ),
            'compatibility level' => array(
                Options::create()->withCompatibilityLevel($compatibilityLevel = CompatibilityLevel::level14()),
                sprintf("%s -dCompatibilityLevel='%s'", $this->commonOptions(), (string)$compatibilityLevel)
            ),
            'color conversion strategy' => array(
                Options::create()->withColorConversionStrategy($colorConversionStrategy = ColorConversionStrategy::gray()),
                sprintf("%s -dColorConversionStrategy='%s'", $this->commonOptions(), (string)$colorConversionStrategy)
            ),
            'color conversion strategy for images' => array(
                Options::create()->withColorConversionStrategyForImages($colorConversionStrategy = ColorConversionStrategy::cmyk()),
                sprintf("%s -dColorConversionStrategyForImages='%s'", $this->commonOptions(), (string)$colorConversionStrategy)
            ),
            'jpeg quality' => array(
                Options::create()->withJpegQuality($quality = 90),
                sprintf("%s -dJPEGQ='%s'", $this->commonOptions(), $quality)
            ),
            'no transparency' => array(
                Options::create()->withNoTransparency(),
                sprintf("%s '-dNOTRANSPARENCY'", $this->commonOptions())
            ),
            'resolution' => array(
                Options::create()->withResolution($x = 72, $y = 96),
                sprintf("%s '-r%dx%d'", $this->commonOptions(), $x, $y)
            ),
            'process color model' => array(
                Options::create()->withProcessColorModel($colorSpace = DeviceColorSpace::rgb()),
                sprintf("%s -dProcessColorModel='%s'", $this->commonOptions(), (string)$colorSpace)
            ),
            'page range' => array(
                Options::create()->withPageRange($from = 4, $to = 10),
                sprintf("%s -dFirstPage='%s' -dLastPage='%s'", $this->commonOptions(), $from, $to)
            ),
            'page from' => array(
                Options::create()->withPageRange($from = 4),
                sprintf("%s -dFirstPage='%s'", $this->commonOptions(), $from)
            ),
            'page to' => array(
                Options::create()->withPageRange(null, $to = 4),
                sprintf("%s -dLastPage='%s'", $this->commonOptions(), $to)
            ),
            'crop box' =>  array(
                Options::create()->useCropBox(),
                sprintf("%s '-dUseCropBox'", $this->commonOptions())
            ),
            'CIE Color' =>  array(
                Options::create()->useCIEColor(),
                sprintf("%s -dUseCIEColor='true'", $this->commonOptions())
            ),
            'any option with value' => array(
                Options::create()->withOption($option = $this->randomString(), $value = $this->randomString()),
                sprintf("%s %s='%s'", $this->commonOptions(), $option, $value)
            ),
            'any option no value' => array(
                Options::create()->withOption($option = $this->randomString()),
                sprintf("%s '%s'", $this->commonOptions(), $option)
            ),
        );
    }

    private function commonOptions($device = null)
    {
        return sprintf("'-dNOPAUSE' '-dBATCH' '-dSAFER' -sDEVICE='%s'", $device ?: 'pdfwrite');
    }
}
