<?php

namespace Webit\PHPgs;

final class Input implements \IteratorAggregate
{
    /** @var string[] */
    private $files;

    /**
     * Input constructor.
     * @param string[] $files
     */
    private function __construct(array $files)
    {
        $this->files = $files;
    }

    /**
     * @param $file
     * @return Input
     */
    public static function singleFile($file)
    {
        return new self(array($file));
    }

    /**
     * @param string[] $files
     * @return Input
     */
    public static function multipleFiles(array $files)
    {
        return new self($files);
    }

    /**
     * @return string[]
     */
    public function files()
    {
        return $this->files;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->files);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        $files = array();
        foreach ($this->files() as $file) {
            $files[] = escapeshellarg($file);
        }

        return implode(' ', $files);
    }
}
