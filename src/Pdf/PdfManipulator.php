<?php

namespace Webit\PHPgs\Pdf;

use Webit\PHPgs\Input;
use Webit\PHPgs\Options\Device;
use Webit\PHPgs\Options\Options;
use Webit\PHPgs\Output;
use Webit\PHPgs\Executor;

final class PdfManipulator implements Merger, Splitter
{
    /**
     * @var Executor
     */
    private $writer;

    /**
     * PdfUoW constructor.
     * @param Executor $writer
     */
    public function __construct(Executor $writer)
    {
        $this->writer = $writer;
    }

    /**
     * @inheritdoc
     */
    public function merge(Input $input, Output $output, Options $options = null)
    {
        $options = $this->mergeOptions($options);
        $this->writer->execute($input, $output, $options);
    }

    /**
     * @inheritdoc
     */
    public function split(Input $input, Output $output, $pageFrom = null, $pageTo = null, Options $options = null)
    {
        $options = $this->mergeOptions($options)->withPageRange($pageFrom, $pageTo);
        $this->writer->execute($input, $output, $options);

        $this->ensureExtractedPages($output, $pageFrom, $pageTo);
    }

    /**
     * @param Options|null $options
     * @return Options
     */
    private function mergeOptions(Options $options = null)
    {
        $options = $options ?: Options::create();
        return $options->withDevice(Device::pdfWrite());
    }

    /**
     * Fix unwanted Ghost Script behaviour (producing additional empty page)
     * @param Output $output
     * @param int $pageFrom
     * @param int $pageTo
     */
    private function ensureExtractedPages(Output $output, $pageFrom, $pageTo)
    {
        $expectedNumberOfPages = $pageTo - ($pageFrom ?: 1) + 1;

        $files = $output->files();

        while(count($files) > $expectedNumberOfPages) {
            @unlink(array_pop($files));
            $files = $output->files();
        }
    }
}
