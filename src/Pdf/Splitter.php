<?php

namespace Webit\PHPgs\Pdf;

use Webit\PHPgs\Input;
use Webit\PHPgs\Options\Options;
use Webit\PHPgs\Output;

interface Splitter
{
    /**
     * @param Input $input
     * @param Output $output
     * @param int $pageFrom
     * @param int $pageTo
     * @param Options|null $options
     * @return
     */
    public function split(Input $input, Output $output, $pageFrom = null, $pageTo = null, Options $options = null);
}