<?php

namespace Webit\PHPgs;

use Symfony\Component\Process\Process;
use Webit\PHPgs\Options\Options;

class ExecutorTest extends AbstractTest
{
    /**
     * @var ProcessFactory|\Mockery\MockInterface
     */
    private $processFactory;

    /**
     * @var Executor
     */
    private $executor;

    protected function setUp()
    {
        $this->processFactory = \Mockery::mock('Webit\PHPgs\ProcessFactory');
        $this->executor = new Executor($this->processFactory);
    }

    /**
     * @test
     */
    public function shouldExecuteGsCommand()
    {
        $input = Input::singleFile($this->randomPathname());
        $output = Output::create($this->randomPathname());
        $options = Options::create();

        $process = $this->mockProcess();
        $this->processFactory
            ->shouldReceive('createProcess')
            ->with($input, $output, $options)
            ->andReturn($process)
            ->once();

        $process->shouldReceive('run')->andReturn(0)->once();

        $this->executor->execute($input, $output, $options);
    }

    /**
     * @test
     * @expectedException \Webit\PHPgs\GhostScriptExecutionException
     */
    public function shouldThrowExceptionOnCommandExecutionFailure()
    {
        $input = Input::singleFile($this->randomPathname());
        $output = Output::create($this->randomPathname());
        $options = Options::create();

        $process = $this->mockProcess();
        $this->processFactory
            ->shouldReceive('createProcess')
            ->with($input, $output, $options)
            ->andReturn($process)
            ->once();

        $process->shouldReceive('run')->andReturn(2)->once();
        $process->shouldReceive('getCommandLine')->andReturn($this->randomPathname());
        $process->shouldReceive('getOutput')->andReturn($this->randomString());

        $this->executor->execute($input, $output, $options);
    }

    /**
     * @return \Mockery\MockInterface|Process
     */
    private function mockProcess()
    {
        $process = \Mockery::mock('Symfony\Component\Process\Process');

        $process->shouldReceive('stop');

        return $process;
    }
}
