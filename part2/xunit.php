<?php

$test = new WasRun("testMethod");
printf("%b\n", $test->wasRun);
$test->testMethod();
printf("%b\n", $test->wasRun);

class WasRun
{
    public $wasRun;

    public function __construct(string $name)
    {
        $this->wasRun = false;
    }

    public function testMethod(): void
    {
        $this->wasRun = true;
    }
}