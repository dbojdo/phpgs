<?php

namespace Webit\PHPgs;

use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    /**
     * @return string
     */
    protected function randomPathname()
    {
        return sprintf('%s/%s', sys_get_temp_dir(), $this->randomString());
    }

    /**
     * @return string
     */
    protected function randomString()
    {
        return md5(mt_rand(0, 1000));
    }
}