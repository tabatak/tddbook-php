<?php

class TestCase
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function run(): void
    {
        call_user_func([$this, $this->name]);
    }

}

class WasRun extends TestCase
{
    private $wasRun;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->wasRun = false;
    }

    public function testMethod(): void
    {
        $this->wasRun = true;
    }

    public function wasRun(): bool
    {
        return $this->wasRun;
    }
}

class TestCaseTest extends TestCase
{
    public function testRunning(): void
    {
        $test = new WasRun('testMethod');
        assert(!$test->wasRun());
        $test->run();
        assert($test->wasRun());
    }
}

(new TestCaseTest('testRunning'))->run();