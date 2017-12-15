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

    public function run(): TestResult
    {
        $result = new TestResult();
        $result->testStarted();
        $this->setUp();
        call_user_func([$this, $this->name]);
        $this->tearDown();
        return $result;
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

    public function testBrokenMethod(): void
    {
        throw new Exception();
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

class TestResult
{
    private $runCount;

    public function __construct()
    {
        $this->runCount = 0;
    }

    public function testStarted(): void
    {
        $this->runCount += 1;
    }

    public function summary(): string
    {
        return sprintf('%d run, 0 failed', $this->runCount);
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

    public function testResult(): void
    {
        $test = new WasRun('testMethod');
        $result = $test->run();
        assert('1 run, 0 failed' == $result->summary());
    }

    public function testFailedResult(): void
    {
        $test = new WasRun('testBrokenMethod');
        $result = $test->run();
        assert('1 run, 1 failed' == $result->summary());
    }
}

(new TestCaseTest('testTemplateMethod'))->run();
(new TestCaseTest('testResult'))->run();
// (new TestCaseTest('testFailedResult'))->run();
