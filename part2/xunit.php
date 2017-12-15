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
        try{
            call_user_func([$this, $this->name]);
        }catch(Exception $e){
            $result->testFailed();
        }
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
    private $errorCount;

    public function __construct()
    {
        $this->runCount = 0;
        $this->errorCount = 0;
    }

    public function testStarted(): void
    {
        $this->runCount += 1;
    }

    public function testFailed(): void
    {
        $this->errorCount += 1;
    }

    public function summary(): string
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
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

    public function testFailedResultFormatting(): void
    {
        // TestResult単独のテスト
        $result = new TestResult();
        $result->testStarted();
        $result->testFailed();
        assert('1 run, 1 failed' == $result->summary());
    }
}

printf("%s\n", (new TestCaseTest('testTemplateMethod'))->run()->summary());
printf("%s\n", (new TestCaseTest('testResult'))->run()->summary());
printf("%s\n", (new TestCaseTest('testFailedResult'))->run()->summary());
printf("%s\n", (new TestCaseTest('testFailedResultFormatting'))->run()->summary());
