<?php
declare(strict_types=1);

class TestCase
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    
    public function setUp(): void
    {
        //pass
    }

    public function tearDown(): void
    {
        //pass
    }

    public function run(): void
    {
        $this->setUp();
        call_user_func([$this, $this->name]);
        $this->tearDown();
    }

}

class WasRun extends TestCase
{
    private $log;

    public function setUp(): void
    {
        $this->wasRun = false;
        $this->log = 'setUp ';
    }

    public function testMethod(): void
    {
        $this->log .= 'testMethod ';
    }

    public function tearDown(): void
    {
        $this->log .= 'tearDown ';
    }

    public function log(): string
    {
        return $this->log;
    }
}

class TestCaseTest extends TestCase
{
    public function testTemplateMethod(): void
    {
        $test = new WasRun('testMethod');
        $test->run();
        assert('setUp testMethod tearDown ' == $test->log());
    }
}

(new TestCaseTest('testTemplateMethod'))->run();