<?php

namespace Webit\PHPgs;

use Webit\PHPgs\Options\Options;

class Executor
{
    /** @var ProcessFactory */
    private $processFactory;

    /**
     * Writer constructor.
     * @param ProcessFactory $processFactory
     */
    public function __construct(ProcessFactory $processFactory = null)
    {
        $this->processFactory = $processFactory ?: new ProcessFactory();
    }

    /**
     * @param Input $input
     * @param Output $output
     * @param Options $options
     * @throws \Exception
     */
    public function execute(Input $input, Output $output, Options $options)
    {
        $process = $this->processFactory->createProcess($input, $output, $options);
//var_dump($process->getCommandLine());
        if (0 != $process->run()) {
            throw GhostScriptExecutionException::fromProcess($process);
        }
    }
}
