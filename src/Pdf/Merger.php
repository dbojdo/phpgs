<?php

namespace Webit\PHPgs\Pdf;

use Webit\PHPgs\Input;
use Webit\PHPgs\Options\Options;
use Webit\PHPgs\Output;

interface Merger
{
    /**
     * @param Input $input
     * @param Output $output
     * @param Options|null $options
     * @return
     */
    public function merge(Input $input, Output $output, Options $options = null);
}