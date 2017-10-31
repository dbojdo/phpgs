<?php

namespace Webit\PHPgs;

use Symfony\Component\Process\Process;
use Webit\PHPgs\Options\Device;
use Webit\PHPgs\Options\Options;
use Webit\PHPgs\Options\Size;

class ProcessFactoryTest extends AbstractTest
{
    /** @var ProcessFactory */
    private $processFactory;

    /** @var string */
    private static $gsPath = '/usr/bin/gs';

    protected function setUp()
    {
        $this->processFactory = new ProcessFactory(static::$gsPath);
    }

    /**
     * @test
     * @dataProvider processes
     * @param Input $input
     * @param Output $output
     * @param Options $options
     * @param Process $expectedProcess
     */
    public function shouldCreateProcess(Input $input, Output $output, Options $options, Process $expectedProcess)
    {
        $this->assertEquals(
            $expectedProcess,
            $this->processFactory->createProcess($input, $output, $options)
        );
    }

    public function processes()
    {
        return array(
            'single input' => array(
                $input = Input::singleFile($this->randomPathname()),
                $output = Output::create($this->randomPathname()),
                $options = Options::create(
                    Device::any($this->randomString())
                )->withSize(new Size(100, 100)),
                new Process(
                    sprintf(
                        "%s %s -sOutputFile=%s %s",
                        static::$gsPath,
                        (string)$options,
                        (string)$output,
                        (string)$input
                    )
                )
            ),
            'multiple input' => array(
                $input = Input::multipleFiles(
                    array(
                        'file1' => $this->randomPathname(),
                        'file2' => $this->randomPathname()
                    )
                ),
                $output = Output::create($this->randomPathname()),
                $options = Options::create(),
                new Process(
                    sprintf(
                        "%s %s -sOutputFile=%s %s",
                        static::$gsPath,
                        (string)$options,
                        (string)$output,
                        (string)$input
                    )
                )
            )
        );
    }
}
