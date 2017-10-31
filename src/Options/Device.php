<?php

namespace Webit\PHPgs\Options;

final class Device
{
    /** @var string */
    private $device;

    /**
     * Device constructor.
     * @param string $device
     */
    private function __construct($device)
    {
        $this->device = (string)$device;
    }

    /**
     * @return Device
     */
    public static function jpeg()
    {
        return new self('jpeg');
    }

    /**
     * @return Device
     */
    public static function png256()
    {
        return new self('png256');
    }

    /**
     * @return Device
     */
    public static function pdfWrite()
    {
        return new self('pdfwrite');
    }

    /**
     * @param string $device
     * @return Device
     */
    public static function any($device)
    {
        return new self($device);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->device;
    }
}
