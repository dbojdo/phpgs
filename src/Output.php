<?php

namespace Webit\PHPgs;

final class Output implements \IteratorAggregate
{
    /** @var string */
    private $filenameOrPattern;

    /**
     * Output constructor.
     * @param string $filenameOrPattern
     */
    private function __construct($filenameOrPattern)
    {
        $this->filenameOrPattern = (string)$filenameOrPattern;
    }

    /**
     * @param string $filenameOrPattern
     * @return Output
     */
    public static function create($filenameOrPattern)
    {
        return new self($filenameOrPattern);
    }

    /**
     * @return string
     */
    public function filenameOrPattern()
    {
        return $this->filenameOrPattern;
    }

    /**
     * @return string[]
     */
    public function files()
    {
        $files = array();
        foreach (new \DirectoryIterator(dirname($this->filenameOrPattern())) as $file) {
            if ($file->isDot()) {
                continue;
            }
            $files[] = $file->getPathname();
        }
        sort($files, SORT_NATURAL);

        return $files;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->files());
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return escapeshellarg($this->filenameOrPattern());
    }
}
