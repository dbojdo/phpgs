<?php

namespace Webit\PHPgs\Options;

final class CompatibilityLevel
{
    /** @var string */
    private $level;

    /**
     * CompatibilityLevel constructor.
     * @param string $level
     */
    private function __construct($level)
    {
        $this->level = (string)$level;
    }

    /**
     * @return CompatibilityLevel
     */
    public static function level13()
    {
        return new self('1.3');
    }

    /**
     * @return CompatibilityLevel
     */
    public static function level14()
    {
        return new self('1.4');
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->level;
    }
}