<?php

namespace Webit\PHPgs;

class ExecutorBuilder
{
    /** @var string */
    private $ghostScriptBinary = 'gs';

    public static function create()
    {
        return new self();
    }

    /**
     * @param $ghostScriptBinary
     * @return $this
     */
    public function setGhostScriptBinary($ghostScriptBinary)
    {
        $this->ghostScriptBinary = $ghostScriptBinary;
        return $this;
    }

    /**
     * @return Executor
     */
    public function build()
    {
        return new Executor(
            new ProcessFactory($this->ghostScriptBinary)
        );
    }
}