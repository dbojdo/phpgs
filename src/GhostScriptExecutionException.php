<?php

namespace Webit\PHPgs;

use Symfony\Component\Process\Process;

class GhostScriptExecutionException extends \RuntimeException
{
    /** @var string */
    private $command;

    /** @var string */
    private $output;

    /**
     * @param Process $process
     * @return GhostScriptExecutionException
     */
    public static function fromProcess(Process $process)
    {
        $exception = new self('Error during GhostScript command execution.');
        $exception->command = $process->getCommandLine();
        $exception->output = $process->getOutput();

        return $exception;
    }

    /**
     * @return string
     */
    public function command()
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function output()
    {
        return $this->output;
    }
}
